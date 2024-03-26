<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityType extends Model
{
    protected $table = 'facilitytyp';
    protected $primaryKey = 'facid';
    public $incrementing = false;
    protected $keyType = 'string';
}
