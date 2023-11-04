<div class="modal-box md:w-11/12 md:max-w-5xl">
    <h3 class="font-bold text-lg">{{__('general.importUsers')}}</h3>
    <h4 class="">{{__('general.importUsersNotice')}}</h4>
    <div class="flex flex-col md:flex-row items-center mt-3 gap-3">
        <input type="file" class="file-input file-input-bordered file-input-accent w-full max-w-xs" wire:model="file" wire:click="$dispatch('clearImportMessages')"/>
        @if($error)
            <x-error-alert class="max-w-fit">{{__('general.unableToProcess')}}</x-error-alert>
        @endif
        @if($resultFailedNum != 0 || $resultSuccessNum != 0)
            <div class="alert alert-info max-w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{__('general.importedDetails', ['success' => $resultSuccessNum, 'error' => $resultFailedNum])}}</span>
            </div>
        @endif
    </div>
    @if($failedRows)
        <div class="alert alert-error flex flex-row items-start mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <div class="flex flex-col">
                <p>{{__('general.couldNotImportLines')}}</p>
                @foreach($failedRows as $failed)
                    <p>{{$failed}}</p>
                @endforeach
            </div>
        </div>
    @endif
    <div class="modal-action">
        <button class="btn btn-success"
                wire:click="startImport" wire:loading.attr="disabled"
                @if(!$enableButton) disabled @endif>{{__('general.import')}}</button>
        <form method="dialog">
            <button class="btn" wire:click="$dispatch('redrawUserList')">{{__('general.close')}}</button>
        </form>
    </div>

    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
</div>
