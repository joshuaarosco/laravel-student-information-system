<?php


/**
 *
 * ------------------------------------
 * Frontend Routes
 * ------------------------------------
 *
 */

$this->group(

	array(
		'as' => "frontend.",
		'namespace' => "Frontend",
	),

	function() {

		$this->get('/',['as' => "index",'uses' => "PageController@index"]);
		$this->get('contact',['as' => "contact",'uses' => "PageController@contact"]);
		$this->post('contact',['uses' => "PageController@sent"]);
	}
);