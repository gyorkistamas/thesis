<div>

    <div class="fixed inset-0 flex items-center justify-center z-[9999]" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-[9999]" wire:loading>
    </div>

    <div class="flex flex-col md:flex-row gap-4 mb-4 md:mb-3 ms-2">
        <span class="my-auto">{{__('general.search')}}: </span>
        <input type="search" name="code" class="input input-bordered input-accent"
               placeholder="{{__('general.subjectCode')}}" wire:model.live.debounce.250ms="codeSearch"/>
        <input type="search" name="name" class="input input-bordered input-accent"
               placeholder="{{__('general.subjectName')}}" wire:model.live.debounce.250ms="nameSearch"/>

        <livewire:dropdown-select.select-single-semester :selectedId="null" :courseId="-1" :autoSelect="true" />
    </div>


    @if($subjects->count() > 0)
        @foreach($subjects as $subject)
            <livewire:teacher.subject-dropdown :subject="$subject" :key="$subject->id.$semesterSearch.$nameSearch.$codeSearch" :semesterSearch="$semesterSearch"/>
        @endforeach
    @else
        <div class="prose">
            <h1>{{__('general.noResult')}}</h1>
        </div>
    @endif

</div>
