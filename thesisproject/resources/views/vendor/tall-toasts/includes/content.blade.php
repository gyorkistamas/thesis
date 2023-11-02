<div
    class="overflow-hidden z-50 cursor-pointer pointer-events-auto select-none alert flex flex-row"
    x-bind:class="{
                    'alert-info': toast.type === 'info',
                    'alert-success': toast.type === 'success',
                    'alert-warning': toast.type === 'warning',
                    'alert-error': toast.type === 'danger'
                  }"
>
    @include('tall-toasts::includes.icon')
    <div class="flex flex-col justify-start">
        <h3 class="font-bold ms-0 ps-0" x-html="toast.title" x-show="toast.title !== undefined"></h3>
        <div class="text-xs" x-show="toast.message !== undefined" x-html="toast.message"></div>
    </div>

</div>
