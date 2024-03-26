<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PWorkStatus extends Model
{
    protected $table = 'pwork_status';
    protected $primaryKey = 'pworksid';
    public $incrementing = false;
    protected $keyType = 'string';
}
