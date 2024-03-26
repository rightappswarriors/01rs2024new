<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $table = 'charges';
    protected $primaryKey = 'chg_code';
    public $incrementing = false;
    protected $keyType = 'string';
}
