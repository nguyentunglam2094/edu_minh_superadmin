<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class ExerciseType extends Model
{
    //
    protected $table = 'exercise_type';
    protected $fillable = ['subject_id','code', 'class_id', 'title', 'description', 'image', 'theme_id'];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function theme()
    {
        return $this->hasOne(Themes::class, 'id', 'theme_id');
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
            'title'=>Ultilities::clearXSS($request->title),
            'theme_id'=>Ultilities::clearXSS($request->theme_id),
            'description'=>Ultilities::clearXSS($request->description),
            'code'=>Ultilities::clearXSS($request->code),
            'subject_id'=>0,
            'class_id'=>0,
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
            'title'=>Ultilities::clearXSS($request->title),
            'subject_id'=>0,
            'class_id'=>0,
            'description'=>Ultilities::clearXSS($request->description),
            'theme_id'=>Ultilities::clearXSS($request->theme_id),
            'code'=>Ultilities::clearXSS($request->code),
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
