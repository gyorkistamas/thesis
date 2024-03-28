let chart = new Chart(ctx, {
	type: 'pie',
	data: {
		labels: [
			'{{__('teacher.present')}}',
			'{{__('teacher.justified')}}',
			'{{__('teacher.absent')}}',
			'{{__('teacher.late')}}',
			'{{__('teacher.notFilled')}}'
		],
		datasets: [{
			label: '{{__('general.students')}}',
			data: [
				{{$class->StudentsWithPresence->filter(function($student) {return $student->pivot->attendance == 'present';})->count()}},
				{{$class->StudentsWithPresence->filter(function($student) {return $student->pivot->attendance == 'justified';})->count()}},
				{{$class->StudentsWithPresence->filter(function($student) {return $student->pivot->attendance == 'missing';})->count()}},
				{{$class->StudentsWithPresence->filter(function($student) {return $student->pivot->attendance == 'late';})->count()}},
				{{$class->StudentsWithPresence->filter(function($student) {return $student->pivot->attendance == 'not_filled';})->count()}}
			],