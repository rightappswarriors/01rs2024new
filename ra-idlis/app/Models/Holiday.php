<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';
    protected $primaryKey = 'hdy_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
