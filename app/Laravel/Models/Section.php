<?php

namespace App\Laravel\Models;
use App\Laravel\Models\ClassList;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Section extends Authenticatable
{
    use SoftDeletes;
    

    protected $table = "sections";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['adviser_id','school_year','section_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function adviser(){
        return $this->belongsTo("App\Laravel\Models\User","adviser_id","id");
    }

    public function number_of_students($id){
        $class = ClassList::where('section_id',$id)->first();
        
        return $class;
    }
}
