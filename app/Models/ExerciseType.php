<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class ExerciseType extends Model
{
    //
    protected $table = 'exercise_type';
    protected $fillable = ['subject_id', 'class_id', 'title', 'description', 'image'];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function getTypeEx()
    {
        return $this->get();
    }

    public function detail($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    public function createNewTypeEx($request)
    {
        $data = [
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'title'=>Ultilities::clearXSS($request->title),
            'class_id'=>Ultilities::clearXSS($request->class_id),
            'description'=>Ultilities::clearXSS($request->description),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'image'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        return $this->create($data);
    }

    public function updateTypeEx($request)
    {
        $data = [
            'subject_id'=>Ultilities::clearXSS($request->subject_id),
            'title'=>Ultilities::clearXSS($request->title),
            'class_id'=>Ultilities::clearXSS($request->class_id),
            'description'=>Ultilities::clearXSS($request->description),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'image'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        return $this->where($this->primaryKey, $request->type_id)->update($data);
    }

}
