<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PGallery extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $tables = 'p_galleries';
    protected $hidden = ['create_at', 'updated_at'];


}
