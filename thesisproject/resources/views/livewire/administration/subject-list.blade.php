<div>
    <div class="fixed inset-0 flex items-center justify-center z-[9999]" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.subjects')}}</h1>
        <label for="newSubjectModel" class="btn btn-success w-fit">
            <x-icons.plus_fill_small/>{{__('general.createSubject')}}</label>
    </div>

    <div class="flex flex-row gap-4">
        <span class="my-auto">{{__('general.search')}}: </span>
        <input type="search" name="code" class="input input-bordered input-accent"
               placeholder="{{__('general.subjectCode')}}" wire:model.live.debounce.250ms="idSearch"/>
        <input type="search" name="name" class="input input-bordered input-accent"
               placeholder="{{__('general.subjectName')}}" wire:model.live.debounce.250ms="nameSearch"/>
        <button class="btn btn-warning" wire:click="resetSearch"><x-icons.delete_fill_small />{{__('general.resetSearch')}}</button>
    </div>

    <div class="mt-4">
        @forelse($subjects as $subject)
            <div >
                <livewire:administration.subject-drop-down :subject="$subject" :key="$subject->id.$idSearch.$nameSearch.$subjectCode.$subjectCredit.$subjectDescription.$subjectName.$subjectManager.$created"/>
            </div>
        @empty
            <div class="prose mx-auto mt-2">
                <h1>{{__('general.searchNotFound')}}</h1>
            </div>
        @endforelse

        {{$subjects->links()}}
    </div>


    <input type="checkbox" id="newSubjectModel" class="modal-toggle" wire:ignore.self/>
    <div class="modal modal-bottom sm:modal-middle" role="dialog">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createSubject')}}</h3>
            <div class="modal-action flex flex-col">
                <div class="">
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

                    <div>
                        <label for="description" class="label mt-2">{{__('general.subjectDescription')}}</label>
                        <input type="text" name="description" class="input input-bordered input-accent w-full"
                               wire:model="subjectDescription"/>
                        @error('subjectDescription')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror
                    </div>
                    <div>
                        <label for="credit" class="label mt-2">{{__('general.subjectCredit')}}</label>
                        <input type="number" name="credit" class="input input-bordered input-accent w-full"
                               wire:model="subjectCredit"/>
                        @error('subjectCredit')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror
                    </div>
                    <div>
                        <label for="manager" class="label mt-2">{{__('general.subjectManager')}}</label>
                        <livewire:dropdown-select.teacher-single-select :key="'teacherSelection'.$idSearch.$nameSearch" :selectedId="null" :subjectId="-1" />
                        @error('subjectManager')
                        <x-error-alert class="mt-2">{{$message}}</x-error-alert>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row gap-3 mt-5 justify-end">
                    <button class="btn btn-success" wire:click="createSubject">{{__('general.createSubject')}}</button>
                    <label class="btn" for="newSubjectModel">{{__('general.close')}}</label>
                </div>
            </div>
        </div>
    </div>
</div>
