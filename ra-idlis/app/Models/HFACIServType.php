<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HFACIServType extends Model
{
    protected $table = 'hfaci_serv_type';
    protected $primaryKey = 'hfser_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
