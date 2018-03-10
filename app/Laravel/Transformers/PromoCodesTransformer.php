<?php

namespace App\Laravel\Transformers;

use App\Laravel\Models\PromoCode;


use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;

use DB,Helper,Str,Cache,Carbon,Input;

class PromoCodesTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'date','info'
    ];

	public function transform(PromoCode $promo_codes){
	     return [
	     	'id' => $promo_codes->id,
	     	'qr_code' => $promo_codes->qr_code,
	     	// 'qr_code_link' => $promo_codes->qr_code_link,
	     	'points' => $promo_codes->points,
	     	'details' => $promo_codes->details,
	     ];
	}

	public function includeDate(PromoCode $promo_codes){
        $collection = Collection::make([
    			'added_in'	=> [
    				'date_db' => $promo_codes->date_db($promo_codes->created_at),
    				'month_year' => $promo_codes->month_year($promo_codes->created_at),
    				'time_passed' => $promo_codes->time_passed($promo_codes->created_at),
    				'timestamp' => $promo_codes->created_at
    			],
        	]);

        return $this->item($collection, new MasterTransformer);
	}

	public function includeInfo(PromoCode $promo_codes){
		$collection = Collection::make([
	     	'qr_code' => $promo_codes->qr_code,
	     	// 'qr_code_link' => $promo_codes->qr_code_link,
	     	'points' => $promo_codes->points,
	     	'details' => $promo_codes->details,
		]);

		return $this->item($collection, new MasterTransformer);
	}

}