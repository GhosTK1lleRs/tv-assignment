<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Upload;
use App\CatalogUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $catalogs = Catalog::orderBy('name', 'ASC')
            ->where('user_id', '=', $user->id)
            ->paginate(30);
        $uploads = Upload::orderBy('updated_at', 'DESC')
            ->where('user_id', '=', $user->id)
            ->paginate(30);

        return view('catalog.index', compact('catalogs', 'uploads'))
            ->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $catalog = request()->validate([
            'name' => 'required|string',
            'upload_id.*' => 'required|numeric'
        ]);
        $catalog['user_id'] = $user->id;

        DB::beginTransaction();
        try {
            $catalogData = Catalog::create($catalog);
            $catalog_id = $catalogData->id;

            if (!$catalog_id) {
                throw new \Exception('catalog_id is NULL');
            }

            $arrData = [];
            $now = date('Y-m-d H:i:s');

            foreach ($request->input('upload_id') as $upload_id) {
                $arrData[] = [
                    'catalog_id' => $catalog_id,
                    'upload_id' => $upload_id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            DB::table('catalog_uploads')->insert($arrData);
            DB::commit();

            return redirect()
                ->route('catalog.show', $catalog_id)
                ->with('success', 'New catalog created successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()
                ->route('catalog.index')
                ->with('danger', 'New catalog could not be created. Please select atlease 1 image.');
        }
    }

    public function show(Catalog $catalog)
    {
        $user = Auth::user();
        $uploads = Upload::orderBy('name', 'ASC')
            ->where('user_id', '=', $user->id)
            ->paginate(30);

        return view('catalog.show', compact('catalog', 'uploads'))
            ->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Catalog $catalog)
    {
//        $arrData = $request->all();
        $arrData = $request->validate([
            'name' => 'required|string',
            'upload_id.*' => 'required|numeric'
        ]);
        $catalog['user_id'] = Auth::user()->id;

        DB::beginTransaction();
        try {
            $catalog_id = $catalog->id;

            if (!$catalog_id) {
                throw new \Exception('catalog_id is NULL');
            }

            $ids = [];

            if (is_array($request->input('upload_id')) || is_object($request->input('upload_id'))) {
                foreach ($request->input('upload_id') as $upload_id) {
                    $ids[] = $upload_id;
                }
            }

            $catalog->update($arrData);
            $catalog->uploads()->sync($ids);
            DB::commit();

            return redirect()
                ->route('catalog.show', $catalog_id)
                ->with('success', 'Catalog updated successfully.');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()
                ->route('catalog.show', $catalog_id)
                ->with('danger', 'Catalog could not be updated.');
        }

    }

    public function destroy(Catalog $catalog)
    {
        try {
            $catalog->delete();

            return redirect()
                ->route('catalog.index')
                ->with('success', 'Catalog deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()
                ->route('catalog.show', $catalog->id)
                ->with('danger', 'Catalog could not be deleted.');
        }
    }
}
