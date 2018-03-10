<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\Grade;
use App\Laravel\Models\Section;
use App\Laravel\Models\Subject;
use App\Laravel\Models\Student;
use App\Laravel\Models\ClassList;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\ClassRequest;

/**
*
*Class used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader, DB;

class ClassController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Class Information";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "classes";
		$this->data['sections'] = ['' => "Choose a Section"] + Section::pluck('section_name','id')->toArray();
		$this->data['subjects'] = /*['' => "Choose a Subject"] + */Subject::pluck('subject_title','id')->toArray();
		$this->data['students'] = /*['' => "Choose a Student"] + */Student::select(DB::raw('CONCAT(lname, ", ", fname," ",mname) AS full_name'), 'id')
		->pluck('full_name','id')->toArray();
	}

	public function index () {
		$this->data['classes'] = ClassList::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (ClassRequest $request) {
		try {
			$new_class = new ClassList;
			$new_class->class_code = 'CLASS-'.Str::upper(Str::random(8));
			$new_class->section_id = $request->section_id;
			$imploded_students = implode(', ',$request->student_ids);
			$imploded_subjects = implode(', ',$request->subject_ids);
			$new_class->student_ids = $imploded_students;
			$new_class->subject_ids = $imploded_subjects;

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/classes');
				$new_class->path = $upload["path"];
				$new_class->directory = $upload["directory"];
				$new_class->filename = $upload["filename"];
			}

			if($new_class->save()) {
				$this->create_grades($new_class->id);
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"NewClass has been added.");
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
		$classes = ClassList::find($id);

		if (!$classes) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['class'] = $classes;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (ClassRequest $request, $id = NULL) {
		try {
			$classes = ClassList::find($id);

			if (!$classes) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			// $classes->fill($request->all());
			$classes->section_id = $request->section_id;

			$imploded_students = implode(', ',$request->student_ids);
			$imploded_subjects = implode(', ',$request->subject_ids);
			$classes->student_ids = $imploded_students;
			$classes->subject_ids = $imploded_subjects;

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/classes');
				if($upload){	
					if (File::exists("{$classes->directory}/{$classes->filename}")){
						File::delete("{$classes->directory}/{$classes->filename}");
					}
					if (File::exists("{$classes->directory}/resized/{$classes->filename}")){
						File::delete("{$classes->directory}/resized/{$classes->filename}");
					}
					if (File::exists("{$classes->directory}/thumbnails/{$classes->filename}")){
						File::delete("{$classes->directory}/thumbnails/{$classes->filename}");
					}
				}
				
				$classes->path = $upload["path"];
				$classes->directory = $upload["directory"];
				$classes->filename = $upload["filename"];
			}

			if($classes->save()) {
				$this->create_grades($classes->id);
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"AClass has been updated.");
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
			$classes = ClassList::find($id);

			if (!$classes) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$classes->directory}/{$classes->filename}")){
				File::delete("{$classes->directory}/{$classes->filename}");
			}
			if (File::exists("{$classes->directory}/resized/{$classes->filename}")){
				File::delete("{$classes->directory}/resized/{$classes->filename}");
			}
			if (File::exists("{$classes->directory}/thumbnails/{$classes->filename}")){
				File::delete("{$classes->directory}/thumbnails/{$classes->filename}");
			}

			if($classes->save() AND $classes->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"AClass has been deleted.");
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

	public function students($id = 0){
		$class = ClassList::find($id);
		
		$exploded_student_ids = explode(', ',$class->student_ids);
		$exploded_subject_ids = explode(', ',$class->subject_ids);

		$this->data['students'] = Student::whereIn('id',$exploded_student_ids)->orderBy('lname')->get();
		$this->data['subjects'] = Subject::whereIn('id',$exploded_subject_ids)->get();

		foreach($this->data['subjects'] as $subject){

			foreach($this->data['students'] as $student){

				$check_grade = Grade::where('class_id',$class->id)
									->where('section_id',$class->section_id)
									->where('subject_id',$subject->id)
									->where('student_id',$student->id)
									->count();

				if($check_grade == 0){
					$new_grade = new Grade;
					$new_grade->class_id = $class->id;
					$new_grade->section_id = $class->section_id;
					$new_grade->subject_id = $subject->id;
					$new_grade->student_id = $student->id;
					$new_grade->save();
				}
			}
		}

		$this->data['class'] = $class;
		return view('backoffice.'.$this->data['route_file'].'.record',$this->data);
	}

	public function update_grades($id = 0, $subject_id = 0){
		$first_grading = Input::get('1st_grading');
		$second_grading = Input::get('2nd_grading');
		$third_grading = Input::get('3rd_grading');
		$fourth_grading = Input::get('4th_grading');

		foreach($first_grading as $index => $grade){
			$update_grade = Grade::where('class_id',$id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->first_grading = $grade;
			$update_grade->save();
		}

		foreach($second_grading as $index => $grade){
			$update_grade = Grade::where('class_id',$id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->second_grading = $grade;
			$update_grade->save();
		}

		foreach($third_grading as $index => $grade){
			$update_grade = Grade::where('class_id',$id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->third_grading = $grade;
			$update_grade->save();
		}

		foreach($fourth_grading as $index => $grade){
			$update_grade = Grade::where('class_id',$id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->fourth_grading = $grade;
			$update_grade->save();
		}

		$class = Grade::where('class_id',$id)->where('subject_id',$subject_id)->get();

		foreach($class as $index => $data){
			$first_grade = $data->first_grading;
			$second_grade = $data->second_grading;
			$third_grade = $data->third_grading;
			$fourth_grade = $data->fourth_grading;		

			$counter = 0;
			if($first_grade > 0){
				$counter+=1;
				goto second;
			}
			second:
			if($second_grade > 0){
				$counter+=1;
				goto third;
			}
			third:
			if($third_grade > 0){
				$counter+=1;
				goto fourth;
			}
			fourth:
			if($fourth_grade > 0){
				$counter+=1;
			}

			$average = ($first_grade + $second_grade + $third_grade + $fourth_grade)/$counter;

			$data->average = $average;
			$data->save();
		}

		Session::flash('notification-status','success');
		Session::flash('notification-msg','The student grades was successfully updated.');
		return redirect()->back();
	}

	public function create_grades($id){
		$class = ClassList::find($id);

		$exploded_student_ids = explode(', ',$class->student_ids);
		$exploded_subject_ids = explode(', ',$class->subject_ids);

		$this->data['students'] = Student::whereIn('id',$exploded_student_ids)->orderBy('lname')->get();
		$this->data['subjects'] = Subject::whereIn('id',$exploded_subject_ids)->get();

		foreach($this->data['subjects'] as $subject){

			foreach($this->data['students'] as $student){

				$check_grade = Grade::where('class_id',$class->id)
				->where('section_id',$class->section_id)
				->where('subject_id',$subject->id)
				->where('student_id',$student->id)
				->count();

				if($check_grade == 0){
					$new_grade = new Grade;
					$new_grade->class_id = $class->id;
					$new_grade->section_id = $class->section_id;
					$new_grade->subject_id = $subject->id;
					$new_grade->student_id = $student->id;
					$new_grade->save();
				}
			}
		}
	}

}