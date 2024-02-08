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

        <div>
            {{QrCode::size(250)->generate('https://www.youtube.com/watch?v=dQw4w9WgXcQ')}}
        </div>
    </div>
</div>
