<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model
{
    protected $table = 'modeofpayment';
    protected $primaryKey = 'mop_code';
    public $incrementing = false;
    protected $keyType = 'string';
}
