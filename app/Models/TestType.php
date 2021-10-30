<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    //
    protected $table = 'test_type';
    protected $fillable = ['class_id', 'title'];

    public function class()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function createOrUpdate($request)
    {
        $data = [
            'class_id'=>$request->class_id,
            'title'=>Ultilities::clearXSS($request->title)
        ];
        if(!empty($request->id)){
            return $this->where($this->primaryKey, $request->id)->update($data);
        }
        return $this->create($data);
    }

    public function getTestType($class_id = null)
    {
        $data = $this;
        if(!empty($class_id)){
            $data = $data->where('class_id', $class_id);
        }
        return $data->get();
    }
}
