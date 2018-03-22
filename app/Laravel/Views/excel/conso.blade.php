<html>
<head>
</head>
<body>
	<table>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;" rowspan="5"></td>
			<td style="border: 3px solid #000; font-size: 12px;" rowspan="5"><center style="text-align: center;" >LRN</center></td>
			<td style="border: 3px solid #000; font-size: 12px;" colspan="{{($subjects->count()*5)+21}}"><strong style="text-align: center;">GRADE SHEET</strong></td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;">SCHOOL YEAR: {{$section->school_year}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;" colspan="5"><span style="text-align: center;">TCHR: {{"{$subject->teacher->lname}, {$subject->teacher->fname}"}}</span></td>
			@endforeach
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="10">
				<strong style="text-align: center;">QUARTERLY RANKING AND AVERAGE WITH DECIMAL PLACE</strong>
			</td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="10">
				<strong style="text-align: center;">QUARTERLY RANKING AND AVERAGE WHOLE NUMBERS</strong>
			</td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;">CURRICULUM YEAR: {{$section->section_name}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="5"></td>
			@endforeach
			@foreach(range(1, 2) as $value)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">FIRST</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">SECOND</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">THIRD</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">FOURTH</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">FINAL</strong></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;">ADVISER: {{"{$section->adviser->fname} {$section->adviser->lname}"}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-bottom: 3px solid #000; border-right: 3px solid #000; font-size: 12px;" colspan="5"><center style="text-align: center;">SUBJ: {{Str::upper($subject->subject_title)}}</center></td>
			@endforeach
			@foreach(range(1, 2) as $value)
			@foreach(range(1,4) as $data)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">GRADING</strong></td>
			@endforeach
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; font-size: 12px; text-align: center;" colspan="2"><strong style="text-align: center;">RATING</strong></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;"></td>
			<td style="border: 3px solid #000; font-size: 12px;">NAME OF STUDENTS/PUPILS </td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">1</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">2</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">3</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">4</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">AVE</td>
			@endforeach
			@foreach(range(1, 10) as $value)
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">AVE</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">RANK</td>
			@endforeach
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td style="border: 3px solid #000; font-size: 12px;">{{$index+1}}</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">{{$student->lrn}}</td>
			<td style="border: 3px solid #000; font-size: 12px;">{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
			<?php
				$first_grading = [];
				$second_grading = [];
				$third_grading = [];
				$fourth_grading = [];
				$average = [];
			?>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->first_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->second_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->third_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->fourth_grading,2)}}</strong>
			</td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;">
				<strong>{{round($subject->encode_grade($section->id,$subject->id,$student->id)->average,2)}}</strong>
			</td>
			<?php
				array_push($first_grading,round($subject->encode_grade($section->id,$subject->id,$student->id)->first_grading,2));
				array_push($second_grading,round($subject->encode_grade($section->id,$subject->id,$student->id)->second_grading,2));
				array_push($third_grading,round($subject->encode_grade($section->id,$subject->id,$student->id)->third_grading,2));
				array_push($fourth_grading,round($subject->encode_grade($section->id,$subject->id,$student->id)->fourth_grading,2));
				array_push($average,round($subject->encode_grade($section->id,$subject->id,$student->id)->average,2));
			?>
			@endforeach
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($first_grading)/count($first_grading),2)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($second_grading)/count($second_grading),2)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($third_grading)/count($third_grading),2)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($fourth_grading)/count($fourth_grading),2)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($average)/count($average),2)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>

			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($first_grading)/count($first_grading),0)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($second_grading)/count($second_grading),0)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($third_grading)/count($third_grading),0)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($fourth_grading)/count($fourth_grading),0)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong>{{round(array_sum($average)/count($average),0)}}</strong></td>
			<td style="border: 3px solid #000; font-size: 12px; text-align: center;"><strong></strong></td>
		</tr>
		@endforeach
	</table>
</body>
</html>