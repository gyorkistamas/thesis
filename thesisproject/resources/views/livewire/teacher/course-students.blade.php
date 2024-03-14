<div>

    <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>

    <div class="absolute inset-0 flex items-center justify-center z-[9999]" wire:loading>
    </div>


    <div class="flex flex-row gap-3 mb-4" wire:loading.class="blur-md">
        <livewire:dropdown-select.select-multiple-students-to-add-to-course :courseId="$course->id"
                                                                            :selectedStudents="$course->Students->Pluck('id')->toArray()"
                                                                            :key="'studentDropdownSelect'.$course->id"/>
        <button class="btn btn-success" wire:click="addStudents">
            <x-icons.plus_fill_small/>{{__('general.add')}}</button>
    </div>

    <div class="md:hidden" wire:loading.class="blur-md">
        @foreach($course->Students as $student)

            <div class="card card-compact bg-base-200 shadow-md mb-4">
                <div class="card-body">
                    <div class="flex flex-col gap-2 text-lg">
                        <span><span class="font-bold">{{__('general.neptunCode')}}:</span> {{$student->neptun}}</span>
                        <span><span class="font-bold">{{__('general.name')}}:</span> {{$student->name}}</span>

                        <span><span class="font-bold">{{__('teacher.allMissedClassesNumber')}}:</span> {{$this->getMissingCount($student)}}</span>
                        <span><span
                                class="font-bold @if($this->getNotJustified($student) >= config('presencetracker.maxNotJustifiedAbsences')) @endif">{{__('teacher.unJustifiedAbsences')}}:</span> {{$this->getNotJustified($student)}}</span>
                        <span><span
                                class="font-bold">{{__('teacher.cumulatedLateMinutes')}}:</span> {{$this->getLateMinutes($student)}} {{__('teacher.minutes')}}</span>
                    </div>
                    <div class="card-actions justify-end">
                        <button class="btn btn-error btn-sm"
                                wire:click="removeStudent({{$student->id}})">
                            <x-icons.delete_fill_small/>{{__('general.remove')}}
                        </button>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <table class="table hidden md:table" wire:loading.class="blur-md">
        <!-- head -->
        <thead>
        <tr>
            <th>{{__('general.neptunCode')}}</th>
            <th>{{__('general.name')}}</th>
            <th>{{__('teacher.allMissedClassesNumber')}}</th>
            <th>{{__('teacher.unJustifiedAbsences')}}</th>
            <th>{{__('teacher.cumulatedLateMinutes')}}</th>
            <th>{{__('general.remove')}}</th>
        </tr>
        </thead>
        <tbody>
        <!-- rows -->
        @foreach($course->Students as $student)
            <tr>
                <td>{{$student->neptun}}</td>
                <td>{{$student->name}}</td>
                <td>{{$this->getMissingCount($student)}}</td>
                <td class="@if($this->getNotJustified($student) >= config('presencetracker.maxNotJustifiedAbsences')) @endif">{{$this->getNotJustified($student)}}</td>
                <td>{{$this->getLateMinutes($student)}} {{__('teacher.minutes')}}</td>
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
            <th>{{__('teacher.allMissedClassesNumber')}}</th>
            <th>{{__('teacher.unJustifiedAbsences')}}</th>
            <th>{{__('teacher.cumulatedLateMinutes')}}</th>
            <th>{{__('general.remove')}}</th>
        </tr>
        </tfoot>
    </table>
</div>
