<div class="drawer z-[200]" wire:ignore.self>
    <input id="courseDrawer{{$course->id}}" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-side">
        <label for="courseDrawer{{$course->id}}" aria-label="close sidebar"
               class="drawer-overlay"></label>
        <div class="p-4  w-full md:w-11/12 min-h-full bg-base-200 text-base-content">
            <div class="fixed inset-0 flex items-center justify-center h-screen z-[9999]"
                 style="pointer-events: none;">
                <span class="loading loading-dots loading-lg z-[9999]" wire:loading></span>
            </div>
            <div class="absolute inset-0 flex items-center justify-center blur-md z-[999]" wire:loading></div>
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

                    @if($course->Classes->count() == 0)
                        <div class="prose">
                            <h1>{{__('general.noResult')}}</h1>
                        </div>
                    @else
                        @if($loaded)
                            <div class="md:hidden">
                                @foreach($course->Classes as $class)
                                    <div class="card card-compact bg-base-200 shadow-md mb-4">
                                        <div class="card-body">
                                            <div class="flex flex-col gap-2 text-lg">
                                                <span><span class="font-bold">{{__('general.startTime')}}:</span> {{$class->start_time}}</span>
                                                <span><span class="font-bold">{{__('general.endTime')}}:</span> {{$class->end_time}}</span>
                                                <span><span class="font-bold">{{__('general.place')}}:</span> {{$class->Place()->exists() ? $class->Place->name : '-' }}</span>
                                                <span>
                                                            <span class="font-bold">{{__('student.status')}}: </span>
                                                            @switch($class->GetStudent(Auth::user()->id)->first()->pivot->attendance)
                                                        @case('not_filled')
                                                            <div class="badge badge-info gap-2">
                                                                {{__('teacher.notFilled')}}
                                                            </div>
                                                            @break

                                                        @case('present')
                                                            <div class="badge badge-success gap-2">
                                                                {{__('teacher.present')}}
                                                            </div>
                                                            @break

                                                        @case('late')
                                                            <div class="badge badge-warning gap-2">
                                                                {{__('teacher.late')}} ({{$class->GetStudent(Auth::user()->id)->first()->pivot->late_minutes}} {{__('teacher.minutes')}})
                                                            </div>
                                                            @break

                                                        @case('justified')
                                                            <div class="badge badge-warning gap-2">
                                                                {{__('teacher.justified')}}
                                                            </div>
                                                            @break

                                                        @case('missing')
                                                            <div class="badge badge-error gap-2">
                                                                {{__('teacher.absent')}}
                                                            </div>
                                                            @break
                                                    @endswitch
                                                        </span>
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
                                    <th>{{__('student.status')}}</th>
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
                                            @switch($class->GetStudent(Auth::user()->id)->first()->pivot->attendance)
                                                @case('not_filled')
                                                    <div class="badge badge-info gap-2">
                                                        {{__('teacher.notFilled')}}
                                                    </div>
                                                    @break

                                                @case('present')
                                                    <div class="badge badge-success gap-2">
                                                        {{__('teacher.present')}}
                                                    </div>
                                                    @break

                                                @case('late')
                                                    <div class="badge badge-warning gap-2">
                                                        {{__('teacher.late')}} ({{$class->GetStudent(Auth::user()->id)->first()->pivot->late_minutes}} {{__('teacher.minutes')}})
                                                    </div>
                                                    @break

                                                @case('justified')
                                                    <div class="badge badge-warning gap-2">
                                                        {{__('teacher.justified')}}
                                                    </div>
                                                    @break

                                                @case('missing')
                                                    <div class="badge badge-error gap-2">
                                                        {{__('teacher.absent')}}
                                                    </div>
                                                    @break
                                            @endswitch
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
                                    <th>{{__('student.status')}}</th>
                                </tr>
                                </tfoot>

                            </table>
                        @endif

                        <div class="flex flex-row justify-center h-[20rem] md:h-[25rem] lg:h-[30rem]" wire:ignore>
                            <canvas id="courseDiagram{{$course->id}}"></canvas>

                            @script
                            <script>
                                Chart.defaults.font.family = 'Roboto';
                                if (document.documentElement.getAttribute('data-theme') === 'light') {
                                    Chart.defaults.color = '#202938';
                                } else {
                                    Chart.defaults.color = '#a7adbc';
                                }
                                console.log('{{$course->id}}');
                                let ctx{{$course->id}} = document.getElementById('courseDiagram{{$course->id}}').getContext('2d');
                                let chart{{$course->id}} = new Chart(ctx{{$course->id}}, {
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
                                            label: '{{__('student.numberOfClasses')}}:',
                                            data: [
                                                {{$course->NumberOfStatusForStudent(Auth::user()->id, 'present')}},
                                                {{$course->NumberOfStatusForStudent(Auth::user()->id, 'justified')}},
                                                {{$course->NumberOfStatusForStudent(Auth::user()->id, 'missing')}},
                                                {{$course->NumberOfStatusForStudent(Auth::user()->id, 'late')}},
                                                {{$course->NumberOfStatusForStudent(Auth::user()->id, 'not_filled')}}
                                            ],
                                            backgroundColor: [
                                                'rgba(48, 146, 92, 0.2)',
                                                'rgba(255, 217, 0, 0.2)',
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(255, 162, 0, 0.2)',
                                                'rgba(0, 160, 230, 0.2)',
                                            ],
                                            borderColor: [
                                                'rgba(48, 146, 92, 1)',
                                                'rgba(255, 215, 0, 1)',
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(255, 162, 0, 1)',
                                                'rgba(0, 160, 230, 1)',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        locale: '{{App::currentLocale()}}',
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                            },
                                            title: {
                                                display: true,
                                                text: '{{__('teacher.presence')}}',
                                                font: {
                                                    size: 25
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                            @endscript
                        </div>
                    @endif
                </div>

                <input type="radio" name="drawertab{{$course->id}}" role="tab"
                       class="tab"
                       aria-label="{{__('general.students')}}" value="students"
                />
                <div role="tabpanel"
                     class="tab-content bg-base-100 border-base-300 rounded-box p-6" wire:loading.class="blur-md">

                    <div class="md:hidden">
                        @foreach($course->Students as $student)

                            <div class="card card-compact bg-base-200 shadow-md mb-4">
                                <div class="card-body">
                                    <div class="flex flex-col gap-2 text-lg">
                                        <span><span class="font-bold">{{__('general.neptunCode')}}:</span> {{$student->neptun}}</span>
                                        <span><span class="font-bold">{{__('general.name')}}:</span> {{$student->name}}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                    <table class="table hidden md:table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>{{__('general.neptunCode')}}</th>
                            <th>{{__('general.name')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- rows -->
                        @foreach($course->Students as $student)
                            <tr>
                                <td>{{$student->neptun}}</td>
                                <td>{{$student->name}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                        <!-- foot -->
                        <tfoot>
                        <tr>
                            <th>{{__('general.neptunCode')}}</th>
                            <th>{{__('general.name')}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
