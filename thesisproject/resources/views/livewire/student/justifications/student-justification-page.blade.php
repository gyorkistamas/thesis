<div class="mt-2 ms-2">
    <div class="flex flex-row justify-between items-center">
        <div class="prose">
            <h1>{{__('student.myJustifications')}}</h1>
        </div>

        <label for="newJustification" class="btn btn-success">
            <x-icons.plus_fill_small />{{__('student.newJustification')}}</label>
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
                <div class="fixed inset-0 flex items-center justify-center"
                     style="pointer-events: none;">
                    <span class="loading loading-dots loading-lg" wire:loading></span>
                </div>
                <div
                    class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                    <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('student.newJustification')}}</h1>
                </div>
                <label for="newJustification"
                       class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">X</label>

                <div>

                </div>

            </div>
        </div>
    </div>
</div>
