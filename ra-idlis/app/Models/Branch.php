<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey   = 'regionid';
    public $incrementing = false;
    protected $keyType = 'string';
}
