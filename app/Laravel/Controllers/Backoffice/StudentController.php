<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\Student;
use App\Laravel\Models\StudentInformation;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\StudentRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader;

class StudentController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Student Information";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "students";
		$this->data['featureds'] = ['no'=>"No",'yes'=>"Yes"];
		$this->data['gender'] = ['' => "Choose Gender" ,'male' => "Male",'female' => "Female"];
	}

	public function index () {
		$this->data['students'] = Student::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (StudentRequest $request) {
		try {
			$new_students = new Student;
			$new_students->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/students');
				$new_students->path = $upload["path"];
				$new_students->directory = $upload["directory"];
				$new_students->filename = $upload["filename"];
			}

			if($new_students->save()) {
				$this->student_additional_information($new_students->id,$request);
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"New students has been added.");
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
		$students = Student::find($id);
		$student_additional_information = StudentInformation::where('student_id',$id)->first();

		if (!$students) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['student'] = $students;
		$this->data['additional_information'] = $student_additional_information;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (StudentRequest $request, $id = NULL) {
		try {
			$students = Student::find($id);

			if (!$students) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$students->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/students');
				if($upload){	
					if (File::exists("{$students->directory}/{$students->filename}")){
						File::delete("{$students->directory}/{$students->filename}");
					}
					if (File::exists("{$students->directory}/resized/{$students->filename}")){
						File::delete("{$students->directory}/resized/{$students->filename}");
					}
					if (File::exists("{$students->directory}/thumbnails/{$students->filename}")){
						File::delete("{$students->directory}/thumbnails/{$students->filename}");
					}
				}
				
				$students->path = $upload["path"];
				$students->directory = $upload["directory"];
				$students->filename = $upload["filename"];
			}

			if($students->save()) {
				$this->update_student_additional_information($students->id,$request);
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A students has been updated.");
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
			$students = Student::find($id);

			if (!$students) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$students->directory}/{$students->filename}")){
				File::delete("{$students->directory}/{$students->filename}");
			}
			if (File::exists("{$students->directory}/resized/{$students->filename}")){
				File::delete("{$students->directory}/resized/{$students->filename}");
			}
			if (File::exists("{$students->directory}/thumbnails/{$students->filename}")){
				File::delete("{$students->directory}/thumbnails/{$students->filename}");
			}

			if($students->save() AND $students->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A students has been deleted.");
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

	public function student_additional_information($id,$request){
		$student_information = new StudentInformation;
		$student_information->fill($request->all());
		$student_information->student_id = $id;
		$student_information->save();
	}

	public function update_student_additional_information($id,$request){
		$student_information = StudentInformation::find($id);
		$student_information->fill($request->all());
		$student_information->save();
	}

}