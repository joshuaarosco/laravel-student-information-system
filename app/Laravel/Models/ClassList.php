<?php

namespace App\Laravel\Models;

use App\Laravel\Models\Subject;
use App\Laravel\Models\ClassList;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClassList extends Authenticatable
{

    use SoftDeletes;
    
    protected $table = "class";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['section_id','student_ids','subject_ids'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function section(){
        return $this->belongsTo("App\Laravel\Models\Section","section_id","id");
    }

    public function subjects($array){
        $subjects = [];
        foreach($array as $id){
            $subject = Subject::find($id);
            array_push($subjects,$subject->subject_title);
        }

        return implode(', ',$subjects);
    }
}
