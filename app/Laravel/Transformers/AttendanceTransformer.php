<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\Attendance;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class AttendanceTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date'
    ];

	public function transform(Attendance $attendance){

		$date_today = Helper::date_db(Carbon::now());
		if(($date_today == Helper::date_db($attendance->login)) AND ($attendance->is_logout == "no")) {
			$status = "gray";
		} else {
			
			if($attendance->num_min >= 480) {
				$time = explode(":", Helper::date_format($attendance->login,"H:i"));
				$num_sec = $time[0]*60+$time[1];
				if($num_sec > 615) {
					$status =  "orange";
				} else{
					$status =  "green";
				}
			}
			else{
				$status =  "red";
			}
		}
		if($date_today == Helper::date_db($attendance->login) AND $attendance->is_logout == "no"){
			$status = "gray";
			$status_display = "Work On-going";
		}else{
			if($attendance->num_min >= 480){
				$time = explode(":", Helper::date_format($attendance->login,"H:i"));
				$num_sec = $time[0]*60+$time[1];
				if($num_sec > 615){
					$status = "orange";
					$status_display = "Late";
				}else{
					$status = "green";
					$status_display = "On-time";

				}
			}else{
				if($attendance->num_min == 0){
					$status = "red";
					$status_display = "No Logout";
				}else{
					$status = "red";
					$status_display = "Undertime";
				}
			}
		}
							


	     return [
		    'id' => $attendance->id,
	     	'task' => $attendance->task ?: "",
			'login' => $attendance->login ? $attendance->date_format($attendance->login, "h:i A") : "-",
			'logout' => $attendance->logout ? $attendance->date_format($attendance->logout, "h:i A") : "-",
			'num_min' => $attendance->num_min ? : 0,
			'total_hrs' => $attendance->num_min ? Helper::convert_to_hr_min($attendance->num_min) : "-",
			// 'admin' => $attendance->admin ? $attendance->admin->name : "---",
			// 'admin_remark' => $attendance->admin_remark,
			// 'reply' => $attendance->reply,
			'status' => $status,
			'status_display'	=> $status_display,
	     ];
	}

	public function includeDate(Attendance $attendance){
        $collection = Collection::make([
				'date_db' => $attendance->created_at ? $attendance->date_db($attendance->created_at) : "",
				'month_date' => $attendance->login ? Helper::date_format($attendance->login,"l") . ", " . Helper::date_format($attendance->login,"F d") : "",
				'month_year' => $attendance->created_at ? $attendance->month_year($attendance->created_at) : "",
				'time_passed' => $attendance->created_at ? $attendance->time_passed($attendance->created_at) : "",
				'timestamp' => $attendance->created_at ? $attendance->created_at : "",
        	]);

        return $this->item($collection, new MasterTransformer);
	}

}