<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class Exersires extends Model
{
    //
    protected $table = 'exercises';
    protected $fillable = ['code', 'image_answer', 'exercises_type_id' ,'image_question', 'answer', 'selected_question'];

    public function typeExercire()
    {
        return $this->hasOne(ExerciseType::class, 'id', 'exercises_type_id');
    }

    public function getExersires()
    {
        return $this->with('typeExercire')->orderBy('id','desc')->get();
    }

    public function createEx($request)
    {
        $data = [
            'code'=>Ultilities::clearXSS($request->code),
            'exercises_type_id'=>Ultilities::clearXSS($request->type),
            'selected_question'=>Ultilities::clearXSS($request->answer_select),
        ];
        if($request->hasFile('image_question')){
            $files = $request->file('image_question');
            $plus = [
                'image_question'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        if($request->hasFile('image_answer')){
            $files = $request->file('image_answer');
            $plus = [
                'image_answer'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        return $this->create($data);
    }
}
