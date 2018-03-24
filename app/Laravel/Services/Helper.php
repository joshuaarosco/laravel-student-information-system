<?php

namespace App\Laravel\Services;

use App\Laravel\Models\ResponseMessage;
use Illuminate\Support\Facades\Cache;
use Carbon, Str, Route;

class Helper {

	public static function date_format($time,$format = "M d, Y @ h:i a") {
		return $time == "0000-00-00 00:00:00" ? "" : date($format,strtotime($time));
	}

	public static function time_passed($time){
		// $current_date = Carbon::now();
		// $secsago = strtotime($current_date) - strtotime($time);
		// $nice_date = 1;
		// if ($secsago < 60):
		// 	if($secsago < 30){ return "just now";}
		//     $period = $secsago == 1 ? '1 sec'     : $secsago . ' sec';
		// elseif ($secsago < 3600) :
		//     $period    =   floor($secsago/60);
		//     $period    =   $period == 1 ? '1 min' : $period . ' min';
		// elseif ($secsago < 86400):
		//     $period    =   floor($secsago/3600);
		//     $period    =   $period == 1 ? '1 hr'   : $period . ' hr';
		// elseif ($secsago < 432000):
		//     $period    =   floor($secsago/86400);
		//     $period    =   $period == 1 ? '1 day'    : $period . ' days';
		// else:
		//    $nice_date = 0;
		//    $period = date("M d, Y",strtotime($time));
		//    if(date('Y',strtotime(Carbon::now())) == date("Y",strtotime($time))){
		//    		$period = date("M d",strtotime($time));
		//    }
		// endif;
		// if($nice_date == 1)
		// 	return $period." ago";
		// else
		// 	return $period;
		$date = Carbon::parse($time);

    	if($date->format("Y-m-d") == Carbon::now()->format("Y-m-d")) {
    		return /*"Today " . */$date->format("h:i a");
    	} elseif ($date->between(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek())) {
    		// return $date->format("D h:i a");
    		return $date->format("D")." at ".$date->format("h:i a");
    	} elseif ($date->format("Y") == Carbon::now()->format("Y")) {
    		return $date->format("d/M")." at ".$date->format("h:i a");
    	} else {
    		return $date->format("d/M Y")." at ".$date->format("h:i a");
    	}
	}

	public static function month_year($time){
		return date('M Y',strtotime($time));
	}

	public static function date_db($time){
		if(env('DB_CONNECTION','mysql') == "sqlsrv"){
			return date(env('DATEDBSQL_FORMAT','m/d/Y'),strtotime($time));
		}else{
			return date(env('DATEDB_FORMAT','Y-m-d'),strtotime($time));
		}
	}

	public static function datetime_db($time){
		if(env('DB_CONNECTION','mysql') == "sqlsrv"){
			return date(env('DATEDBSQL_FORMAT','m/d/Y H:i:s'),strtotime($time));
		}else{
			return date(env('DATEDB_FORMAT','Y-m-d H:i:s'),strtotime($time));
		}
	}

	public static function create_filename($ext) {
		return str_random(20). date("mdYhs") . "." . $ext;
	}

	public static function create_username($name, $counter = 0) {
		return $counter > 0 ? substr(Str::slug($name,""), 0, 19) . ++$counter : substr(Str::slug($name,""), 0, 20);
	}

	public static function str_contract($str) {
		return in_array(substr($str, -1), ['s', "S"]) ? $str . "'" : $str . "'s";
	}

	public static function key_prefix($prefix, array $array = []) {
		foreach($array as $k=>$v){
            $array[$prefix.$k] = $v;
            unset($array[$k]);
        }
        return $array; 
	}

	public static function mask_urls($str, $replace = "{link}") {
		$pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		return preg_replace($pattern, $replace, $str);
	}

