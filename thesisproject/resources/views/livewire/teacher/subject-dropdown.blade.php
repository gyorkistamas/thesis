<div class="collapse collapse-arrow bg-base-200 mb-3">
    <div class="inset-0 flex items-center justify-center z-[99] absolute" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <div class="absolute inset-0 flex items-center justify-center z-[99]" wire:loading>
    </div>
    <input type="checkbox" name="subjectItem" wire:model.live="isOpen"/>
    <div class="collapse-title text-xl font-medium break-all" wire:loading.class="blur-md">
        {{ $subject->id }} - {{ $subject->name}}
    </div>
    <div class="collapse-content">
       @if($isOpen)
            <div>
            </div>

            <div class="prose mb-2 mt-4">
                <h2>{{__('general.courses')}}</h2>
            </div>

            <div class="md:hidden">
                @foreach($semesterSearch != '' ? $subject->CoursesInTermAndTeacher($semesterSearch, Auth::user()->id)->get() : $subject->CoursesTaughtByTeacher(Auth::user()->id)->get() as $course)
                    <div class="card card-compact bg-base-100 shadow-xl mb-3">
                        <div class="card-body">
                            <h2 class="card-title">{{$course->course_id}}</h2>
                            <div class="flex flex-col gap-2 text-lg">
                                <span><span class="font-bold">{{__('general.courseDescription')}}:</span> {{$course->description}}</span>
                                <span><span class="font-bold">{{__('general.semester')}}:</span> {{$course->Term->name}}</span>
                                <span><span class="font-bold">{{__('general.teachers')}}:</span> @foreach($course->Teachers as $teacher){{$teacher->name}}@if(!$loop->last), @endif @endforeach</span>
                            </div>
                            <div class="card-actions justify-end" x-data="{clickedCard: false}">
                                <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm" @click="if(!clickedCard){ $dispatch('courseOpened', {courseId: '{{$course->id}}'}); clickedCard = true; }">
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
                    <th>{{__('general.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($semesterSearch != '' ? $subject->CoursesInTermAndTeacher($semesterSearch, Auth::user()->id)->get() : $subject->CoursesTaughtByTeacher(Auth::user()->id)->get() as $course)
                    <tr>
                        <td>{{ $course->course_id }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->Term->name }}</td>
                        <td x-data="{clicked: false}">
                            <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm" @click="if(!clicked){ $dispatch('courseOpened', {courseId: '{{$course->id}}'}); clicked = true; }">
                                <x-icons.view_fill_small/>{{__('general.view')}}</label>
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>{{__('general.courseId')}}</th>
                    <th>{{__('general.courseDescription')}}</th>
                    <th>{{__('general.semester')}}</th>
                    <th>{{__('general.actions')}}</th>
                </tr>
                </tfoot>
            </table>

            @if(($semesterSearch != '' && $subject->CoursesInTermAndTeacher($semesterSearch, Auth::user()->id)->count() == 0) || ($semesterSearch == '' && $subject->CoursesTaughtByTeacher(Auth::user()->id)->count() == 0))
                <div class="prose">
                    <h1>{{__('general.noResult')}}</h1>
                </div>
            @endif


            @foreach($semesterSearch != '' ? $subject->CoursesInTermAndTeacher($semesterSearch, Auth::user()->id)->get() : $subject->CoursesTaughtByTeacher(Auth::user()->id)->get() as $course)
                <div class="drawer z-[200]" wire:ignore.self>
                    <input id="courseDrawer{{$course->id}}" type="checkbox" class="drawer-toggle"/>
                    <div class="drawer-side">
                        <label for="courseDrawer{{$course->id}}" aria-label="close sidebar"
                               class="drawer-overlay"></label>
                        <div class="p-4  w-full md:w-11/12 min-h-full bg-base-200 text-base-content">
                            <div class="fixed inset-0 flex items-center justify-center"
                                 style="pointer-events: none;">
                                <span class="loading loading-dots loading-lg" wire:loading></span>
                            </div>
                            <div
                                class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                                <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{$course->course_id}}</h1>
                            </div>
                            <label for="courseDrawer{{$course->id}}"
                                   class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">X</label>

                            <div role="tablist" class="tabs tabs-lifted">
                                <input type="radio" name="drawertab{{$course->id}}" role="tab"
                                       class="tab"
                                       aria-label="{{__('general.classTimes')}}" checked/>
                                <div role="tabpanel"
                                     class="tab-content bg-base-100 border-base-300 rounded-box p-6" wire:loading.class="blur-md">
                                    @if(in_array($course->id, $loadedCourse))
                                        @if($course->Classes->count() == 0)
                                            <div class="prose">
                                                <h1>{{__('general.noResult')}}</h1>
                                            </div>
                                        @else
                                            <div class="md:hidden">
                                                @foreach($course->Classes as $class)
                                                    <div class="card card-compact bg-base-200 shadow-md mb-4">
                                                        <div class="card-body">
                                                            <div class="flex flex-col gap-2 text-lg">
                                                                <span><span class="font-bold">{{__('general.startTime')}}:</span> {{$class->start_time}}</span>
                                                                <span><span class="font-bold">{{__('general.endTime')}}:</span> {{$class->end_time}}</span>
                                                                <span><span class="font-bold">{{__('general.place')}}:</span> {{$class->Place()->exists() ? $class->Place->name : '-' }}</span>
                                                            </div>
                                                            <div class="card-actions justify-end">
                                                                <a class="btn btn-success btn-sm" href="{{route('teacher-view-class', ['courseClass' => $class->id])}}" wire:navigate for="courseDrawer{{$course->id}}">
                                                                    <x-icons.view_fill_small/>{{__('general.view')}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <table class="table hidden md:table">
                                                <!-- head -->
                                                <thead>
                                                <tr>
                                                    <th>{{__('general.startTime')}}</th>
                                                    <th>{{__('general.endTime')}}</th>
                                                    <th>{{__('general.place')}}</th>
                                                    <th>{{__('general.options')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- rows -->
                                                @foreach($course->Classes as $class)
                                                    <tr>
                                                        <td>{{$class->start_time}}</td>
                                                        <td>{{$class->end_time}}</td>
                                                        <td>{{$class->Place()->exists() ? $class->Place->name : '-' }}</td>
                                                        <td>
                                                            <a class="btn btn-success btn-sm" href="{{route('teacher-view-class', ['courseClass' => $class->id])}}" wire:navigate for="courseDrawer{{$course->id}}">
                                                                <x-icons.view_fill_small/>{{__('general.view')}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <!-- foot -->
                                                <tfoot>
                                                <tr>
                                                    <th>{{__('general.startTime')}}</th>
                                                    <th>{{__('general.endTime')}}</th>
                                                    <th>{{__('general.place')}}</th>
                                                    <th>{{__('general.options')}}</th>
                                                </tr>
                                                </tfoot>

                                            </table>
                                        @endif
                                    @endif


                                </div>

                                <input type="radio" name="drawertab{{$course->id}}" role="tab"
                                       class="tab"
                                       aria-label="{{__('general.students')}}" value="students"
                                />
                                <div role="tabpanel"
                                     class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                    @if(in_array($course->id, $loadedCourse))
                                        <livewire:teacher.course-students :course="$course" :key="'courseStudents'.$course->id"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
       @endif

    </div>
</div>
