<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    //
    protected $table = 'tests';
    protected $fillable = ['title', 'code', 'subject_id', 'class_id', 'file_pdf', 'question_number', 'min'];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function class()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function getAllTest()
    {
        return $this->with(['subject', 'class'])->orderBy('id', 'desc')->get();
    }

    public function answers()
    {
        return $this->hasMany(TestAnswers::class, 'test_id', 'id');
    }

    public function getDetailTest($id)
    {
        return $this->with(['class', 'subject', 'answers'])->where($this->primaryKey, $id)->first();
    }

    public function createNewTest($request)
    {
        $data = [
            'title'=>Ultilities::clearXSS($request->title),
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'class_id'=>Ultilities::clearXSS($request->class_id),
            'question_number'=>Ultilities::clearXSS($request->question_number),
            'min'=>Ultilities::clearXSS($request->min),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'file_pdf'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        $create = $this->create($data);
        $test_id = $create->id;
        $dataAns = [];
        for($i = 1; $i <= $create->question_number; $i++){
            $dataAns[] = [
                'test_id'=> $test_id,
                'question_number'=> $i,
                'selected_question'=> TestAnswers::SELECTED_A
            ];
        }
        TestAnswers::insert($dataAns);
        return $create;
    }

    public function updateTest($request)
    {
        $detail = $this->where($this->primaryKey, $request->test_id)->first();
        $numberOrigin = $detail->question_number;
        $data = [
            'title'=>Ultilities::clearXSS($request->title),
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'class_id'=>Ultilities::clearXSS($request->class_id),
            'question_number'=>Ultilities::clearXSS($request->question_number),
            'min'=>Ultilities::clearXSS($request->min),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'file_pdf'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        $detail->update($data);

        if($request->hasFile('image') || $numberOrigin != $request->question_number){
            $test_id = $request->test_id;
            TestAnswers::where('test_id', $test_id)->delete();
            $dataAns = [];
            for($i = 1; $i <= $request->question_number; $i++){
                $dataAns[] = [
                    'test_id'=> $test_id,
                    'question_number'=> $i,
                    'selected_question'=> TestAnswers::SELECTED_A
                ];
            }
            TestAnswers::insert($dataAns);
        }
        return $detail;
    }

    public function deleteTest($test_id)
    {
        //xóa test answer
        (new TestAnswers)->where('test_id', $test_id)->delete();
        //xóa user test
        $userTest = (new UserTest())->where('test_id', $test_id)->get();
        //xóa user answer
        $userAnswer = new UserAnswer();
        foreach($userTest as $val){
            $userAnswer->where('user_test_id', $val->id)->delete();
        }
        //xóa test
        return $this->where($this->primaryKey, $test_id)->delete();
    }
}
