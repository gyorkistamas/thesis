<tr>
    @if(!$deleted)
        <td>
            <input type="datetime-local" name="startTimeNew" class="input input-bordered input-accent w-full max-w-2xl"
                   wire:model="editStart"/>
            @error('editStart')
            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
            @enderror
        </td>
        <td>
            <input type="datetime-local" name="startTimeNew" class="input input-bordered input-accent w-full max-w-2xl"
                   wire:model="editEnd"/>
            @error('editEnd')
            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
            @enderror
        </td>
        <td>
            <livewire:dropdown-select.single-place-select :key="'editPlaceSelection'.$class->id"
                                                          :selectedId="$editPlace" :classId="$class->id" class="w-full max-w-2xl"/>
            @error('editPlace')
            <x-error-alert class="mt-2">{{$message}}</x-error-alert>
            @enderror
        </td>
        <td>
            <div class="dropdown dropdown-top dropdown-end" wire:loading.class="not-clickable">
                <label tabindex="0" class="btn m-1 btn-sm">{{__('general.options')}}</label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <button class="text-warning"  wire:loading.class="not-clickable"><x-icons.edit_fill_small/>{{__('general.edit')}}</button>
                    </li>
                    <li>
                        <a onclick="classDelete{{$class->id}}.showModal()" class="text-error" wire:loading.class="not-clickable">
                            <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
                    </li>
                </ul>
            </div>
            <dialog id="classDelete{{$class->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.deleteClass')}}</h3>
                    <h3 class="font bold text-error">{{__('general.deleteClass')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error" wire:click="delete">{{__('general.deleteClass')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </td>
    @endif
</tr>
