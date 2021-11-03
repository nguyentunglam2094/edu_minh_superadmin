<?php

namespace App\Models;

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
        if(empty($request->type)){
            $data = [
                'user_id'=>0,
                'teacher_id'=>$request->user()->id,
                'object_id'=>0,
                'exercise_id'=>$request->ex_id,
                'comment'=>$request->newCmt,
                'parent_id'=>$parent_id,
            ];
        }else{
            $data = [
                'user_id'=>0,
                'teacher_id'=>$request->user()->id,
                'object_id'=>$request->ex_id,
                'exercise_id'=>0,
                'comment'=>$request->newCmt,
                'parent_id'=>$parent_id,
            ];
        }
        return $this->create($data);
    }


}
