<div
    class="alert @switch($type) @case(0) alert-success @break @case(1) alert-error @break @case(2) alert-info @break @endswitch @if(!$isOpen) hidden @endif max-w-sm fixed bottom-5 right-5 p-4 z-[1]" id="alert">
    @switch($type)
        @case (0)
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @break
        @case (1)
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @break
        @case (2)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 class="stroke-current shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            @break
    @endswitch
    <div>
        <h3 class="font-bold">{{$title}}</h3>
        <div class="text-xs">{{$message}}</div>
    </div>
    <label class="btn btn-circle swap swap-rotate">
        <input type="checkbox" wire:model.live="isOpen" id="closeButton"/>
        <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
             viewBox="0 0 512 512">
            <polygon
                points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49"/>
        </svg>
    </label>

    @persist("alertBox")
        <script data-navigate-once>
            document.addEventListener('livewire:initialized', () => {
                let closeButton = document.getElementById('closeButton');
                @this.on('startTimer', (event) => {
                    if (!event[0].autoHide)
                        return;
                    setTimeout(() => {
                        if (closeButton.checked) {
                            closeButton.click();
                        }
                    }, event[0].timer * 1000);
                });
            });
            let closeButton = document.getElementById('closeButton');
            closeButton.addEventListener('click', () => {
                console.log('fire');
            });
        </script>
    @endpersist
</div>
