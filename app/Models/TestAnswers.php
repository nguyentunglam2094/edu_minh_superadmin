<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class TestAnswers extends Model
{
    //
    protected $table = 'test_answers';
    protected $fillable = ['test_id', 'question_number', 'selected_question', 'image_answer'];

    const SELECTED_A = 1;
    const SELECTED_B = 2;
    const SELECTED_C = 3;
    const SELECTED_D = 4;

    public function updateAnswerById($id, $selected_question)
    {
        return $this->where($this->primaryKey, $id)->update([
            'selected_question'=>$selected_question
        ]);
    }

    public function updateImageAns($request)
    {
        $file_name = '';
        if($request->hasFile('image')){
            $files = $request->file('image');
            $file_name = Ultilities::uploadFile($files);
        }
        return $this->where($this->primaryKey, $request->ans_id)->update([
            'image_answer'=>$file_name
        ]);
    }
}
