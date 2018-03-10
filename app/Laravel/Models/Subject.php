<?php

namespace App\Laravel\Models;

use App\Laravel\Models\Grade;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subject extends Authenticatable
{

    use SoftDeletes;
    
    protected $table = "subjects";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['teacher_id','subject_title','subject_code','school_year'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function teacher(){
        return $this->belongsTo("App\Laravel\Models\User","teacher_id","id");
    }

    public function class_record($class_id,$subject_id,$student_id){
        $grade = Grade::where('class_id',$class_id)->where('subject_id',$subject_id)->where('student_id',$student_id)->first();

        return $grade;
    }

    public function encode_grade($section_id,$subject_id,$student_id){
        $grade = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->where('student_id',$student_id)->first();

        return $grade;
    }
}
