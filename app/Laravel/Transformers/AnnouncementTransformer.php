<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\Announcement;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class AnnouncementTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(Announcement $announcement){
	     return [
	     	'id' => $announcement->id,
	     	'title' => $announcement->title,
	     	'content' => $announcement->content,
	     	'directory' => $announcement->directory,
	     	'filename' => $announcement->filename,
	     ];
	}

	public function includeDate(Announcement $announcement){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $announcement->date_db($announcement->created_at),
    				'month_year' => $announcement->month_year($announcement->created_at),
    				'time_passed' => $announcement->time_passed($announcement->created_at),
    				'timestamp' => $announcement->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(Announcement $announcement){
		$collection = Collection::make([
			'title' => $announcement->title,
			'content' => $announcement->content,
			'directory' => $announcement->directory,
			'filename' => $announcement->filename,
			'avatar' => [
				'path' => $announcement->directory,
	 			'filename' => $announcement->filename,
	 			'path' => $announcement->path,
	 			'directory' => $announcement->directory,
	 			'full_path' => "{$announcement->directory}/resized/{$announcement->filename}",
	 			'thumb_path' => "{$announcement->directory}/thumbnails/{$announcement->filename}",
			],
		]);

		return $this->item($collection, new MasterTransformer);
	}

}