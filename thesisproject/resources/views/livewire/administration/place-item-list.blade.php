<tr>
    @if(!$deleted)
        <td>{{$place->name}}</td>
        <td>
            <div class="dropdown dropdown-top dropdown-end" wire:loading.class="not-clickable">
                <label tabindex="0" class="btn m-1 btn-sm">{{__('general.options')}}</label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="text-warning" onclick="placeModify{{$place->id}}.showModal()" wire:loading.class="not-clickable">
                            <x-icons.edit_fill_small/>{{__('general.edit')}}</a>
                    </li>
                    <li>
                        <a onclick="placeDelete{{$place->id}}.showModal()" class="text-error" wire:loading.class="not-clickable">
                            <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
                    </li>
                </ul>
            </div>

            <dialog id="placeModify{{$place->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.edit')}}: {{$place->name}}</h3>
                    <div class="modal-action flex flex-col">
                        <form class="">
                            <div class="flex flex-col items-center">
                                <div>
                                    <label for="name" class="label w-min">{{__('general.name')}}: </label>
                                    <input type="text" name="name{{$place->id}}" class="input input-bordered input-accent w-full max-w-xs" wire:model="editName"/>
                                </div>
                                @error('editName')
                                <x-error-alert class="mt-3 mx-5">{{$message}}</x-error-alert>
                                @enderror
                            </div>
                        </form>
                        <div class="flex flex-row gap-3 mt-5 justify-end">
                            <button class="btn btn-success" wire:click="edit">{{__('general.editPlace')}}</button>
                            <form method="dialog">
                                <button class="btn">{{__('general.close')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </dialog>
            <dialog id="placeDelete{{$place->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.deletePlace')}}</h3>
                    <h3 class="font bold text-error">{{__('general.deletePlaceConfirm')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error" wire:click="delete">{{__('general.deletePlace')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </td>
    @endif
</tr>
