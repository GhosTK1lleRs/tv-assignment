<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'name', 'extension', 'fileurl', 'size', 'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_uploads', 'upload_id', 'catalog_id')
            ->withPivot('catalog_id', 'upload_id');
    }

    // public function catalog()
    // {
    //     return $this->belongsToMany(Catalog::class, 'catalog_uploads', 'catalog_id', 'upload_id')
    //         ->withPivot('catalog_id', 'upload_id');
    // }

}
