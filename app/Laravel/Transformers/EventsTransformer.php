<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\Event;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class EventsTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(Event $event){
	     return [
	     	'id' => $event->id,
	     	'title' => $event->title,
	     	'details' => $event->details,
	     	'start' => $event->start,
	     	'end' => $event->end,
	     	'directory' => $event->directory,
	     	'filename' => $event->filename,
	     ];
	}

	public function includeDate(Event $event){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $event->date_db($event->created_at),
    				'month_year' => $event->month_year($event->created_at),
    				'time_passed' => $event->time_passed($event->created_at),
    				'timestamp' => $event->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(Event $event){
		$collection = Collection::make([
			'title' => $event->title,
			'details' => $event->details,
	     	'start' => $event->start,
	     	'end' => $event->end,
			'directory' => $event->directory,
			'filename' => $event->filename,
			'avatar' => [
				'path' => $event->directory,
	 			'filename' => $event->filename,
	 			'path' => $event->path,
	 			'directory' => $event->directory,
	 			'full_path' => "{$event->directory}/resized/{$event->filename}",
	 			'thumb_path' => "{$event->directory}/thumbnails/{$event->filename}",
			],
		]);

		return $this->item($collection, new MasterTransformer);
	}

}