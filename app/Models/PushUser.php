<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushUser extends Model
{
    //
    protected $table = 'push_users';
    protected $fillable = ['id','push_id','user_id','read','user_type'];

    public function userDevice()
    {
        return $this->hasOne(UserDevices::class, 'user_id', 'user_id');
    }
}
