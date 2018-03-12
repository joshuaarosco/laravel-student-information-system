<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StudentInformation extends Authenticatable
{
    use SoftDeletes;
    
    protected $table = "student_additional_information";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gender','birthdate','age_of_first_friday_june','mother_tounge','ip','religion','house_street','barangay','municipality','province','fathers_name','mothers_name','guardian_name','relationship','remarks'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
