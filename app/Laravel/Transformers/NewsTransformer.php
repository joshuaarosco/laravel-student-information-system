<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\News;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class NewsTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(News $news){
	     return [
	     	'id' => $news->id,
	     	'title' => $news->title,
	     	'content' => $news->content,
	     	'directory' => $news->directory,
	     	'filename' => $news->filename,
	     ];
	}

	public function includeDate(News $news){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $news->date_db($news->created_at),
    				'month_year' => $news->month_year($news->created_at),
    				'time_passed' => $news->time_passed($news->created_at),
    				'timestamp' => $news->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(News $news){
		$collection = Collection::make([
			'title' => $news->title,
			'content' => $news->content,
			'directory' => $news->directory,
			'filename' => $news->filename,
			'avatar' => [
				'path' => $news->directory,
	 			'filename' => $news->filename,
	 			'path' => $news->path,
	 			'directory' => $news->directory,
	 			'full_path' => "{$news->directory}/resized/{$news->filename}",
	 			'thumb_path' => "{$news->directory}/thumbnails/{$news->filename}",
			],
		]);

		return $this->item($collection, new MasterTransformer);
	}

}