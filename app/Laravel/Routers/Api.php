<?php


/**
 *
 * ------------------------------------
 * Api Routes
 * ------------------------------------
 *
 */

Route::group(

	array(
		'as' => "api.",
		'namespace' => "Api",
	),

	function() {
		$this->group(['middleware' => "jwt.auth"], function(){
			$this->group(['prefix' => "news"],function(){
				$this->any('all.{format?}',['uses' => "NewsController@all"]);
				$this->any('show.{format?}',['uses' => "NewsController@show"]);
				$this->any('by-date.{format?}',['uses' => "NewsController@by_date"]);
			});

			$this->group(['prefix' => "announcements"],function(){
				$this->any('all.{format?}',['uses' => "AnnouncementController@all"]);
				$this->any('show.{format?}',['uses' => "AnnouncementController@show"]);
				$this->any('by-date.{format?}',['uses' => "AnnouncementController@by_date"]);
			});

			$this->group(['prefix' => "events"],function(){
				$this->any('all.{format?}',['uses' => "EventsController@all"]);
				$this->any('show.{format?}',['uses' => "EventsController@show"]);
				$this->any('by-date.{format?}',['uses' => "EventsController@by_date"]);
			});

			$this->group(['prefix' => "promo-codes"],function(){
				$this->any('all.{format?}',['uses' => "PromoCodesController@all"]);
				$this->any('show.{format?}',['uses' => "PromoCodesController@show"]);
				$this->any('by-date.{format?}',['uses' => "PromoCodesController@by_date"]);
			});

			$this->group(['prefix' => "app-settings"],function(){
				$this->any('all.{format?}',['uses' => "AppSettingsController@all"]);
				$this->any('show.{format?}',['uses' => "AppSettingsController@show"]);
				$this->any('by-date.{format?}',['uses' => "AppSettingsController@by_date"]);
			});

			$this->group(['prefix' => "partners"],function(){
				$this->any('all.{format?}',['uses' => "PartnersController@all"]);
				$this->any('show.{format?}',['uses' => "PartnersController@show"]);
				$this->any('by-date.{format?}',['uses' => "PartnersController@by_date"]);
			});
		});
		

		$this->post('summernote-upload.{data_format?}',['as' => "summernote",'uses' => "SummernoteController@upload"]);

		$this->group(['as' => "helper.", 'prefix' => "helper"], function (){
			$this->any('link-preview.{format?}', ['as' => "link_preview_v2", 'uses' => "HTMLCrawlerController@link_preview_v2"]);
			$this->any('old-link-preview.{format?}', ['as' => "link_preview", 'uses' => "HTMLCrawlerController@link_preview"]);
		});

		$this->any('app-settings.{format?}', ['as' => "index", 'uses' => "AppSettingController@index"]);

		$this->group(['as' => "auth.", 'prefix' => "auth", 'namespace' => "Auth"], function () {
			$this->post('login.{format?}', ['as' => "login", 'uses' => "LoginController@authenticate"]);
			$this->post('fb-login.{format?}', ['as' => "fb_login", 'uses' => "FacebookLoginController@authenticate"]);
			$this->post('register.{format?}', ['as' => "register", 'uses' => "RegisterController@store"]);
			$this->post('forgot-password.{format?}', ['as' => "forgot_password", 'uses' => "ForgotPasswordController@forgot_password"]);
			$this->post('reset-password.{format?}', ['as' => "reset_password", 'uses' => "ResetPasswordController@reset_password", 'middleware' => "api.verify-reset-token"]);
			$this->post('logout.{format?}', ['as' => "logout", 'uses' => "LoginController@logout"/*, 'middleware' => "jwt.auth"*/]);
			$this->post('refresh-token.{format?}', ['as' => "refresh_token", 'uses' => "RefreshTokenController@refresh", 'middleware' => "jwt.refresh"]);
		});

		//All routes protected by authentication
		// $this->group(['middleware' => "jwt.auth"], function() {

			$this->post('pusher/notify.{format?}', ['uses' => "PusherController@notify"]);

			$this->group(['as' => "profile.", 'prefix' => "profile"], function() {
				$this->any('info.{format?}', ['as' => "show", 'uses' => "ProfileController@show"]);
				$this->post('edit.{format?}', ['as' => "update_profile", 'uses' => "ProfileController@update_profile"]);
				$this->post('change-password.{format?}', ['as' => "update_password", 'uses' => "ProfileController@update_password"]);
				$this->post('change-fcm-token.{format?}', ['as' => "update_device", 'uses' => "ProfileController@update_device"]);
				$this->post('fb-connect.{format?}', ['as' => "fb_connect", 'uses' => "ProfileController@fb_connect"]);
			});

			$this->group(['as' => "notifications.", 'prefix' => "notifications"], function() {
				$this->any('all.{format?}', ['as' => "index", 'uses' => "NotificationController@index"]);
				$this->any('unread-count.{format?}', ['as' => "unread_count", 'uses' => "NotificationController@unread_count"]);
				$this->any('show.{format?}', ['as' => "show", 'uses' => "NotificationController@show", 'middleware' => "api.exists:notification"]);
				$this->any('read.{format?}', ['as' => "read", 'uses' => "NotificationController@read", 'middleware' => "api.exists:notification"]);
				$this->any('unread.{format?}', ['as' => "unread", 'uses' => "NotificationController@unread", 'middleware' => "api.exists:notification"]);
				$this->any('delete.{format?}', ['as' => "destroy", 'uses' => "NotificationController@destroy", 'middleware' => "api.exists:notification"]);
				$this->any('read-all.{format?}', ['as' => "read_all", 'uses' => "NotificationController@read_all"]);
				$this->any('unread-all.{format?}', ['as' => "unread_all", 'uses' => "NotificationController@unread_all"]);
				$this->any('delete-all.{format?}', ['as' => "destroy_all", 'uses' => "NotificationController@destroy_all"]);
			});

			$this->group(['as' => "user.", 'prefix' => "users"], function() {
				$this->any('show.{format?}', [ 'as' => "show", 'uses' => "UserController@show" , 'middleware' => "api.exists:user"]);
				$this->post('search.{format?}', [ 'as' => "search", 'uses' => "UserController@search"]);
			});

			$this->group(['as' => "general_requests.", 'prefix' => "general-requests"], function() {
				$this->any('all.{format?}', [ 'as' => "index", 'uses' => "GeneralRequestController@index"]);
				$this->any('compact.{format?}', [ 'as' => "compact", 'uses' => "GeneralRequestController@compact"]);
			});

			$this->group(['as' => "social.", 'prefix' => "social"], function() {
				$this->any('feed.{format?}', [ 'as' => "feed", 'uses' => "SocialController@feed"]);
				$this->any('suggestions.{format?}', [ 'as' => "suggestions", 'uses' => "SocialController@suggestions"]);
				$this->any('followers.{format?}', [ 'as' => "followers", 'uses' => "SocialController@followers", 'middleware' => "api.exists:user"]);
				$this->any('following.{format?}', [ 'as' => "following", 'uses' => "SocialController@following", 'middleware' => "api.exists:user"]);
				$this->post('follow.{format?}', [ 'as' => "follow", 'uses' => "SocialController@follow", 'middleware' => "api.exists:user"]);
				$this->post('unfollow.{format?}', [ 'as' => "unfollow", 'uses' => "SocialController@unfollow", 'middleware' => "api.exists:user"]);
			});

		// });
		
	}
);