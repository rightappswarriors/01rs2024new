<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOfPayment extends Model
{
    protected $table = 'orderofpayment';
    protected $primaryKey = 'oop_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
