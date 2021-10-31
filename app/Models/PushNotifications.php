<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotifications extends Model
{
    //
    const STATUS_QUEUED = 0;
    const STATUS_SEND = 1;
    const STATUS_FAILURE = 2;

    const READ = 1;
    const UN_READ = 0;

    const TYPE_SIMPLE = 1;
    const TYPE_GROUP = 2;

    const SOURCE_ADMIN = 1;
    const SOURCE_STUDENT = 2;


    protected $table = 'push_notifications';
    protected $guarded = [];

    public function userPush()
    {
        return $this->hasMany(PushUser::class, 'push_id', 'id');
    }

    public function updatePush($id, $update)
    {
        return $this->where($this->primaryKey, $id)->update($update);
    }

    public function sender()
    {
        return $this->hasOne(Users::class, 'id', 'sender_id');
    }

    /**
     * detail push by push id
     * @author lamnt
     * @param int push id
     * @adate 2021 02 02
     */
    public function getById($id)
    {
        $data = $this->with(['userPush.userDevice'])
            ->where($this->primaryKey, $id)->first();
        return $data;
    }

    /**
     * get list notification by user id
     * @author lamnt
     * @param request
     * @date 2021 05 28
     */
    public function getNotifications($request)
    {
        $userId =$request->user()->id;
        return $this->with('userPush')
        ->whereHas('userPush', function($q) use($userId){
            $q->where('user_id', $userId);
        })->orderBy('id', 'desc')->paginate(15);
    }
}
