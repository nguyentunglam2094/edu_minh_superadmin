<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['user_id','teacher_id','object_id', 'exercise_id', 'comment', 'parent_id'];

    public function parentComment()
    {
        return $this->hasMany(Comments::class, 'parent_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teachers::class, 'id', 'teacher_id');
    }

    /**
     * lấy danh sách comment theo id bài viết
     * @author lamtn
     */
    public function getCommentByExer($exer_id, $col = 'exercise_id')
    {
        return $this->with(['parentComment.user', 'user','parentComment.teacher', 'teacher'])
        ->where('parent_id', 0)->where($col, $exer_id)
        ->orderBy('id','desc')->get();
    }


    public function countComment($exer_id)
    {
        return $this->where('exercise_id', $exer_id)->count();
    }

    public function getCommentByTest($exer_id)
    {
        return $this->with(['parentComment.user', 'user', 'teacher'])
        ->where('parent_id', 0)->where('object_id', $exer_id)
        ->orderBy('id','desc')->get();
    }
    public function saveComment($request)
    {
        $parent_id = 0;
        if(!empty($request->parent_id)){
            $parent_id = $request->parent_id;
        }
        $commentModel = new Comments();
        if(empty($request->type)){
            $data = [
                'user_id'=>0,
                'teacher_id'=>$request->user()->id,
                'object_id'=>0,
                'exercise_id'=>$request->ex_id,
                'comment'=>Ultilities::clearXSS($request->newCmt),
                'parent_id'=>$parent_id,
            ];
            //push noti tới tất cả những người đã comment bài tập
            $listStudent = $commentModel->where('exercise_id', $request->ex_id)->where('user_id', '!=', 0)->pluck('user_id')->toArray();
            $title = "Đã phản hồi một bài tập";
            $screen = 'detailtest';
        }else{
            $data = [
                'user_id'=>0,
                'teacher_id'=>$request->user()->id,
                'object_id'=>$request->ex_id,
                'exercise_id'=>0,
                'comment'=>Ultilities::clearXSS($request->newCmt),
                'parent_id'=>$parent_id,
            ];
            //push noti tới tất cả những người đã đề thi
            $listStudent = $commentModel->where('object_id', $request->ex_id)->where('user_id', '!=', 0)->pluck('user_id')->toArray();
            $title = "Đã phản hồi một bài thi";
            $screen = 'detailexersire';
        }
        $listStudent = array_unique($listStudent);

        $createCmt = $this->create($data);

        Ultilities::pushNotifyToUsers($request->user()->id, $listStudent, $title, $createCmt->comment,
        PushNotifications::TYPE_GROUP, PushNotifications::SOURCE_ADMIN, PushNotifications::SOURCE_STUDENT,
        $screen, $request->ex_id
        );


        return $createCmt;
    }


}
