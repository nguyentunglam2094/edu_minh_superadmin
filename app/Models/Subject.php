<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';

    /**
     *
     */
    public function getSubject()
    {
        return $this->orderBy('id','desc')->get();
    }
}
