<div class="mt-2 ms-2">
    <div class="flex flex-row justify-between items-center">
        <div class="prose">
            <h1>{{__('teacher.justifications')}}</h1>
        </div>
    </div>

    <div>
        <!-- Filter. -->
        <!-- TODO filters -->
    </div>

    <div>
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
