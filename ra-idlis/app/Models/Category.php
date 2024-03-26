<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey   = 'cat_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
