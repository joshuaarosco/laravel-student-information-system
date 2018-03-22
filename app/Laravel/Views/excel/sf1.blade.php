<html>
<head>

</head>
<body>
	<table>
		<tr>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 5%;  text-align: center; margin-bottom: 20px;" --}}></td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 15%;  text-align: center; margin-bottom: 20px;" --}}>LRN</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 50%; text-align: center; margin-bottom: 20px;" --}}>NAME <br>(Last Name, First Name, Middle Name)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Sex <br>(M/F)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 40%; text-align: center; margin-bottom: 20px;" --}}>BIRTHDATE <br> (mm/dd/yyyy)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 40%; text-align: center; margin-bottom: 20px;" --}}>AGE as of 1st Friday June</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 40%; text-align: center; margin-bottom: 20px;" --}}>MOTHER TONGUE <br>(Grade 1 to 3 Only)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>IP <br>(Ethnic Group)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Religion</td>
			<td colspan="4" {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Address</td>
			<td colspan="2" {{-- style="border: 2px solid #000; width: 100%; text-align: center; margin-bottom: 20px;" --}}>Parents</td>
			<td colspan="2" {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Guardian <br>(if Not Parent)</td>
			<td rowspan="2" {{-- style="border: 2px solid #000; width: 40%; text-align: center; margin-bottom: 20px;" --}}>Contact Number of Parent or Guardian</td>
			<td style="text-align: center;">Remarks</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>House #/ Street/ Sitio/ Purok</td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Barangay</td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Municipality/ City</td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Province</td>
			<td {{-- style="border: 2px solid #000; width: 50%; text-align: center; margin-bottom: 20px;" --}}>Father's Name (Last Name, First Name, Middle Name)</td>
			<td {{-- style="border: 2px solid #000; width: 50%; text-align: center; margin-bottom: 20px;" --}}>Mother's Maiden Name (Last Name, First Name, Middle </td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Name</td>
			<td {{-- style="border: 2px solid #000; width: 20%; text-align: center; margin-bottom: 20px;" --}}>Relationship</td>
			<td></td>
			<td {{-- style="border: 2px solid #000; width: 40%; text-align: center; margin-bottom: 20px;" --}}>(Please refer to the legend on last page)</td>
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td {{-- style="border: 2px solid #000;" --}}>{{$index+1}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->lrn}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->gender:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->birthdate:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->age_of_first_friday_june:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->mother_tounge:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->ip:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->religion:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->house_street:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->barangay:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->municipality:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->province:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->fathers_name:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->mothers_name:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->guardian_name:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->relationship:'---'}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->contact_number}}</td>
			<td {{-- style="border: 2px solid #000;" --}}>{{$student->additional_info? $student->additional_info->remarks:'---'}}</td>
		</tr>
		@endforeach
	</table>	
</body>
</html>