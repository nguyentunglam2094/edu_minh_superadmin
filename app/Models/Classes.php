<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected $table = 'classes';
    protected $fillable = ['title', 'id'];

    public function getClass()
    {
        return $this->orderBy('id', 'desc')->get();
    }
}
