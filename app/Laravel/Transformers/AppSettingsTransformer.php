<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\AppSetting;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class AppSettingsTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(AppSetting $app_settings){
	     return [
	     	'id' => $app_settings->id,
	     	'type' => $app_settings->type,
	     	'title' => $app_settings->title,
	     	'content' => $app_settings->content,
	     ];
	}

	public function includeDate(AppSetting $app_settings){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $app_settings->date_db($app_settings->created_at),
    				'month_year' => $app_settings->month_year($app_settings->created_at),
    				'time_passed' => $app_settings->time_passed($app_settings->created_at),
    				'timestamp' => $app_settings->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(AppSetting $app_settings){
		$collection = Collection::make([
	     	'type' => $app_settings->type,
	     	'title' => $app_settings->title,
	     	'content' => $app_settings->content,
		]);

		return $this->item($collection, new MasterTransformer);
	}

}