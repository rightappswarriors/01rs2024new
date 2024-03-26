<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatAssess extends Model
{
    protected $table = 'cat_assess';
    protected $primaryKey = 'caid';
    public $incrementing = false;
    protected $keyType = 'string';
}
