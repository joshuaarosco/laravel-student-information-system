<?php


/**
 *
 * ------------------------------------
 * Backoffice Routes
 * ------------------------------------
 *
 */

Route::group(

	array(
		'as' => "backoffice.",
		'prefix' => "admin",
		'namespace' => "Backoffice",
	),

	function() {

		$this->group(['as'=>"auth.", 'middleware' => ["web","backoffice.guest"]], function(){
			$this->get('login',['as' => "login",'uses' => "AuthController@login"]);
			$this->post('login',['uses' => "AuthController@authenticate"]);
		});

		$this->group(['middleware' => "backoffice.auth"], function(){

			$this->get('/',['as' => "dashboard",'uses' => "DashboardController@index"]);
			$this->get('voters',['as' => "voters",'uses' => "VotersController@index"]);
			$this->get('logout',['as' => "logout",'uses' => "AuthController@destroy"]);


			$this->group(['prefix' => "profile", 'as' => "profile."], function () {
				$this->get('/',['as' => "settings", 'uses' => "ProfileController@setting"]);
				$this->post('/',['uses' => "ProfileController@update_setting"]);
				$this->post('update-password',['as' => "update_password",'uses' => "ProfileController@update_password"]);
			});

			$this->group(['prefix' => "employees", 'as' => "employee.",'middleware' => "backoffice.super_user_only"], function () {
				$this->get('/',['as' => "index", 'uses' => "EmployeeController@index"]);
				$this->get('create',['as' => "create", 'uses' => "EmployeeController@create"]);
				$this->post('create',['uses' => "EmployeeController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "EmployeeController@edit"]);
				$this->post('edit/{id?}',['uses' => "EmployeeController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "EmployeeController@destroy"]);
			});

			$this->group(['prefix' => "faculties", 'as' => "teachers."], function () {
				$this->get('/',['as' => "index", 'uses' => "TeacherController@index"]);
				$this->get('create',['as' => "create", 'uses' => "TeacherController@create"]);
				$this->post('create',['uses' => "TeacherController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "TeacherController@edit"]);
				$this->post('edit/{id?}',['uses' => "TeacherController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "TeacherController@destroy"]);
			});

			$this->group(['prefix' => "sections", 'as' => "sections."], function () {
				$this->get('/',['as' => "index", 'uses' => "SectionController@index"]);
				$this->get('create',['as' => "create", 'uses' => "SectionController@create"]);
				$this->post('create',['uses' => "SectionController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "SectionController@edit"]);
				$this->post('edit/{id?}',['uses' => "SectionController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "SectionController@destroy"]);
			});

			$this->group(['prefix' => "students", 'as' => "students."], function () {
				$this->get('/',['as' => "index", 'uses' => "StudentController@index"]);
				$this->get('create',['as' => "create", 'uses' => "StudentController@create"]);
				$this->post('create',['uses' => "StudentController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "StudentController@edit"]);
				$this->post('edit/{id?}',['uses' => "StudentController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "StudentController@destroy"]);
			});

			$this->group(['prefix' => "subjects", 'as' => "subjects."], function () {
				$this->get('/',['as' => "index", 'uses' => "SubjectController@index"]);
				$this->get('create',['as' => "create", 'uses' => "SubjectController@create"]);
				$this->post('create',['uses' => "SubjectController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "SubjectController@edit"]);
				$this->post('edit/{id?}',['uses' => "SubjectController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "SubjectController@destroy"]);
			});

			$this->group(['prefix' => "classes", 'as' => "classes."], function () {
				$this->get('/',['as' => "index", 'uses' => "ClassController@index"]);
				$this->get('create',['as' => "create", 'uses' => "ClassController@create"]);
				$this->post('create',['uses' => "ClassController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "ClassController@edit"]);
				$this->post('edit/{id?}',['uses' => "ClassController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "ClassController@destroy"]);
				$this->get('students/{id?}',['as' => "students", 'uses' => "ClassController@students"]);
				$this->post('update-grades/{id?}/{subject_id?}',['as' => "update_grades", 'uses' => "ClassController@update_grades"]);
			});

			$this->group(['prefix' => "class-record", 'as' => "class_record."], function () {
				$this->get('/',['as' => "index", 'uses' => "ClassRecordController@index"]);
				$this->get('section/{id}',['as' => "section", 'uses' => "ClassRecordController@section"]);
				$this->get('encode/{section_id}/{subject_id}',['as' => "encode", 'uses' => "ClassRecordController@encode"]);
				$this->post('update-grades/{section_id?}/{subject_id?}',['as' => "update_grades", 'uses' => "ClassRecordController@update_grades"]);
			});

			$this->group(['prefix' => "advisory-class", 'as' => "advisory_class."], function () {
				$this->get('/',['as' => "index", 'uses' => "AdvisoryClassController@index"]);
				$this->get('students/{id}',['as' => "students", 'uses' => "AdvisoryClassController@students"]);
			});

		});
	}
);