<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Grade extends Authenticatable
{

    use SoftDeletes;
    
    protected $table = "grades";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['section_id','subject_id','student_id','first_grading','second_grading','third_grading','fourth_grading','average'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
