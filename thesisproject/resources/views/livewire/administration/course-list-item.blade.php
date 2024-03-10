<tr>
    @if(!$deleted)
        <td>{{$course->course_id}}</td>
        <td>{{$course->description}}</td>
        <td>{{$course->Term->name}}</td>
        <td>

            <div class="flex flex-row">
                <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm">
                    <x-icons.view_fill_small/>{{__('general.view')}}</label>
                <a onclick="courseDelete{{$course->id}}.showModal()" class="btn btn-error m-1 btn-sm"
                   wire:loading.class="not-clickable">
                    <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
            </div>

            <dialog id="courseDelete{{$course->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.courseDelete')}}</h3>
                    <h3 class="font bold text-error">{{__('general.courseDeleteConfirm')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error"
                                    wire:click="deleteCourse">{{__('general.courseDelete')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <div class="drawer z-[200]" wire:ignore.self>
                <input id="courseDrawer{{$course->id}}" type="checkbox" class="drawer-toggle"/>
                <div class="drawer-side">
                    <label for="courseDrawer{{$course->id}}" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="p-4 w-11/12 min-h-full bg-base-200 text-base-content">
                        <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
                            <span class="loading loading-dots loading-lg" wire:loading></span>
                        </div>
                        <div
                            class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                            <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{$course->course_id}}</h1>
                        </div>
                        <label for="courseDrawer{{$course->id}}"
                               class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">X</label>

                        <div role="tablist" class="tabs tabs-lifted">
                            <input type="radio" name="drawertab{{$course->id}}" role="tab" class="tab"
                                   aria-label="{{__('general.courseEdit')}}" checked value="edit"
                                   wire:model.live="currentTab"/>
                            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                @if($currentTab == 'edit')
                                    <div class="">
                                        <label for="courseCode" class="label mt-2">{{__('general.courseId')}}</label>
                                        <input type="text" name="courseCode"
                                               class="input input-bordered input-accent w-full max-w-2xl"
                                               wire:model="newCourseCode"/>
                                        @error('newCourseCode')
                                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                        @enderror

                                        <label for="courseDescription"
                                               class="label mt-2">{{__('general.courseDescription')}}</label>
                                        <input type="text" name="courseDescription"
                                               class="input input-bordered input-accent w-full max-w-2xl"
                                               wire:model="newCourseDescription"/>
                                        @error('newCourseDescription')
                                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                        @enderror

                                        <label for="courseLimit"
                                               class="label mt-2">{{__('general.courseLimit')}}</label>
                                        <input type="number" name="courseLimit"
                                               class="input input-bordered input-accent w-full max-w-2xl"
                                               wire:model="newCourseLimit"/>
                                        @error('newCourseLimit')
                                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                        @enderror

                                        <label for="teachers" class="label mt-2">{{__('general.teachers')}}</label>
                                        <livewire:dropdown-select.teacher-multi-select
                                            :key="'editTeacherSelection'.$course->id"
                                            :selectedIds="$newCourseTeachers" :courseId="$course->id"
                                            class="w-full max-w-2xl"/>
                                        @error('newCourseTeachers')
                                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                        @enderror

                                        <label for="semester" class="label mt-2">{{__('general.semester')}}</label>
                                        <livewire:dropdown-select.select-single-semester
                                            :key="'editSemesterSelection'.$course->id"
                                            :selectedId="$newCourseSemester" :courseId="$course->id"
                                            :autoSelect="false" class="w-full max-w-2xl"/>
                                        @error('newCourseSemester')
                                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                        @enderror

                                        <button class="btn btn-success mt-3" wire:click="editCourse">
                                            <x-icons.edit_fill_small/>{{__('general.courseEdit')}}</button>
                                    </div>

                                @endif
                            </div>

                            <input type="radio" name="drawertab{{$course->id}}" role="tab" class="tab"
                                   aria-label="{{__('general.classTimes')}}" value="classes"
                                   wire:model.live="currentTab"/>
                            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                @if($currentTab == 'classes')
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                        <tr>
                                            <th>{{__('general.startTime')}}</th>
                                            <th>{{__('general.endTime')}}</th>
                                            <th>{{__('general.place')}}</th>
                                            <th>{{__('general.options')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- rows -->
                                        @foreach($course->Classes()->orderBy('start_time')->get() as $class)
                                            <livewire:administration.class-table-item
                                                :key="'classItem'.$course->id.$class->id" :class="$class"/>
                                        @endforeach
                                        <tr>
                                            <td>
                                                <input type="datetime-local" name="startTimeNew"
                                                       class="input input-bordered input-accent w-full max-w-2xl"
                                                       wire:model="newClassStart"/>
                                                @error('newClassStart')
                                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="datetime-local" name="endTimeNew"
                                                       class="input input-bordered input-accent w-full max-w-2xl"
                                                       wire:model="newClassEnd"/>
                                                @error('newClassEnd')
                                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                                @enderror
                                            </td>
                                            <td>
                                                <livewire:dropdown-select.single-place-select
                                                    :key="'newPlaceSelection'.$course->id"
                                                    :selectedId="null" :classId="-1" class="w-full max-w-2xl"/>
                                                @error('newClassPlace')
                                                <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm" wire:click="newClass">
                                                    <x-icons.plus_fill_small/>{{__('general.add')}}</button>
                                                <label class="cursor-pointer label">
                                                    <span
                                                        class="label-text">{{__('general.repeatUntilEndOfTermEveryWeek')}}</span>
                                                    <input type="checkbox" class="checkbox checkbox-accent"
                                                           wire:model="repeatUntilEndOfTerm"/>
                                                </label>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <!-- foot -->
                                        <tfoot>
                                        <tr>
                                            <th>{{__('general.startTime')}}</th>
                                            <th>{{__('general.endTime')}}</th>
                                            <th>{{__('general.place')}}</th>
                                            <th>{{__('general.options')}}</th>
                                        </tr>
                                        </tfoot>

                                    </table>
                                @endif
                            </div>

                            <input type="radio" name="drawertab{{$course->id}}" role="tab" class="tab"
                                   aria-label="{{__('general.students')}}" value="students"
                                   wire:model.live="currentTab"/>
                            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                                @if($currentTab == 'students')
                                    <div class="flex flex-row gap-3 mb-4">
                                        <livewire:dropdown-select.select-multiple-students-to-add-to-course
                                            :key="'studentSelection'.$course->id"
                                            :courseId="$course->id" :selectedStudents="$course->Students->pluck('id')->toArray()" />

                                        <button class="btn btn-success" wire:click="addStudents">
                                            <x-icons.plus_fill_small/>{{__('general.add')}}</button>
                                    </div>

                                    <table class="table">
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
                                                        <x-icons.delete_fill_small/>{{__('general.remove')}}</button>
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    @endif
</tr>