	public static function clean_url($url) {


		// multiple /// messes up parse_url, replace 2+ with 2
		$url = preg_replace('/(\/{2,})/','//',$url);

		$parse_url = parse_url($url);

		if(empty($parse_url["scheme"])) {
		    $parse_url["scheme"] = "http";
		}
		if(empty($parse_url["host"]) && !empty($parse_url["path"])) {
		    // Strip slash from the beginning of path
		    $parse_url["host"] = ltrim($parse_url["path"], '\/');
		    $parse_url["path"] = "";
		}   

		$return_url = "";

		// Check if scheme is correct
		if(!in_array($parse_url["scheme"], array("http", "https", "gopher"))) {
		    $return_url .= 'http'.'://';
		} else {
		    $return_url .= $parse_url["scheme"].'://';
		}

		// Check if the right amount of "www" is set.
		$explode_host = explode(".", $parse_url["host"]);

		// Remove empty entries
		$explode_host = array_filter($explode_host);
		// And reassign indexes
		$explode_host = array_values($explode_host);

		// Contains subdomain
		if(count($explode_host) > 2) {
		    // Check if subdomain only contains the letter w(then not any other subdomain).
		    if(substr_count($explode_host[0], 'w') == strlen($explode_host[0])) {
		        // Replace with "www" to avoid "ww" or "wwww", etc.
		        $explode_host[0] = "www";

		    }
		}

		$return_url .= implode(".",$explode_host);

		if(!empty($parse_url["port"])) {
		    $return_url .= ":".$parse_url["port"];
		}
		if(!empty($parse_url["path"])) {
		    $return_url .= $parse_url["path"];
		}
		if(!empty($parse_url["query"])) {
		    $return_url .= '?'.$parse_url["query"];
		}
		if(!empty($parse_url["fragment"])) {
		    $return_url .= '#'.$parse_url["fragment"];
		}

		return $return_url;
	}

	public static function get_response_message($code, array $vars = []) {
		$response = "";
		$response_message = Cache::remember($code . implode(".", $vars), 1440, function() use($code) {
			return ResponseMessage::where('code', $code)->first();
		});

		if($response_message) {
			$response = $response_message->content;
			foreach ($vars as $key => $value) {
				$response = str_replace('{'.strtolower($key).'}', $value, $response);
			}
		}
		return $response;
	}

	public static function is_active(array $routes, $class = "active") {
		return  in_array(Route::currentRouteName(), $routes) ? $class : NULL;
	}

	public static function type_badge($col) {
		$status = Str::lower($col);
		switch ($status) {
			case 'sales_agent': $badge = "<span class='tag tag-default tag-info tag-default'>" . Str::upper(str_replace("_", " ", $col)) . "</span>"; break;
			default: $badge = "<span class='tag tag-default tag-primary tag-default'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
		}

		return $badge;
	}

	public static function status_badge($col) {
		$status = Str::lower($col);
		switch ($status) {
			case 'no': $badge = "<span class='label label-block label-striped border-left-grey'>" . Str::upper(str_replace("_", " ", "For Approval")) . "</span>"; break;
			case 'yes': $badge = "<span class='label label-block label-striped border-left-success'>" . Str::upper(str_replace("_", " ", "Approved")) . "</span>"; break;
			case 'active': $badge = "<span class='notice notice-blue label label-success'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'expired': $badge = "<span class='notice notice-danger label label-danger'>" . Str::upper(str_replace("_", " ", $status)) . "</span>";  break;
			case 'paid': $badge = "<span class='notice notice-blue label label-success'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'pending': $badge = "<span class='notice notice-warning label label-warning'>" . Str::upper(str_replace("_", " ", $status)) . "</span>";  break;
			case 'overdue': $badge = "<span class='notice notice-danger label label-danger'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'open': $badge = "<span class='notice notice-blue label label-info'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'closed': $badge = "<span class='notice notice-default label label-default'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'low': $badge = "<span class='notice notice-blue label label-sold'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'medium': $badge = "<span class='notice notice-warning label label-warning'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			case 'high': $badge = "<span class='notice notice-danger label label-danger'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
			default: $badge = "<span class='label label-block label-striped border-left-default'>" . Str::upper(str_replace("_", " ", $status)) . "</span>"; break;
		}

		return $badge;
	}

	public static function formatSizeUnits($bytes)
	{
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}

		return $bytes;
	}

	public static function ranking_system($points,$user_id){
		
	}

}