<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HFACIGroup extends Model {
    protected $primaryKey   = 'hgpid';
    protected $status   = 'status';
    protected $table = 'hfaci_grp';
}
