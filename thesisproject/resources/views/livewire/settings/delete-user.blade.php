<div class="modal-box">
    <h3 class="font-bold text-lg">{{__('general.delete')}}</h3>
    @if($user)<p class="py-4 text-lg">{{$user->neptun}} - {{$user->name}}</p> @endif
    <h2 class="text-error text-xl">{{__('general.confirmDelete')}}</h2>
    <div class="modal-action">
        <form method="dialog">
            <button class="btn btn-error"
                    wire:click="deleteUser" wire:loading.attr="disabled">{{__('general.delete')}}</button>
            <button class="btn">{{__('general.close')}}</button>
        </form>
    </div>
    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading.delay.longest></span>
    </div>
</div>
