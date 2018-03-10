<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\AppSetting;
use App\Laravel\Models\VersionControl;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\AppSettingRequest;
use App\Laravel\Requests\Backoffice\VersionRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image;

class AppSettingsController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "App Settings";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['types'] = [''=>"Choose type",'about_the_app'=>"About the App",'mission'=>"Mission",'vision'=>"Vision"];
		$this->data['route_file'] = "app_settings";
	}

	public function index () {
		$this->data['app_settings'] = AppSetting::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function version () {
		$this->data['version_control'] = VersionControl::orderBy('created_at',"DESC")->first();
		return view('backoffice.'.$this->data['route_file'].'.version',$this->data);
	}

	public function update_version (VersionRequest $request) {
		try{

			$new_version = new VersionControl;

			$new_version->fill($request->all());

			if($new_version->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"The Version has been updated.");
				return redirect()->back();
			}

		}catch(Exception $e){
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}


	}

	public function edit ($id = NULL) {
		$app_settings = AppSetting::find($id);

		if (!$app_settings) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['app_settings'] = $app_settings;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (AppSettingRequest $request, $id = NULL) {
		try {
			$app_settings = AppSetting::find($id);

			if (!$app_settings) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$app_settings->fill($request->all());

			if($app_settings->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"The ".$app_settings->title." has been updated.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			Session::flash('notification-status','failed');
			Session::flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

}