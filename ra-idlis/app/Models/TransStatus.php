<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransStatus extends Model
{
    protected $table = 'trans_status';
    protected $primaryKey = 'trns_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
