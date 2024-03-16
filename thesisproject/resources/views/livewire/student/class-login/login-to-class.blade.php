<div class="flex flex-col justify-center items-center relative">

    <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;" >
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>

    <div class="absolute inset-0 flex items-center justify-center z-[9999]" wire:loading>
    </div>


    <div class="w-fit min-w-fit text-lg font-bold">
        <h1>{{$attendance->Class->Course->Subject->name}}
            - {{$attendance->Class->Course->course_id}} {{__('teacher.course')}}
            ({{$attendance->Class->Course->Term ? $attendance->Class->Course->Term->name : '-'}})</h1>
    </div>

    <div class="divider"></div>
    <div class="flex flex-row justify-start items-center gap-2 text-lg">
        <x-icons.time_fill_small class="inline"/>
        <span class="font-bold">{{__('general.startTime')}}: </span>
        {{\Carbon\Carbon::parse($attendance->Class->start_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
    </div>

    <div class="flex flex-row justify-start items-center gap-2 text-lg">
        <x-icons.time_fill_small class="inline"/>
        <span class="font-bold">{{__('general.endTime')}}: </span>
        {{\Carbon\Carbon::parse($attendance->Class->end_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
    </div>

    <div class="flex flex-row justify-start items-center gap-2 text-lg">
        <x-icons.map_fill_small class="inline"/>
        <span class="font-bold">{{__('general.place')}}: </span>
        {{$attendance->Class->Place ? $attendance->Class->Place->name : '-'}}
    </div>

    <div class="flex flex-row justify-start items-center gap-2 text-lg">
        <x-icons.cogwheel-fill-small class="inline"/>
        <span class="font-bold">{{__('student.status')}}: </span>
        @switch($attendance->attendance)
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
                    {{__('teacher.late')}} ({{$attendance->late_minutes}} {{__('teacher.minutes')}})
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
    </div>

    @if($attendance->attendance == 'not_filled')
        <button class="btn btn-success mt-2" wire:click="setPresence"><x-icons.person_fill_small />{{__('student.iAmPresent')}}</button>
    @endif

</div>
