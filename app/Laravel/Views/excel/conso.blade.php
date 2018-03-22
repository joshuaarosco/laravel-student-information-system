<html>
<head>
</head>
<body>
	<table>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;" rowspan="5"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; width: 20%;" rowspan="5"><center style="text-align: center;" >LRN</center></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;" colspan="{{($subjects->count()*5)+1}}"><strong style="text-align: center;">GRADE SHEET</strong></td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; width: 30%;">SCHOOL YEAR: {{$section->school_year}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 15%;" colspan="5">TCHR: {{"{$subject->teacher->lname}, {$subject->teacher->fname}"}}</td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">CURRICULUM YEAR: {{$section->section_name}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; padding: 10px; text-align: center;" colspan="5"></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">ADVISER: {{"{$section->adviser->fname} {$section->adviser->lname}"}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-bottom: 3px solid #000; border-right: 3px solid #000; font-size: 12px; padding: 10px;" colspan="5"><center style="text-align: center;">SUBJ: {{Str::upper($subject->subject_title)}}</center></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">NAME OF STUDENTS/PUPILS </td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">1</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">2</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">3</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">4</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">AVE</td>
			@endforeach
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">{{$index+1}}</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center;">{{$student->lrn}}</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->first_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->second_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->third_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->fourth_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px; text-align: center; width: 10px;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->average,2)}}</strong>
			</td>
			@endforeach
		</tr>
		@endforeach
	</table>
</body>
</html>