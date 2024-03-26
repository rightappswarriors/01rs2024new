<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asmt2Col extends Model
{
    protected $table = 'asmt2_col';
    protected $primaryKey = 'asmt2c_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
