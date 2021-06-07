<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    //
    protected $table = 'user_answer';

    public function userTest()
    {
        return $this->hasOne(UserTest::class, 'id', 'user_test_id');
    }

    /**
     * get answer by test id
     */
    public function getAnswer($test_id)
    {
        return $this->with('userTest.user')
        ->whereHas('userTest', function($q) use($test_id){
            $q->where('test_id', $test_id);
        })->get();
    }
}
