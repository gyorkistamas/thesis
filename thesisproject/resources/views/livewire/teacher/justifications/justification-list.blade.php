<div class="mt-2 ms-2">

    <div class="inset-0 flex items-center justify-center z-[9999] absolute" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <div class="flex flex-row justify-between items-center">
        <div class="prose">
            <h1>{{__('teacher.justifications')}}</h1>
        </div>
    </div>

    <div>
        <div class="form-control w-fit">
            <label class="cursor-pointer label">
                <span class="label-text me-2">{{__('general.showOnlyNotRespondedJustifications')}}</span>
                <input type="checkbox" class="checkbox checkbox-accent" wire:model.live="onlyNotResponded"/>
            </label>
        </div>
    </div>

    <div wire:loading.class="blur-md">
        @forelse($justifications as $justification)
            <livewire:teacher.justifications.justification-list-item :justification="$justification" :key="'justification-list-item'.$justification->id"/>
        @empty
            <div class="prose mt-4">
                <h2>{{__('general.noResult')}}</h2>
            </div>
        @endforelse
    </div>
    {{ $justifications->links()}}
</div>
