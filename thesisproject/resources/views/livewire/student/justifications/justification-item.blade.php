<div class="collapse collapse-arrow bg-base-200 mt-3">
    @if(! $deleted)
        <input type="checkbox" wire:model.live="isOpened"/>
        <div class="collapse-title text-xl font-medium">
            @if($justification->type == 'other')
                {{__('student.otherJustification')}}
            @else
                {{__('student.doctorJustification')}}
            @endif : {{\Carbon\Carbon::parse($justification->start_date)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
            <span class="font-bold text-lg"> - </span> {{\Carbon\Carbon::parse($justification->end_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
        </div>
        <div class="collapse-content">
            <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;">
                <span class="loading loading-dots loading-lg" wire:loading></span>
            </div>

            <div class="absolute inset-0 flex items-center justify-center z-[9999]" wire:loading>
            </div>
            @if($isOpened)
                <div class="divider mt-1 p-0"></div>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 xl:gap-12">
                    <div class="flex flex-col gap-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
                            <div class="flex flex-col">
                                <span class="flex flex-row items-center gap-1"><x-icons.time_fill_small />{{__('general.startTime')}}:</span>
                                <span>{{\Carbon\Carbon::parse($justification->start_date)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="flex flex-row items-center gap-1"><x-icons.time_fill_small />{{__('general.endTime')}}:</span>
                                <span>{{\Carbon\Carbon::parse($justification->end_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}</span>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <span class="flex flex-row items-center gap-1"><x-icons.message_fill_small />{{__('student.comment')}}:</span>
                                <span>{{$justification->description}}</span>
                            </div>

                            <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                                <span class="flex flex-row items-center gap-1"><x-icons.photo_fill_small />{{__('student.uploadedPictures')}}:</span>
                                <div class="flex flex-row flex-wrap gap-2">
                                    @foreach($justification->Pictures as $picture)
                                        <img src="{{asset('storage/'.$picture->picture_name)}}" alt="Justification picture" class="w-1/6" style="max-width: 200px; max-height: 200px; object-fit: cover; object-position: center;">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <span class="flex flex-row items-center gap-1"><x-icons.person_fill_small />{{__('student.teacherResponses')}}:</span>
                            @foreach($justification->GetTeachers()->get() as $teacher)
                                <div class="badge flex flex-row flex-wrap gap-2">
                                    <span>{{$teacher->name}}</span>
                                    @switch($teacher->pivot->status)
                                        @case('accepted')
                                            <div class="badge badge-success">
                                                {{__('student.accepted')}}
                                            </div>
                                            @break

                                        @case('denied')
                                            <div class="badge badge-error">
                                                {{__('student.rejected')}} ({{$teacher->pivot->comment}})
                                            </div>
                                            @break

                                        @case('na')
                                            <div class="badge badge-info">
                                                {{__('student.noResponse')}}
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="prose">
                            <h3>{{__('student.affectedClassesAndTeachers')}}:</h3>
                        </div>
                        <ul class="menu bg-base-200 w-full rounded-box">
                            @foreach($this->getAffectedClasses() as $subject)
                                <li>
                                    <details open>
                                        <summary class="font-bold text-xl text-success">{{$subject->id}}
                                            - {{$subject->name}}</summary>
                                        <ul>
                                            @foreach($subject->CoursesWithClassesBetweenDatesAndStudents($justification->user_id, $justification->start_date, $justification->end_time)->get() as $course)
                                                <li>
                                                    <details open>
                                                        <summary
                                                            class="text-lg text-info">{{$course->course_id}}
                                                            ( {{__('general.teachers')}}
                                                            : @foreach($course->Teachers as $teacher)
                                                                {{$teacher->name}}@if(! $loop->last), @endif
                                                            @endforeach )</summary>
                                                        <ul>
                                                            @foreach($course->ClassesBetweenTimes($justification->start_date, $justification->end_time)->get() as $class)
                                                                <li>
                                                                    <a disabled>
                                                                        {{\Carbon\Carbon::parse($class->start_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
                                                                        - {{\Carbon\Carbon::parse($class->end_time)->isoFormat('YYYY.MM.DD, dddd, HH:mm')}}
                                                                        @switch($class->GetStudent(Auth::user()->id)->first()->pivot->attendance)
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
                                                                                    {{__('teacher.late')}}
                                                                                    ({{$attendance->late_minutes}} {{__('teacher.minutes')}}
                                                                                    )
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
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </details>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </details>
                                </li>
                            @endforeach
                        </ul>

                        <div class="flex flex-row justify-end mt-5">
                            <button class="btn btn-error" onclick="justificationDeleteModal{{$justification->id}}.showModal()"><x-icons.delete_fill_small />{{__('general.delete')}}</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @teleport('body')
        <dialog id="justificationDeleteModal{{$justification->id}}" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-error">{{__('general.delete')}}</h3>
                <p class="py-4">{{__('student.confirmDeleteJustification')}}</p>
                <div class="modal-action">
                    <button class="btn btn-error" wire:click="deleteJustification"><x-icons.delete_fill_small />{{__('general.delete')}}</button>
                    <form method="dialog">
                        <button class="btn">{{__('general.close')}}</button>
                    </form>
                </div>
            </div>
        </dialog>
        @endteleport
    @endif
</div>
