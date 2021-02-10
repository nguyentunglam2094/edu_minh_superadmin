<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    public function getDetail($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }
}
