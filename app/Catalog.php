<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'name', 'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function uploads()
    {
        return $this->belongsToMany(Upload::class, 'catalog_uploads', 'catalog_id', 'upload_id')
            ->withPivot('catalog_id', 'upload_id');
    }
}
