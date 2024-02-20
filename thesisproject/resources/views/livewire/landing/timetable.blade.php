<x-rounded-container>

    <div class="prose">
        <h1>{{__('general.timetable')}}</h1>
    </div>

    <div class="mt-5" wire:ignore>

        <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;" id="loadingIndicator">
            <span class="loading loading-dots loading-lg"></span>
        </div>

        <div id="timetable" class="">
        </div>
    </div>
    @script
    <script>
        let loading = document.getElementById('loadingIndicator');
        let calendarEl = document.getElementById('timetable');
        console.log('{{App::currentLocale()}}');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: '{{App::currentLocale()}}',
            initialView: 'timeGridWeek',
            slotMinTime: '8:00:00',
            nowIndicator: true,
            expandRows: true,
            eventMaxStack: 1,
            loading: function (isLoading) {
                if (isLoading) {
                    loading.style.display = 'flex';
                    calendarEl.classList.add('blur-md');
                } else {
                    loading.style.display = 'none';
                    calendarEl.classList.remove('blur-md');
                }
            },
            eventDidMount: function (info) {
                let tooltip = document.createElement('div');
                tooltip.classList.add('tooltip');
                tooltip.classList.add('z-[9999]');
                let content = info.el.children[0].children[0];
                tooltip.setAttribute('data-tip', content.children[1].children[0].innerHTML);
                content.children[1].children[0].classList.add('break-all');
                info.el.children[0].removeChild(content);
                tooltip.appendChild(content);
                info.el.children[0].appendChild(tooltip);
            },
            events: function (info, successCallback, failureCallback) {
                $wire.getEvents(info.startStr, info.endStr).then(value => {
                    successCallback(JSON.parse(value));
                })
                    .catch(err => {
                        failureCallback(err);
                    });
            },
        });

        calendar.render();
    </script>
    @endscript
</x-rounded-container>
