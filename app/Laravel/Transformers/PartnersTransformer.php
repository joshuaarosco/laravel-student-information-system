<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\Partner;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class PartnersTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(Partner $partners){
	     return [
	     	'id' => $partners->id,
	     	'name' => $partners->name,
	     	'email' => $partners->email,
	     	'details' => $partners->details,
	     	'directory' => $partners->directory,
	     	'filename' => $partners->filename,
	     ];
	}

	public function includeDate(Partner $partners){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $partners->date_db($partners->created_at),
    				'month_year' => $partners->month_year($partners->created_at),
    				'time_passed' => $partners->time_passed($partners->created_at),
    				'timestamp' => $partners->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(Partner $partners){
		$collection = Collection::make([
	     	'name' => $partners->name,
	     	'email' => $partners->email,
	     	'details' => $partners->details,
	     	'directory' => $partners->directory,
	     	'filename' => $partners->filename,
	     	'avatar' => [
				'path' => $partners->directory,
	 			'filename' => $partners->filename,
	 			'path' => $partners->path,
	 			'directory' => $partners->directory,
	 			'full_path' => "{$partners->directory}/resized/{$partners->filename}",
	 			'thumb_path' => "{$partners->directory}/thumbnails/{$partners->filename}",
			],
		]);

		return $this->item($collection, new MasterTransformer);
	}

}