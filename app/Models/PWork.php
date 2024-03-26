<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PWork extends Model
{
    protected $table = 'pwork';
    protected $primaryKey = 'pworkid';
    public $incrementing = false;
    protected $keyType = 'string';
}
