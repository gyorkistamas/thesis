<div class="collapse collapse-arrow bg-base-200 mb-3">
    <input type="radio" name="subjectItem"/>
    <div class="collapse-title text-xl font-medium break-all">
        {{ $subject->id }} - {{ $subject->name}}
    </div>
    <div class="collapse-content">
        <div>
        </div>

        <div class="prose mb-2 mt-4">
            <h2>{{__('general.courses')}}</h2>
        </div>

        <div class="md:hidden">
            @foreach($semesterSearch != '' ? $subject->CoursesInTermAndStudent($semesterSearch, Auth::user()->id)->get() : $subject->CoursesHasStudent(Auth::user()->id)->get() as $course)
                <div class="card card-compact bg-base-100 shadow-xl mb-3">
                    <div class="card-body">
                        <h2 class="card-title">{{$course->course_id}}</h2>
                        <div class="flex flex-col gap-2 text-lg">
                            <span><span class="font-bold">{{__('general.courseDescription')}}:</span> {{$course->description}}</span>
                            <span><span class="font-bold">{{__('general.semester')}}:</span> {{$course->Term->name}}</span>
                            <span><span class="font-bold">{{__('general.teachers')}}:</span> @foreach($course->Teachers as $teacher){{$teacher->name}}@if(!$loop->last), @endif @endforeach</span>
                        </div>
                        <div class="card-actions justify-end">
                            <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm">
                                <x-icons.view_fill_small/>{{__('general.view')}}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <table class="table hidden md:table">
            <!-- head -->
            <thead>
            <tr>
                <th>{{__('general.courseId')}}</th>
                <th>{{__('general.courseDescription')}}</th>
                <th>{{__('general.semester')}}</th>
                <th>{{__('general.teachers')}}</th>
                <th>{{__('general.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($semesterSearch != '' ? $subject->CoursesInTermAndStudent($semesterSearch, Auth::user()->id)->get() : $subject->CoursesHasStudent(Auth::user()->id)->get() as $course)
                <tr>
                    <td>{{ $course->course_id }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->Term->name }}</td>
                    <td>@foreach($course->Teachers as $teacher){{$teacher->name}}@if(! $loop->last), @endif @endforeach</td>
                    <td>
                        <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm">
                            <x-icons.view_fill_small/>{{__('general.view')}}</label>
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>{{__('general.courseId')}}</th>
                <th>{{__('general.courseDescription')}}</th>
                <th>{{__('general.semester')}}</th>
                <th>{{__('general.teachers')}}</th>
                <th>{{__('general.actions')}}</th>
            </tr>
            </tfoot>
        </table>

        @if(($semesterSearch != '' && $subject->CoursesInTermAndStudent($semesterSearch, Auth::user()->id)->count() == 0) || ($semesterSearch == '' && $subject->CoursesHasStudent(Auth::user()->id)->count() == 0))
            <div class="prose">
                <h1>{{__('general.noResult')}}</h1>
            </div>
        @endif


        @foreach($semesterSearch != '' ? $subject->CoursesInTermAndStudent($semesterSearch, Auth::user()->id)->get() : $subject->CoursesHasStudent(Auth::user()->id)->get() as $course)
            <livewire:student.course-component :course="$course" :key="$course->id"/>
        @endforeach

    </div>
</div>
