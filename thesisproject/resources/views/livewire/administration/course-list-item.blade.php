<tr>
    @if(!$deleted)
        <td>{{$course->course_id}}</td>
        <td>{{$course->description}}</td>
        <td>{{$course->Term->name}}</td>
        <td>

            <div class="flex flex-row">
                <label for="courseDrawer{{$course->id}}" class="btn btn-success m-1 btn-sm"><x-icons.view_fill_small />{{__('general.view')}}</label>
                <a onclick="courseDelete{{$course->id}}.showModal()" class="btn btn-error m-1 btn-sm" wire:loading.class="not-clickable">
                    <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
            </div>

            <dialog id="courseDelete{{$course->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.courseDelete')}}</h3>
                    <h3 class="font bold text-error">{{__('general.courseDeleteConfirm')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error" wire:click="">{{__('general.courseDelete')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <div class="drawer z-[999]" wire:ignore.self>
                <input id="courseDrawer{{$course->id}}" type="checkbox" class="drawer-toggle" />
                <div class="drawer-side">
                    <label for="courseDrawer{{$course->id}}" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="p-4 w-11/12 min-h-full bg-base-200 text-base-content">

                            <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                                <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{$course->course_id}}</h1>
                            </div>

                            <label for="courseDrawer{{$course->id}}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">X</label>
                    </div>
                </div>
            </div>
        </td>
    @endif
</tr>
