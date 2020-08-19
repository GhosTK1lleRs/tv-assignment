<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $uploads = Upload::orderBy('updated_at', 'DESC')
            ->where('user_id', '=', $user->id)
            ->paginate(30);

        return view('picture', compact('uploads'))
            ->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $arrData = $request->all();

        if ($request->hasFile('file')) {

            $destinationPath = 'storage/userupload';

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $name = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $size = $request->file('file')->getSize();

            $validextensions = array("gif", "jpeg", "jpg", "png");

            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file
                $fileName = Str::slug(Carbon::now()->toDayDateTimeString()) . rand(11111, 99999) . '.' . $extension;

                //db data
                $arrData['name'] = $name;
                $arrData['extension'] = $extension;
                $arrData['fileurl'] = $fileName;
                $arrData['size'] = $size;
                $arrData['user_id'] = Auth::user()->id;
                Upload::create($arrData);

                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);
            }
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = Auth::user();
        $catalog = Catalog::pluck('name', 'id')
            ->where('user_id', '=', $user->id)
            ->get();
        return view('upload.edit', compact('catalog'));

    }


    public function update(Request $request, $id)
    {
        $id = $request->id;
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
        ]);
        $input = $request->all();

        $upload = Auth::user()->upload->find($id);
        $upload->update($input);

        return redirect()->route('upload.index')
            ->with('success', 'File name updated successfully');
    }


    public function destroy($id)
    {
        //Only auth user can delete file
        $user  = Auth::user();
        $file = Upload::select('fileurl')
            ->where('id', '=', $id)
            ->Where('user_id', '=', $user->id)
            ->limit(1)
            ->get();

        //delete file from storage
        Storage::delete('public/userupload/' . $file[0]->fileurl);
        Upload::find($id)->delete();

        return redirect()->route('upload.index')
            ->with('success', 'File deleted successfully');
    }
}
