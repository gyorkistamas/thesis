<x-rounded-container>

    <div class="prose flex flex-col md:flex-row md:justify-between w-full min-w-full">
        <h1>{{__('general.timetable')}}</h1>
        <button class="btn btn-success" onclick="exportModal.showModal()">{{__('general.exportTimeTable')}}</button>
    </div>

    <div class="mt-5" wire:ignore>

        <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;" id="loadingIndicator">
            <span class="loading loading-dots loading-lg"></span>
        </div>

        <div id="timetable" class="">
        </div>
    </div>

    <dialog id="exportModal" class="modal" wire:ignore.self>
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.exportTimeTable')}}</h3>
            @if($user->calendarUUID)
                <div class="flex flex-col">
                    <span class="text-md">{{__('general.giveThisURLInYourCalenderApp')}}:</span>
                    <span class="text-success text-lg">{{route('export-timetable', ['uuid' => $user->calendarUUID])}}</span>
                </div>
            @else
                <span>{{__('general.clickButtonToGenerateExport')}}</span>
            @endif
            <div class="modal-action">
                @if($user->calendarUUID)
                    <button class="btn btn-error" wire:click="deleteExportUUID">{{__('general.disableExport')}}</button>
                @else
                    <button class="btn btn-success" wire:click="generateExportUUID">{{__('general.exportTimeTable')}}</button>
                @endif
                <form method="dialog">
                    <button class="btn">{{__('general.close')}}</button>
                </form>
            </div>
        </div>
    </dialog>
    @script
    <script data-navigate-once>
        let loading = document.getElementById('loadingIndicator');
        let calendarEl = document.getElementById('timetable');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: '{{App::currentLocale()}}',
            initialView: getInitialView(),
            slotMinTime: '8:00:00',
            nowIndicator: true,
            expandRows: true,
            eventMaxStack: 1,
            views: {
                timeGridDay: {
                    type: 'timeGrid',
                    duration: {days: 1},
                },
                timeGridTwoDay: {
                    type: 'timeGrid',
                    duration: {days: 2},
                },
                timeGridWeek: {
                    type: 'timeGrid',
                    duration: {weeks: 1},
                },
            },
            eventClick: function (info) {
                if(info.event.extendedProps.allowClick) {
                    Livewire.navigate('/teacher-class/' + info.event.id);
                }
            },
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
            windowResize: function (view) {
                let width = window.innerWidth;
                if(width < 640) {
                    calendar.changeView('timeGridDay');
                } else if(width < 1024) {
                    calendar.changeView('timeGridTwoDay');
                } else {
                    calendar.changeView('timeGridWeek');
                }
            }
        });
        calendar.render();

        function getInitialView() {
            let width = window.innerWidth;
            if(width < 640) {
                return 'timeGridDay';
            } else if(width < 1024) {
                return 'timeGridTwoDay';
            } else {
                return 'timeGridWeek';
            }
        }
    </script>
    @endscript
</x-rounded-container>
