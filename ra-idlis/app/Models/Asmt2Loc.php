<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asmt2Loc extends Model
{
    protected $table = 'asmt2_loc';
    protected $primaryKey = 'asmt2l_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
