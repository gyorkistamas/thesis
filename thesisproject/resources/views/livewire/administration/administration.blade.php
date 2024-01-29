<div role="tablist" class="tabs tabs-lifted">

    <input type="radio" name="administration" role="tab" class="tab" aria-label="{{__('general.semesters')}}"
           value="semesters" wire:model.live="selectedTab"/>
    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
            <span class="loading loading-dots loading-lg" wire:loading></span>
        </div>
        @if($selectedTab == 'semesters')
            <livewire:administration.semester-list/>
        @endif
    </div>

    <input type="radio" name="administration" role="tab" class="tab" aria-label="{{__('general.subjects')}}"
           value="subjects" wire:model.live="selectedTab"/>
    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
            <div class="fixed inset-0 flex items-center justify-center z-0" style="pointer-events: none;">
                <span class="loading loading-dots loading-lg" wire:loading></span>
            </div>
        </div>
        @if($selectedTab == 'subjects')
            <livewire:administration.subject-list/>
        @endif
    </div>
</div>
</div>
