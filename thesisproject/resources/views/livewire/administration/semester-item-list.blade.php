<tr>
    @if(!$deleted)
        <td>{{$term->name}}</td>
        <td>{{$term->start}}</td>
        <td>{{$term->end}}</td>
        <td>
            @if($term->active())
                <x-icons.check_circle_fill_small />
            @endif
        </td>
        <td>
            <div class="dropdown dropdown-top dropdown-end" wire:loading.class="not-clickable">
                <label tabindex="0" class="btn m-1 btn-sm">{{__('general.options')}}</label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="text-warning" onclick="semesterModify{{$term->id}}.showModal()" wire:loading.class="not-clickable">
                            <x-icons.edit_fill_small/>{{__('general.edit')}}</a>
                    </li>
                    <li>
                        <a onclick="semesterDelete{{$term->id}}.showModal()" class="text-error" wire:loading.class="not-clickable">
                            <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
                    </li>
                </ul>
            </div>

            <dialog id="semesterModify{{$term->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.edit')}}: {{$term->name}}</h3>
                    <div class="modal-action flex flex-col">
                        <form class="">
                            <div class="flex flex-col items-center">
                                <div>
                                    <label for="name" class="label w-min">{{__('general.name')}}: </label>
                                    <input type="text" name="name{{$term->id}}" class="input input-bordered input-accent w-full max-w-xs" wire:model="editName"/>
                                </div>
                                @error('editName')
                                <x-error-alert class="mt-3 mx-5">{{$message}}</x-error-alert>
                                @enderror
                            </div>

                            <div class="flex flex-row justify-between">
                                <div class="w-max">
                                    <label for="start" class="label mt-3">{{__('general.startDate')}}: </label>
                                    <input type="date" name="start" class="input input-bordered input-accent w-full max-w-xs" wire:model="editStart"/>
                                    @error('editStart')
                                    <x-error-alert class="mt-3">{{$message}}</x-error-alert>
                                    @enderror
                                </div>

                                <div class="w-max">
                                    <label for="end" class="label mt-3">{{__('general.endDate')}}: </label>
                                    <input type="date" name="end" class="input input-bordered input-accent w-full max-w-xs" wire:model="editEnd"/>
                                    @error('editEnd')
                                    <x-error-alert class="mt-3">{{$message}}</x-error-alert>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <div class="flex flex-row gap-3 mt-5 justify-end">
                            <button class="btn btn-success" wire:click="edit" wire:confirm="Do you?">{{__('general.editSemester')}}</button>
                            <form method="dialog">
                                <button class="btn">{{__('general.close')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </dialog>
            <dialog id="semesterDelete{{$term->id}}" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">{{__('general.deleteSemester')}}</h3>
                    <h3 class="font bold text-error">{{__('general.confirmSemesterDelete')}}</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-error" wire:click="delete">{{__('general.deleteSemester')}}</button>
                            <button class="btn">{{__('general.close')}}</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </td>
    @endif
</tr>
