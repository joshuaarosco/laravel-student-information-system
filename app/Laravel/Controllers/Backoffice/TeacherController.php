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
use App\Laravel\Requests\Backoffice\TeacherRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image;

class TeacherController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Teacher";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "teachers";
		$this->data['types'] = [''=>'Choose type','admin'=>"Admin",'super_user'=>"Super User"];
	}

	public function index () {
		$this->data['teachers'] = User::orderBy('created_at',"DESC")->where('type','!=','super_user')->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (TeacherRequest $request) {
		try {
			$new_teacher = new User;
			$new_teacher->fill($request->all());
			$new_teacher->type = 'teacher';
			$new_teacher->email = Str::lower($request->get('email'));
			$new_teacher->password = bcrypt($request->get('password'));

			if($request->hasFile('file')){
				$upload = $this->__upload($request);
				$new_teacher->directory = $upload["directory"];
				$new_teacher->filename = $upload["filename"];
			}

			if($new_teacher->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"New teacher has been added.");
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
		$teacher = User::find($id);

		if (!$teacher) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['teacher'] = $teacher;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (TeacherRequest $request, $id = NULL) {
		try {
			$teacher = User::find($id);

			if (!$teacher) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$teacher->fill($request->all());

			if($request->has('password')){
				$teacher->password =  bcrypt($request->get('password'));
			}

			if($request->hasFile('file')){
				$upload = $this->__upload($request);
				if($upload){	
					if (File::exists("{$teacher->directory}/{$teacher->filename}")){
						File::delete("{$teacher->directory}/{$teacher->filename}");
					}
					if (File::exists("{$teacher->directory}/resized/{$teacher->filename}")){
						File::delete("{$teacher->directory}/resized/{$teacher->filename}");
					}
					if (File::exists("{$teacher->directory}/thumbnails/{$teacher->filename}")){
						File::delete("{$teacher->directory}/thumbnails/{$teacher->filename}");
					}
				}
				
				$teacher->directory = $upload["directory"];
				$teacher->filename = $upload["filename"];
			}

			if($teacher->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"An teacher has been updated.");
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
			$teacher = User::find($id);

			$teacher->email = $id."@domain.com";

			if (!$teacher) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$teacher->directory}/{$teacher->filename}")){
				File::delete("{$teacher->directory}/{$teacher->filename}");
			}
			if (File::exists("{$teacher->directory}/resized/{$teacher->filename}")){
				File::delete("{$teacher->directory}/resized/{$teacher->filename}");
			}
			if (File::exists("{$teacher->directory}/thumbnails/{$teacher->filename}")){
				File::delete("{$teacher->directory}/thumbnails/{$teacher->filename}");
			}

			if($teacher->save() AND $teacher->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"An teacher has been deleted.");
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
	private function __upload(Request $request, $directory = "uploads/teacher"){
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