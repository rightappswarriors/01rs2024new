<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PLicenseType extends Model
{
    protected $table = 'plicensetype';
    protected $primaryKey = 'plid';
    public $incrementing = false;
    protected $keyType = 'string';
}
