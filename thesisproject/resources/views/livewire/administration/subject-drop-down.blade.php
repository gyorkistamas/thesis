<div
    class="collapse collapse-arrow border border-base-300 bg-base-200 mt-2 @if($isOpen) collapse-open @else collapse-close @endif @if($deleted) hidden @endif">
    @if(!$deleted)
        <input type="checkbox" wire:model.live="isOpen"/>
        <div class="collapse-title text-xl font-medium">
            {{$subject->id}} - {{$subject->name}}
        </div>
        <div class="collapse-content overflow-visible">
            <hr class="mb-3 mx-6"/>
            <div class="fixed inset-0 flex items-center justify-center z-[99]" style="pointer-events: none;">
                <span class="loading loading-dots loading-lg" wire:loading></span>
            </div>
            @if($isOpen)
                <div class="flex flex-row gap-3 flex-wrap">
                    <div class="flex flex-col">
                        <div>
                            <label for="id" class="label">{{__('general.subjectCode')}}</label>
                            <input type="text" name="id" class="input input-bordered input-accent w-full"
                                   wire:model="subjectCode"/>
                            @error('subjectCode')
                            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="label">{{__('general.subjectName')}}</label>
                            <input type="text" name="name" class="input input-bordered input-accent w-full"
                                   wire:model="subjectName"/>
                            @error('subjectName')
                            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div>
                            <label for="description" class="label">{{__('general.subjectDescription')}}</label>
                            <input type="text" name="description" class="input input-bordered input-accent w-full"
                                   wire:model="subjectDescription"/>
                            @error('subjectDescription')
                            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                            @enderror
                        </div>
                        <div>
                            <label for="credit" class="label">{{__('general.subjectCredit')}}</label>
                            <input type="number" name="credit" class="input input-bordered input-accent w-full"
                                   wire:model="subjectCredit"/>
                            @error('subjectCredit')
                            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="manager" class="label">{{__('general.subjectManager')}}</label>
                        <livewire:dropdown-select.teacher-single-select
                            :key="'teacherSelection'.$subject->id.$subjectManager" :selectedId="$subjectManager ?? null"
                            :subjectId="$subject->id"/>
                        @error('subjectManager')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror
                    </div>

                    <button class="btn btn-success" wire:click="updateSubject">
                        <x-icons.edit_fill_small/>{{__('general.updateSubject')}}</button>
                    <button class="btn btn-error" onclick="subjectDelete{{$subject->id}}.showModal()">
                        <x-icons.delete_fill_small/>{{__('general.deleteSubject')}}</button>

                </div>

                <hr class="my-5 mx-6"/>

                <div class="mt-5">
                    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.courses')}}</h1>
                        <div class="flex flex-row gap-3">
                            <livewire:dropdown-select.select-single-semester :selectedId="null"
                                                                             :courseId="$subject->id.'.filter'"
                                                                             :autoSelect="true"/>
                            <button class="btn btn-success" onclick="createCourse{{$subject->id}}.showModal()">
                                <x-icons.plus_fill_small/>{{__('general.createNewCourse')}}</button>
                        </div>
                    </div>

                    <div>
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>{{__('general.courseId')}}</th>
                                <th>{{__('general.courseDescription')}}</th>
                                <th>{{__('general.semester')}}</th>
                                <th>{{__('general.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($filterCoursesBySemester == '' ? $subject->Courses()->get() : $subject->CoursesInTerm($filterCoursesBySemester)->get() as $course)
                                <livewire:administration.course-list-item :course="$course" :key="$course->id.'courseItemList'"/>
                            @empty
                                <div class="prose mx-auto mt-2">
                                    <h1>{{__('general.searchNotFound')}}</h1>
                                </div>
                            @endforelse
                            <tfoot>
                            <tr>
                                <th>{{__('general.courseId')}}</th>
                                <th>{{__('general.courseDescription')}}</th>
                                <th>{{__('general.semester')}}</th>
                                <th>{{__('general.actions')}}</th>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            @endif

            <dialog id="subjectDelete{{$subject->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.deleteSubject')}}</h3>
                    <h3 class="font bold text-error">{{__('general.confirmSubjectDelete')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error"
                                    wire:click="deleteSubject">{{__('general.deleteSubject')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <dialog id="createCourse{{$subject->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.createNewCourse')}}</h3>
                    <div class="">
                        <label for="courseCode" class="label mt-2">{{__('general.courseId')}}</label>
                        <input type="text" name="courseCode" class="input input-bordered input-accent w-full"
                               wire:model="newCourseID"/>
                        @error('newCourseID')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror

                        <label for="courseDescription" class="label mt-2">{{__('general.courseDescription')}}</label>
                        <input type="text" name="courseDescription" class="input input-bordered input-accent w-full"
                               wire:model="newCourseDescription"/>
                        @error('newCourseDescription')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror

                        <label for="courseLimit" class="label mt-2">{{__('general.courseLimit')}}</label>
                        <input type="text" name="courseLimit" class="input input-bordered input-accent w-full"
                               wire:model="newCourseLimit"/>
                        @error('newCourseLimit')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror

                        <label for="teachers" class="label mt-2">{{__('general.teachers')}}</label>
                        <livewire:dropdown-select.teacher-multi-select :key="'teacherSelection'.$subject->id"
                                                                       :selectedIds="null" :courseId="-1"/>
                        @error('newCourseTeacher')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror

                        <label for="semester" class="label mt-2">{{__('general.semester')}}</label>
                        <livewire:dropdown-select.select-single-semester :key="'semesterSelection'.$subject->id"
                                                                         :selectedId="null" :courseId="-1"
                                                                         :autoSelect="true"/>
                        @error('newCourseSemester')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror


                    </div>
                    <div class="modal-action">
                        <button class="btn btn-success"
                                wire:click="createCourse">{{__('general.createNewCourse')}}</button>
                        <form method="dialog">
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>

    @endif
</div>
