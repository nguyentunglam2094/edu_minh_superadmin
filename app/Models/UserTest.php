<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    //
    protected $table = 'user_test';


    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}
