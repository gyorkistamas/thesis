<div class="collapse collapse-arrow border border-base-300 bg-base-200 mt-2 @if($isOpen) collapse-open @else collapse-close @endif @if($deleted) hidden @endif">
    @if(!$deleted)
        <input type="checkbox" wire:model.live="isOpen"/>
        <div class="collapse-title text-xl font-medium">
            {{$subject->id}} - {{$subject->name}}
        </div>
        <div class="collapse-content overflow-visible">
            <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
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
                        <livewire:dropdown-select.teacher-single-select :key="'teacherSelection'.$subject->id.$subjectManager" :selectedId="$subjectManager ?? null" :subjectId="$subject->id"/>
                        @error('subjectManager')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror
                    </div>

                    <button class="btn btn-success" wire:click="updateSubject"><x-icons.edit_fill_small />{{__('general.updateSubject')}}</button>
                    <button class="btn btn-error" onclick="subjectDelete{{$subject->id}}.showModal()"><x-icons.delete_fill_small />{{__('general.deleteSubject')}}</button>
                </div>
            @endif

            <dialog id="subjectDelete{{$subject->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.deleteSubject')}}</h3>
                    <h3 class="font bold text-error">{{__('general.confirmSubjectDelete')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error" wire:click="deleteSubject">{{__('general.deleteSubject')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>

    @endif
</div>
