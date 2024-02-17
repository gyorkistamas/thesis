<div class="card bg-base-100 shadow-xl mb-4 w-full md:w-full relative">
    <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;" >
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>

    <div class="absolute inset-0 flex items-center justify-center z-[9999]" wire:loading>
    </div>

    <div class="card-body flex flex-col p-2 px-3 md:flex-row md:w-full md:max-w-full md:justify-between" wire:loading.class="blur-sm">
        <div class="flex flex-col items-center mb-2 md:flex-row md:gap-2">
            <div class="avatar">
                <div class="w-8 rounded">
                    <img src="{{ $student->get_pic() }}" alt="{{ $student->name }}">
                </div>
            </div>
            <div class="flex flex-col items-center md:items-start">
                <span>{{$student->neptun}}</span>
                <span>{{$student->name}}</span>
            </div>
        </div>

        <div class="flex flex-col">
            @if($isJustified)
                <div class="tooltip" data-tip="{{__('teacher.studentHasAcceptedJustification')}}">
                    <div class="join join-vertical md:join-horizontal">
                        <!-- TODO igazolt óra ellenőrzése és hiányzások száma -->
                        <button class="btn btn-sm join-item btn-info @if($pivot->attendance != 'not_filled') btn-outline @endif" disabled>{{__('teacher.notFilled')}}</button>
                        <button class="btn btn-sm join-item btn-success @if($pivot->attendance != 'present') btn-outline @endif" wire:click="setAttendance('present')">{{__('teacher.present')}}</button>
                        <details class="dropdown join-item dropdown-top dropdown-end" id="lateDropdown{{$student->id}}">
                            <summary tabindex="0" class="btn join-item btn-sm btn-warning  w-full @if($pivot->attendance != 'late') btn-outline @endif" disabled>{{__('teacher.late')}} @if($pivot->late_minutes != 0) ({{$pivot->late_minutes}} {{__('teacher.minutes')}}) @endif</summary>
                            <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-100">
                                <div class="card-body">
                                    <input type="number" class="input input-bordered w-full" wire:model="lateMinutes" min="1" max="500">
                                    <button class="btn btn-sm btn-success" wire:click="setLateMinutes">{{__('general.save')}}</button>
                                </div>
                            </div>
                        </details>
                        <button class="btn btn-sm join-item btn-warning @if($pivot->attendance != 'justified') btn-outline @endif @if($pivot->attendance == 'justified') pointer-events-none @endif" wire:click="setAttendance('justified')">{{__('teacher.justified')}}</button>
                        <button class="btn btn-sm join-item btn-error @if($pivot->attendance != 'missing') btn-outline @endif" wire:click="setAttendance('missing')" disabled>{{__('teacher.absent')}}</button>
                    </div>
                </div>
            @else
                <div class="join join-vertical md:join-horizontal">
                    <!-- TODO igazolt óra ellenőrzése és hiányzások száma -->
                    <button class="btn btn-sm join-item btn-info @if($pivot->attendance != 'not_filled') btn-outline @endif pointer-events-none">{{__('teacher.notFilled')}}</button>
                    <button class="btn btn-sm join-item btn-success @if($pivot->attendance != 'present') btn-outline @endif" wire:click="setAttendance('present')">{{__('teacher.present')}}</button>
                    <details class="dropdown join-item dropdown-top dropdown-end" id="lateDropdown{{$student->id}}">
                        <summary tabindex="0" class="btn join-item btn-sm btn-warning  w-full @if($pivot->attendance != 'late') btn-outline @endif">{{__('teacher.late')}} @if($pivot->late_minutes != 0) ({{$pivot->late_minutes}} {{__('teacher.minutes')}}) @endif</summary>
                        <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-100">
                            <div class="card-body">
                                <input type="number" class="input input-bordered w-full" wire:model="lateMinutes" min="1" max="500">
                                <button class="btn btn-sm btn-success" wire:click="setLateMinutes">{{__('general.save')}}</button>
                            </div>
                        </div>
                    </details>
                    <button class="btn btn-sm join-item btn-warning @if($pivot->attendance != 'justified') btn-outline @endif" wire:click="setAttendance('justified')">{{__('teacher.justified')}}</button>
                    <button class="btn btn-sm join-item btn-error @if($pivot->attendance != 'missing') btn-outline @endif" wire:click="setAttendance('missing')">{{__('teacher.absent')}}</button>
                </div>
            @endif

            <div class="mt-2 @if($notJustifiedAbsents >= config('presencetracker.maxNotJustifiedAbsences')) text-error @endif">
                {{__('teacher.numberOfAbsences', ['number' =>  $allAbsents, 'notjustified' => $notJustifiedAbsents])}}
            </div>
        </div>


    </div>

    <dialog id="lateModal{{$student->id}}" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Hello!</h3>
            <p class="py-4">Press ESC key or click the button below to close</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</div>
