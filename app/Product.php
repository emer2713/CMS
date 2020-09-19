<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $tables = 'products';
    protected $hidden = ['create_at', 'updated_at'];

    public function cat()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getGallery()
    {
        return $this->hasMany(PGallery::class, 'product_id', 'id');
    }

}
