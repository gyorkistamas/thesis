<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
    <div class="col-span-1">
        <canvas id="users"></canvas>
    </div>

    <div class="col-span-2">
        <canvas id="count"></canvas>
    </div>

    <div class="col-span-1">
        <canvas id="presence"></canvas>
    </div>
    @script
    <script>
        Chart.defaults.font.family = 'Roboto';
        if (document.documentElement.getAttribute('data-theme') === 'light') {
            Chart.defaults.color = '#202938';
        } else {
            Chart.defaults.color = '#a7adbc';
        }
        let userChartCanvas = document.getElementById('users').getContext('2d');
        let userChart = new Chart(userChartCanvas, {
            type: 'pie',
            data: {
                labels: [
                    '{{__('general.teachers')}}',
                    '{{__('general.students')}}',
                    '{{__('general.admins')}}',
                    '{{__('general.superAdmins')}}',
                ],
                datasets: [{
                    label: '{{__('general.userCount')}}:',
                    data: @json($this->GetUserStatistics()),
                    backgroundColor: [
                        'rgba(48, 146, 92, 0.2)',
                        'rgba(255, 217, 0, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 162, 0, 0.2)',
                    ],
                    borderColor: [
                        'rgba(48, 146, 92, 1)',
                        'rgba(255, 215, 0, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 162, 0, 1)',
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
                        text: '{{__('general.userCount')}}',
                        font: {
                            size: 25
                        }
                    }
                }
            }
        });

        let countChartCanvas = document.getElementById('count').getContext('2d');
        let countChart = new Chart(countChartCanvas, {
            type: 'bar',
            data: {
                labels: [
                    '{{__('general.semester')}}',
                    '{{__('general.place')}}',
                    '{{__('teacher.subject')}}',
                    '{{__('teacher.course')}}',
                    '{{__('general.class')}}',
                    '{{__('teacher.justification')}}'
                ],
                datasets: [{
                    label: '{{__('general.count')}}',
                    data: @json($this->CountStatistics()),
                    backgroundColor: 'rgba(48, 146, 92, 0.2)',
                    borderColor: 'rgba(48, 146, 92, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                locale: '{{App::currentLocale()}}',
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: '{{__('general.countData')}}',
                        font: {
                            size: 25
                        }
                    }
                }
            }
        });

        let attendanceCanvas = document.getElementById('presence').getContext('2d');
        let attendance = new Chart(attendanceCanvas, {
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
                    data: @json($this->PresenceCount()),
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
