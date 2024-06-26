<div class="p-2">
    <div class="prose w-full min-w-full">
        <h1>{{$class->Course->Subject->name}} - {{$class->Course->course_id}} {{__('teacher.course')}}
            ({{$class->Course->Term->name}})</h1>
    </div>
    <div class="divider"></div>

    <div class="flex flex-col justify-between lg:flex-row">

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
                {{$class->Place()->exists() ? $class->Place->name : '-' }}
            </div>

            <div class="flex flex-row justify-start items-center gap-2 text-lg">
                <x-icons.person_fill_small/>
                <span
                    class="font-bold">{{__('general.teachers')}}:</span> @foreach($class->Course->Teachers as $teacher)
                    {{$teacher->name}}@if(!$loop->last), @endif
                @endforeach
            </div>


            <div class="mt-6 flex flex-col items-center lg:items-start lg:w-fit">
                <div class="prose min-w-full mb-3">
                    <h2>{{__('general.students')}}:</h2>
                </div>
                @foreach($class->StudentsWithPresence as $student)
                    <livewire:teacher.student-presence-row :student="$student" :cclass="$class" :key="'presence'.$student->id"/>
                @endforeach
            </div>

        </div>

        <div class="flex flex-col w-full min-w-full lg:w-fit lg:min-w-fit lg:me-10">
            <div class="mb-3">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-3 flex flex-col justify-center items-center">

                        @if($isQrCodeVisible)
                            {{QrCode::size(250)->generate($loginLink)}}
                        @else
                            <div class="blur-md">
                                {{QrCode::size(250)->generate('https://www.youtube.com/watch?v=dQw4w9WgXcQ')}}
                            </div>
                        @endif

                        <div class="join join-vertical mt-2 md:join-horizontal">
                            @if($isQrCodeVisible)
                                <button class="btn btn-success join-item" onclick="classQrCodeModal.showModal();">
                                    <x-icons.view_fill_small/>{{__('teacher.enlargeQrCode')}}</button>
                                <div class="tooltip join-item" data-tip="{{__('teacher.qrCodeAutomaticallyDisablesAfterClass')}}">
                                    <button class="btn btn-error join-item" wire:click="disableQrCode"><x-icons.delete_fill_small />{{__('teacher.disableQrCode')}}</button>
                                </div>
                            @else
                                <button class="btn btn-success join-item" wire:click="generateQrCode">
                                    <x-icons.view_fill_small/>{{__('teacher.showQrCodeForPresence')}}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-3 h-96 flex flex-row justify-center" wire:ignore>
                        <canvas id="presenceChart"></canvas>
                        @script
                        <script>
                            Chart.defaults.font.family = 'Roboto';
                            if (document.documentElement.getAttribute('data-theme') === 'light') {
                                Chart.defaults.color = '#202938';
                            } else {
                                Chart.defaults.color = '#a7adbc';
                            }
                            let ctx = document.getElementById('presenceChart').getContext('2d');
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

                            $wire.on('updateChart', (data) => {
                                chart.data.datasets[0].data[0] = data.data[0];
                                chart.data.datasets[0].data[1] = data.data[1];
                                chart.data.datasets[0].data[2] = data.data[2];
                                chart.data.datasets[0].data[3] = data.data[3];
                                chart.data.datasets[0].data[4] = data.data[4];
                                chart.update();
                                console.log('update')
                            });

                            $wire.on('themeChanged', (data) => {
                                console.log(data);
                                if (data.color === 'light') {
                                    Chart.defaults.color = '#202938';
                                } else {
                                    Chart.defaults.color = '#a7adbc';
                                }
                                chart.update();
                            });


                            $wire.on('closeLateDropdown', (data) => {
                                console.log(data);
                                let dropdown = document.getElementById('lateDropdown' + data);
                                dropdown.removeAttribute('open');
                            });

                        </script>
                        @endscript
                    </div>
                </div>
            </div>
        </div>
    </div>

    @teleport('body')
    <dialog id="classQrCodeModal" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">QR code</h3>
            <div class="flex flex-row justify-center">
                @if($isQrCodeVisible)
                    {{QrCode::size(600)->generate($loginLink)}}
                @else
                    <div class="blur-md">
                        {{QrCode::size(600)->generate('https://www.youtube.com/watch?v=dQw4w9WgXcQ')}}
                    </div>
                @endif
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">{{__('general.close')}}</button>
                </form>
            </div>
        </div>
    </dialog>
    @endteleport

</div>
