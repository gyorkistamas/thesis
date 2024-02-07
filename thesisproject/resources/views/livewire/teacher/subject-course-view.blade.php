<div>
    @if($subjects)
        @foreach($subjects as $subject)
            <div class="collapse collapse-arrow bg-base-200 mb-3">
                <input type="radio" name="subjectItem"/>
                <div class="collapse-title text-xl font-medium">
                    {{ $subject->id }} - {{ $subject->name}} @if(Auth::user()->id == $subject->Manager->id)
                        - <span class="text-success">{{__('general.subjectManager')}}</span>
                    @endif
                </div>
                <div class="collapse-content">
                    <div>

                    </div>

                    <table class="table">
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
                        @foreach($subject->CoursesTaughtByTeacher(Auth::user()->id)->get() as $course)
                            <tr>
                                <td>{{ $course->course_id }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->Term->name }}</td>
                                <td>
                                    <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm">
                                        <x-icons.view_fill_small/>{{__('general.view')}}</label>

                                    <div class="drawer z-[200]" wire:ignore.self>
                                        <input id="courseDrawer{{$course->id}}" type="checkbox" class="drawer-toggle"/>
                                        <div class="drawer-side">
                                            <label for="courseDrawer{{$course->id}}" aria-label="close sidebar"
                                                   class="drawer-overlay"></label>
                                            <div class="p-4 w-11/12 min-h-full bg-base-200 text-base-content">
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
                                                         class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                                        <table class="table">
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
                                                    </div>

                                                    <input type="radio" name="drawertab{{$course->id}}" role="tab"
                                                           class="tab"
                                                           aria-label="{{__('general.students')}}" value="students"
                                                           wire:model.live="currentTab"/>
                                                    <div role="tabpanel"
                                                         class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                                        <div class="flex flex-row gap-3 mb-4">
                                                            <button class="btn btn-success" wire:click="addStudents">
                                                                <x-icons.plus_fill_small/>{{__('general.add')}}</button>
                                                        </div>
                                                        <table class="table">
                                                            <!-- head -->
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('general.neptunCode')}}</th>
                                                                <th>{{__('general.name')}}</th>
                                                                <th>{{__('general.remove')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <!-- rows -->
                                                            @foreach($course->Students as $student)
                                                                <tr>
                                                                    <td>{{$student->neptun}}</td>
                                                                    <td>{{$student->name}}</td>
                                                                    <td>
                                                                        <button class="btn btn-error btn-sm"
                                                                                wire:click="removeStudent({{$student->id}})">
                                                                            <x-icons.delete_fill_small/>{{__('general.remove')}}
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <!-- foot -->
                                                            <tfoot>
                                                            <tr>
                                                                <th>{{__('general.neptunCode')}}</th>
                                                                <th>{{__('general.name')}}</th>
                                                                <th>{{__('general.remove')}}</th>
                                                            </tr>
                                                            </tfoot>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                </div>
            </div>
        @endforeach
    @else
        <div class="prose">
            <h1>{{__('general.noResult')}}</h1>
        </div>
    @endif

</div>
