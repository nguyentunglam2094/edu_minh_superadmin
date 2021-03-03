<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'avatar', 'dob', 'address', 'active'
    ];
    public function getDetail($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    public function activeStudent($id, $status)
    {
        return $this->where($this->primaryKey, $id)->update([
            'active'=>$status,
        ]);
    }
}
