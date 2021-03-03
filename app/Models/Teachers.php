<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Ultilities;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Teachers extends Authenticatable
{
    //
    use Notifiable;
    protected $table = 'teachers';
    protected $fillable = ['name', 'description', 'avatar', 'phone', 'email', 'dob', 'subject_id', 'address', 'city_id', 'district_id',
    'ward_id', 'gender', 'password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function getTeacher()
    {
        return $this->get();
    }

    public function detail($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    public function createTeacher($request)
    {
        $data = [
            'name'=>Ultilities::clearXSS($request->name),
            'phone'=>Ultilities::clearXSS($request->phone),
            'email'=>Ultilities::clearXSS($request->email),
            'subject_id'=>Ultilities::clearXSS($request->subject),
            'address'=>Ultilities::clearXSS($request->address),
            'description'=>Ultilities::clearXSS($request->description),
            'password'=>bcrypt('123456'),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'avatar'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        return $this->create($data);
    }

    public function updateTeacher($request)
    {
        $data = [
            'name'=>Ultilities::clearXSS($request->name),
            'phone'=>Ultilities::clearXSS($request->phone),
            'email'=>Ultilities::clearXSS($request->email),
            'subject_id'=>Ultilities::clearXSS($request->subject),
            'address'=>Ultilities::clearXSS($request->address),
            'password'=>bcrypt('123456'),
            'description'=>Ultilities::clearXSS($request->description),
        ];
        if($request->hasFile('image')){
            $files = $request->file('image');
            $plus = [
                'avatar'=>Ultilities::uploadFile($files),
            ];
            $data += $plus;
        }
        return $this->where($this->primaryKey, $request->teacher_id)->update($data);
    }
}
