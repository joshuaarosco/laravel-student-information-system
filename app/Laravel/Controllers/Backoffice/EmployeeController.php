<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\User;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\EmployeeRequest;
use App\Laravel\Requests\Backoffice\EditEmployeeRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image;

class EmployeeController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Employees";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "employee";
		$this->data['types'] = [''=>'Choose type','admin'=>"Admin",'super_user'=>"Super User"];
	}

	public function index () {
		$this->data['employees'] = User::orderBy('created_at',"DESC")->where('type','!=','super_user')->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (EmployeeRequest $request) {
		try {
			$new_employee = new User;
			$new_employee->fill($request->all());
			$new_employee->email = Str::lower($request->get('email'));
			$new_employee->password = bcrypt($request->get('password'));

			if($request->hasFile('file')){
				$upload = $this->__upload($request);
				$new_employee->directory = $upload["directory"];
				$new_employee->filename = $upload["filename"];
			}

			if($new_employee->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"New employee has been added.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			Session::flash('notification-status','failed');
			Session::flash('notification-msg','Something went wrong.');

			return redirect()->back();
		} catch (Exception $e) {
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function edit ($id = NULL) {
		$employee = User::find($id);

		if (!$employee) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['employee'] = $employee;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (EditEmployeeRequest $request, $id = NULL) {
		try {
			$employee = User::find($id);

			if (!$employee) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$employee->fill($request->all());

			if($request->has('password')){
				$employee->password =  bcrypt($request->get('password'));
			}

			if($request->hasFile('file')){
				$upload = $this->__upload($request);
				if($upload){	
					if (File::exists("{$employee->directory}/{$employee->filename}")){
						File::delete("{$employee->directory}/{$employee->filename}");
					}
					if (File::exists("{$employee->directory}/resized/{$employee->filename}")){
						File::delete("{$employee->directory}/resized/{$employee->filename}");
					}
					if (File::exists("{$employee->directory}/thumbnails/{$employee->filename}")){
						File::delete("{$employee->directory}/thumbnails/{$employee->filename}");
					}
				}
				
				$employee->directory = $upload["directory"];
				$employee->filename = $upload["filename"];
			}

			if($employee->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"An employee has been updated.");
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

	public function destroy ($id = NULL) {
		try {
			$employee = User::find($id);

			$employee->email = $id."@domain.com";

			if (!$employee) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$employee->directory}/{$employee->filename}")){
				File::delete("{$employee->directory}/{$employee->filename}");
			}
			if (File::exists("{$employee->directory}/resized/{$employee->filename}")){
				File::delete("{$employee->directory}/resized/{$employee->filename}");
			}
			if (File::exists("{$employee->directory}/thumbnails/{$employee->filename}")){
				File::delete("{$employee->directory}/thumbnails/{$employee->filename}");
			}

			if($employee->save() AND $employee->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"An employee has been deleted.");
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

	/**
	*
	*@param App\Http\Requests\RequestRequest $request
	*@param string $request
	*
	*@return array
	*/
	private function __upload(Request $request, $directory = "uploads/employee"){
		$file = $request->file("file");
		$ext = $file->getClientOriginalExtension();

		$path_directory = $directory."/".Helper::date_format(Carbon::now(),"Ymd");
		$resized_directory = $directory."/".Helper::date_format(Carbon::now(),"Ymd")."/resized";
		$thumb_directory = $directory."/".Helper::date_format(Carbon::now(),"Ymd")."/thumbnails";

		if (!File::exists($path_directory)){
			File::makeDirectory($path_directory, $mode = 0777, true, true);
		}

		if (!File::exists($resized_directory)){
			File::makeDirectory($resized_directory, $mode = 0777, true, true);
		}

		if (!File::exists($thumb_directory)){
			File::makeDirectory($thumb_directory, $mode = 0777, true, true);
		}

		$filename = Helper::create_filename($ext);

		$file->move($path_directory, $filename); 
		Image::make("{$path_directory}/{$filename}")->save("{$resized_directory}/{$filename}",90);
		Image::make("{$path_directory}/{$filename}")->resize(250,250)->save("{$thumb_directory}/{$filename}",90);

		return [ "directory" => $path_directory, "filename" => $filename ];
	}

}