<?php 

namespace App\Laravel\Controllers\Backoffice;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\User;
use App\Laravel\Models\Grade;
use App\Laravel\Models\Subject;
use App\Laravel\Models\Student;
use App\Laravel\Models\Section;

/*
*
* Requests used for validating inputs
*/


/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB, Auth, Input;

class ClassRecordController extends Controller{

	/*
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "My Class Record";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "class_record";
	}

	public function index () {
		$subjects = Subject::where('teacher_id',Auth::user()->id)->orderBy('school_year','DESC')->get();
		$subject_ids = [];
		foreach($subjects as $subject){
			array_push($subject_ids,$subject->id);
		}

		$grades = Grade::whereIn('subject_id',$subject_ids)->get();
		$this->data['my_subjects'] = $subjects;
		return view('backoffice.class_record.index',$this->data);
	}

	public function section($id = 0){
		$subject = Subject::find($id);
		$grades = Grade::where('subject_id',$id)->get();

		$student_ids = [];
		$section_ids = [];
		foreach($grades as $grade){
			array_push($student_ids,$grade->student_id);
			array_push($section_ids,$grade->section_id);
		}

		$students = Student::whereIn('id',$student_ids)->get();
		$sections = Section::whereIn('id',$section_ids)->get();

		$this->data['subject'] = $subject;
		$this->data['students'] = $students;
		$this->data['sections'] = $sections;

		return view('backoffice.class_record.sections',$this->data);
	}

	public function encode($section_id = 0, $subject_id = 0){
		$subject = Subject::find($subject_id);
		$section = Section::find($section_id);
		$grades = Grade::where('section_id',$section_id)
						->where('subject_id',$subject_id)->get();

		$student_ids = [];
		$class_ids = [];
		foreach($grades as $grade){
			array_push($student_ids,$grade->student_id);
			array_push($class_ids,$grade->class_id);
		}

		$this->data['students'] = Student::whereIn('id',$student_ids)->orderBy('lname')->get();
		$this->data['subject'] = $subject;
		$this->data['section'] = $section;
		return view('backoffice.class_record.encode',$this->data);
	}

	public function update_grades($section_id = 0, $subject_id = 0){
		$first_grading = Input::get('1st_grading');
		$second_grading = Input::get('2nd_grading');
		$third_grading = Input::get('3rd_grading');
		$fourth_grading = Input::get('4th_grading');

		foreach($first_grading as $index => $grade){
			$update_grade = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->first_grading = $grade;
			$update_grade->save();
		}

		foreach($second_grading as $index => $grade){
			$update_grade = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->second_grading = $grade;
			$update_grade->save();
		}

		foreach($third_grading as $index => $grade){
			$update_grade = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->third_grading = $grade;
			$update_grade->save();
		}

		foreach($fourth_grading as $index => $grade){
			$update_grade = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->where('student_id',$index)->first();
			$update_grade->fourth_grading = $grade;
			$update_grade->save();
		}

		$class = Grade::where('section_id',$section_id)->where('subject_id',$subject_id)->get();

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

}