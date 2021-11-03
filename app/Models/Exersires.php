<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class Exersires extends Model
{
    //
    protected $table = 'exercises';
    protected $fillable = ['code', 'image_answer', 'exercises_type_id' ,'image_question',
     'answer', 'question', 'selected_question',
    'class_id', 'subject_id'];

    public function typeExercire()
    {
        return $this->hasOne(ExerciseType::class, 'id', 'exercises_type_id');
    }

    public function getExersires()
    {
        return $this->with('typeExercire')->orderBy('id','desc')->get();
    }

    public function getExersiresLast()
    {
        return $this->with('typeExercire')->orderBy('id','desc')->latest();
    }

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function class()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    // public function getImageAnswerAttribute($key)
    // {
    //     \Log::debug(explode('|', $key));
    //     return explode('|', $key);
    // }

    public function getDetailById($id)
    {
        return $this->with(['subject', 'class'])->where($this->primaryKey, $id)->first();
    }

    public function createEx($request)
    {
        $data = [
            'code'=>Ultilities::clearXSS($request->code),
            'question'=>$request->question,
            'exercises_type_id'=>0,
            'selected_question'=>Ultilities::clearXSS($request->answer_select),
            'image_question'=>Ultilities::clearXSS($request->image_question),
            'image_answer'=>Ultilities::clearXSS($request->image_answer),
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'class_id'=>Ultilities::clearXSS($request->class_id),
        ];

        return $this->create($data);
    }

    public function updateEx($request)
    {
        $data = [
            'code'=>Ultilities::clearXSS($request->code),
            'question'=>$request->question,
            'exercises_type_id'=>0,
            'selected_question'=>Ultilities::clearXSS($request->answer_select),
            'image_question'=>Ultilities::clearXSS($request->image_question),
            'image_answer'=>Ultilities::clearXSS($request->image_answer),
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'class_id'=>Ultilities::clearXSS($request->class_id),
        ];
        return $this->where($this->primaryKey, $request->id)->update($data);
    }
}
