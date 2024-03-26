<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationMsg extends Model
{
    protected $table = 'notification_msg';
    protected $primaryKey = 'msg_code';
}
