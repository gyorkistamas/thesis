<div class="mt-2 ms-2">
    <div class="flex flex-row justify-between items-center">
        <div class="prose">
            <h1>{{__('student.myJustifications')}}</h1>
        </div>

        <label for="newJustification" class="btn btn-success">
            <x-icons.plus_fill_small/>{{__('student.newJustification')}}</label>
    </div>

    <div>
        <!-- List of justifications. -->
    </div>

    <div class="drawer z-[200]" wire:ignore.self>
        <input id="newJustification" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-side">
            <label for="newJustification" aria-label="close sidebar"
                   class="drawer-overlay"></label>
            <div class="p-4 w-full min-h-full bg-base-200 text-base-content">
                <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;">
                    <span class="loading loading-dots loading-lg" wire:loading></span>
                </div>

                <div class="absolute inset-0 flex items-center justify-center z-[9999]" wire:loading>
                </div>
                <div
                        class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                    <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('student.newJustification')}}</h1>
                </div>
                <label for="newJustification"
                       class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">X</label>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 xl:gap-12">
                    <div class="flex flex-col gap-5 col-span-1">
                        <div class="flex flex-col items-center gap-3 md:flex-row md:justify-start md:gap-10 md:items-start">
                            <div class="w-fit">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">{{__('student.justificationType')}}: </span>
                                    </div>
                                    <select class="select select-bordered select-accent" wire:model="type">
                                        <option value="doctor" selected>{{__('student.doctorJustification')}}</option>
                                        <option value="other">{{__('student.otherJustification')}}</option>
                                    </select>
                                </label>
                                @error('type')
                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                @enderror
                            </div>

                            <div class="w-fit">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">{{__('general.startTime')}}: </span>
                                    </div>
                                    <input type="datetime-local"
                                           class="input input-bordered input-accent w-full max-w-xs"
                                           wire:model.live="start"/>
                                </label>
                                @error('start')
                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                @enderror
                            </div>

                            <div class="w-fit">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">{{__('general.endTime')}}: </span>
                                    </div>
                                    <input type="datetime-local" placeholder="Type here"
                                           class="input input-bordered input-accent w-full max-w-xs"
                                           wire:model.live="end"/>
                                </label>
                                @error('end')
                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div>
                                <label class="form-control">
                                    <div class="label">
                                        <span class="label-text">{{__('student.comment')}}: </span>
                                    </div>
                                    <textarea class="textarea textarea-bordered textarea-accent h-24"
                                              wire:model="comment"></textarea>
                                </label>
                                @error('comment')
                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex flex-col">
                                <div class="flex md:flex-row gap-2 md:items-end  flex-col justify-center md:justify-start">
                                    <label class="form-control w-full max-w-xs">
                                        <div class="label">
                                            <span class="label-text">{{__('student.uploadPictures')}}</span>
                                        </div>
                                        <input type="file" accept="image/*" multiple
                                               class="file-input file-input-bordered file-input-accent w-full max-w-xs"
                                               wire:model.live="images" id="fileUpload"/>
                                    </label>
                                    <button class="btn btn-success btn-sm" wire:loading.attr="disabled"
                                            wire:loading.class="disabled" wire:click="uploadPics">
                                        <x-icons.plus_fill_small/>{{__('student.upload')}}</button>

                                    @script
                                    <script>
                                        $wire.on('clearFileUpload', () => {
                                            document.getElementById('fileUpload').value = null;
                                        });
                                    </script>
                                    @endscript

                                </div>
                                <div>
                                    @error('images.*')
                                    <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                    @enderror
                                    @error('uploadedPics.*')
                                    <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex flex-col mt-5 gap-3">
                                @if($uploadedPics)
                                    @foreach($uploadedPics as $image)
                                        <div class="flex flex-row gap-2 justify-start items-center">
                                            <div class="avatar">
                                                <div class="w-12 rounded">
                                                    <img src="{{ $image->temporaryUrl() }}" alt="image"/>
                                                </div>
                                            </div>
                                            <div>
                                                <span>{{$image->getClientOriginalName()}}</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-error btn-sm"
                                                        wire:click="removeImage({{ $loop->index }})">
                                                    <x-icons.delete_fill_small/>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-row justify-center md:justify-end">
                            <button class="btn btn-success" wire:click="createJustification">
                                <x-icons.plus_fill_small/>{{__('general.save')}}</button>
                        </div>

                    </div>

                    <div class="col-span-1 flex flex-col">
                        <div class="prose">
                            <h3>{{__('student.affectedClassesAndTeachers')}}:</h3>
                        </div>

                        <div>
                            @if($start && $end)
                                <ul class="menu bg-base-200 w-full rounded-box">
                                    @foreach($this->getAffectedClasses() as $subject)
                                        <li>
                                            <details open>
                                                <summary class="font-bold text-xl text-success">{{$subject->id}}
                                                    - {{$subject->name}}</summary>
                                                <ul>
                                                    @foreach($subject->CoursesWithClassesBetweenDatesAndStudents(Auth::user()->id, $start, $end)->get() as $course)
                                                        <li>
                                                            <details open>
                                                                <summary
                                                                        class="text-lg text-info">{{$course->course_id}}
                                                                    ( {{__('general.teachers')}}
                                                                    : @foreach($course->Teachers as $teacher)
                                                                        {{$teacher->name}}@if(! $loop->last)
                                                                            ,
                                                                        @endif
                                                                    @endforeach )</summary>
                                                                <ul>
                                                                    @foreach($course->ClassesBetweenTimes($start, $end)->get() as $class)
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
                            @else
                                <div class="prose">
                                    <h4>{{__('general.searchNotFound')}}</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
