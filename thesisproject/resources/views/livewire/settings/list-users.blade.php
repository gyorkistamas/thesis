<div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.userSettings')}}</h1>
        <div class="min-w-full max-w-full flex flex-col items-center gap-3 mt-2 md:flex-row md:min-w-fit md:max-w-fit">
            <button class="btn btn-success w-fit" onclick="newUserModal.showModal()" >
                <x-icons.plus_fill_small/>{{__('general.createNewUser')}}</button>
            <button class="btn btn-success w-fit" onclick="importModal.showModal()">
                <x-icons.plus_fill_small/>{{__('general.importUsers')}}</button>
        </div>
    </div>
    <div class="flex flex-col flex-wrap gap-2 content-center lg:flex-row mb-5">
        <form class="w-full max-w-xs mx-auto lg:mx-0 flex flex-row gap-2 min-w-full justify-center md:justify-start" wire:submit="searchUsers">
            <input type="search"
                   placeholder="{{__('general.search')}}: {{__('general.neptunCode')}} {{__('general.or')}} {{__('general.name')}}"
                   class="input input-bordered input-accent w-full max-w-xs lg:mx-0" wire:model="search"/>
            <button class="btn btn-success" type="submit">{{__('general.search')}}</button>
        </form>
        <div class="flex flex-col flex-wrap content-center md:flex-row gap-5">
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.superadmin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model="superadmin"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.admin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model="admin"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.teacher')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model="teacher"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.student')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model="student"/>
                </label>
            </div>
        </div>
    </div>

    @if($users->count() != 0)
        <div>
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th>{{__('general.neptunCode')}}</th>
                    <th>{{__('general.name')}}</th>
                    <th>{{__('general.roles')}}</th>
                    <th>{{__('general.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                <!-- rows -->
                @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->neptun)
                                {{$user->neptun}}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center flex-col md:flex-row gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="{{$user->get_pic()}}" alt="profil_pic"/>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-bold break-all">{{$user->name}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row flex-wrap gap-2">
                                @if($user->hasRole('superadmin'))
                                    <div class="badge badge-error h-auto">
                                        {{__('general.superadmin')}}
                                    </div>
                                @endif
                                @if($user->hasRole('admin'))
                                    <div class="badge badge-warning">
                                        {{__('general.admin')}}
                                    </div>
                                @endif
                                @if($user->hasRole('teacher'))
                                    <div class="badge badge-success">
                                        {{__('general.teacher')}}
                                    </div>
                                @endif
                                @if($user->hasRole('student'))
                                    <div class="badge badge-info">
                                        {{__('general.student')}}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <th>
                            <div class="dropdown dropdown-top dropdown-end" wire:loading.class="not-clickable">
                                <label tabindex="0" class="btn m-1 btn-sm" wire:click="$dispatch('changeSelectedUser', {id: '{{$user->id}}'})">{{__('general.options')}}</label>
                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li>
                                        <a class="text-warning" onclick="modifyModal.showModal()" wire:loading.class="not-clickable">
                                            <x-icons.edit_fill_small/>{{__('general.edit')}}</a>
                                    </li>
                                    <li>
                                        <a class="text-accent" onclick="roleModal.showModal()" wire:loading.class="not-clickable">
                                            <x-icons.tag_fill_small/>{{__('general.changeRoles')}}</a>
                                    </li>
                                    <li>
                                        <a onclick="deleteModal.showModal()" class="text-error" wire:loading.class="not-clickable">
                                            <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
                <!-- foot -->
                <tfoot>
                <tr>
                    <th>{{__('general.neptunCode')}}</th>
                    <th>{{__('general.name')}}</th>
                    <th>{{__('general.roles')}}</th>
                    <th>{{__('general.actions')}}</th>
                </tr>
                </tfoot>

            </table>
        </div>
        {{$users->links()}}
    @else
        <div class="prose mx-auto mt-2">
            <h1>{{__('general.searchNotFound')}}</h1>
        </div>
    @endif

    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <dialog id="newUserModal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createNewUser')}}</h3>
            <livewire:settings.create-new-user />
            <div class="modal-action">
                <button class="btn btn-success" wire:click="$dispatch('createNewUser')">{{__('general.createNewUser')}}</button>
                <form method="dialog">
                    <button class="btn" wire:click="redraw">{{__('general.close')}}</button>
                </form>
            </div>
        </div>
    </dialog>

    <dialog id="modifyModal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.edit')}}</h3>
            <livewire:update-profile-component />
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn" wire:click="$refresh">{{__('general.close')}}</button>
                </form>
            </div>
        </div>
    </dialog>
    <dialog id="roleModal" class="modal modal-bottom sm:modal-middle">
        <livewire:settings.change-roles-for-user />
    </dialog>
    <dialog id="deleteModal" class="modal modal-bottom sm:modal-middle">
        <livewire:settings.delete-user />
    </dialog>

    <dialog id="importModal" class="modal modal-bottom sm:modal-middle">
        <livewire:settings.import-users />
    </dialog>

</div>
