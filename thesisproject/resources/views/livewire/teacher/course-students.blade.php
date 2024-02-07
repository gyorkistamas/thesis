<div>
    <div class="flex flex-row gap-3 mb-4">
        <livewire:dropdown-select.select-multiple-students-to-add-to-course :courseId="$course->id"
                                                                            :selectedStudents="$course->Students->Pluck('id')->toArray()"
                                                                            :key="'studentDropdownSelect'.$course->id"/>
        <button class="btn btn-success" wire:click="addStudents">
            <x-icons.plus_fill_small/>{{__('general.add')}}</button>
    </div>

    <div class="md:hidden">
        @foreach($course->Students as $student)

            <div class="card card-compact bg-base-200 shadow-md mb-4">
                <div class="card-body">
                    <div class="flex flex-col gap-2 text-lg">
                        <span><span class="font-bold">{{__('general.neptunCode')}}:</span> {{$student->neptun}}</span>
                        <span><span class="font-bold">{{__('general.name')}}:</span> {{$student->name}}</span>
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

    <table class="table hidden md:table">
        <!-- head -->
        <thead>
        <tr>
            <th>{{__('general.neptunCode')}}</th>
            <th>{{__('general.name')}}</th>
            <th>{{__('general.remove')}}</th>
        </tr>
        </thead>
        <tbody>
        <!-- rows -->
        @foreach($course->Students as $student)
            <tr>
                <td>{{$student->neptun}}</td>
                <td>{{$student->name}}</td>
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
            <th>{{__('general.remove')}}</th>
        </tr>
        </tfoot>

    </table>
</div>
