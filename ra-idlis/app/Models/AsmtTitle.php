<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsmtTitle extends Model
{
    protected $table = 'asmt_title';
    protected $primaryKey = 'title_code';
    public $incrementing = false;
    protected $keyType = 'string';
}
