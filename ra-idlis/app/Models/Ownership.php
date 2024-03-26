<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    protected $table = 'ownership';
    protected $primaryKey = 'ocid';
    public $incrementing = false;
    protected $keyType = 'string';
}
