<div class="p-2">
    <div class="prose w-full min-w-full">
        <h1>{{$class->Course->Subject->name}} - {{$class->Course->course_id}} {{__('teacher.course')}} ({{$class->Course->Term->name}})</h1>
    </div>
    <div class="divider"></div>

    <div class="flex flex-row justify-between me-20">

        <div class="flex flex-col gap-2 grow">
            <div class="flex flex-row justify-start items-center gap-2 text-lg">
                <x-icons.time_fill_small class="inline"/>
                <span class="font-bold">{{__('general.startTime')}}: </span>
                {{\Carbon\Carbon::parse($class->start_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
            </div>

            <div class="flex flex-row justify-start items-center gap-2 text-lg">
                <x-icons.time_fill_small class="inline"/>
                <span class="font-bold">{{__('general.endTime')}}: </span>
                {{\Carbon\Carbon::parse($class->end_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
            </div>

            <div class="flex flex-row justify-start items-center gap-2 text-lg">
                <x-icons.map_fill_small class="inline"/>
                <span class="font-bold">{{__('general.place')}}: </span>
                {{$class->Place->name}}
            </div>

            <div class="flex flex-row justify-start items-center gap-2 text-lg">
                <x-icons.person_fill_small />
                <span class="font-bold">{{__('general.teachers')}}:</span> @foreach($class->Course->Teachers as $teacher){{$teacher->name}}@if(!$loop->last), @endif @endforeach
            </div>


            <div class="mt-6 ms-3">
                <div class="prose min-w-full mb-3">
                    <h2>{{__('general.students')}}:</h2>
                </div>
                @foreach($class->StudentsWithPresence as $student)
                    <livewire:teacher.student-presence-row :student="$student" :key="'presence'.$student->id"/>
                @endforeach
            </div>

        </div>

        <div class="flex flex-col justify-center">
            <div class="mb-3">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body p-3 flex flex-row justify-center">
                        {{QrCode::size(250)->generate('https://www.youtube.com/watch?v=dQw4w9WgXcQ')}}
                    </div>
                </div>
            </div>

            <div class="">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body p-3 h-96" wire:ignore>
                        <canvas id="presenceChart"></canvas>
                        @script
                            <script>
                                Chart.defaults.font.family = 'Roboto';
                                let ctx = document.getElementById('presenceChart').getContext('2d');
                                let chart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: [
                                            '{{__('teacher.present')}}',
                                            '{{__('teacher.absent')}}',
                                            '{{__('teacher.late')}}',
                                            '{{__('teacher.notFilled')}}'
                                        ],
                                        datasets: [{
                                            label: '{{__('general.students')}}',
                                            data: [
                                                {{$class->StudentsWithPresence()->wherePivot('attendance', 'present')->count()}},
                                                {{$class->StudentsWithPresence()->wherePivot('attendance', 'absent')->count()}},
                                                {{$class->StudentsWithPresence()->wherePivot('attendance', 'late')->count()}},
                                                {{$class->StudentsWithPresence()->wherePivot('attendance', 'not_filled')->count()}}
                                            ],
                                            backgroundColor: [
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                            ],
                                            borderColor: [
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(54, 162, 235, 1)',
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
                                                text: '{{__('teacher.presence')}}'
                                            }
                                        }
                                    }
                                });

                                setInterval(() => {
                                    $wire.dispatch('refreshChart');
                                }, 5000);

                                $wire.on('updateChart', (data) => {
                                    chart.data.datasets[0].data[0] = data.data[0];
                                    chart.data.datasets[0].data[1] = data.data[1];
                                    chart.data.datasets[0].data[2] = data.data[2];
                                    chart.data.datasets[0].data[3] = data.data[3];
                                    chart.update();
                                    console.log('update')
                                });

                            </script>
                        @endscript
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
