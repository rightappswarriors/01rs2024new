<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppType extends Model
{
    protected $table = 'apptype';
    protected $primaryKey = 'aptid';
    public $incrementing = false;
    protected $keyType = 'string';
}
