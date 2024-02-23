<tr wire:loading.class="blur-md">
    @if(! $deleted)
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
            <div class="dropdown dropdown-top dropdown-end">
                <label tabindex="0" class="btn m-1 btn-sm" >{{__('general.options')}}</label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="text-warning" onclick="modifyModal{{$user->id}}.showModal()" wire:loading.class="not-clickable">
                            <x-icons.edit_fill_small/>{{__('general.edit')}}</a>
                    </li>
                    <li>
                        <a class="text-accent" onclick="roleModal{{$user->id}}.showModal()" wire:loading.class="not-clickable">
                            <x-icons.tag_fill_small/>{{__('general.changeRoles')}}</a>
                    </li>
                    <li>
                        <a onclick="deleteModal{{$user->id}}.showModal()" class="text-error" wire:loading.class="not-clickable">
                            <x-icons.delete_fill_small/>{{__('general.delete')}}</a>
                    </li>
                </ul>

                @teleport('body')
                    <div>
                        <dialog id="modifyModal{{$user->id}}" class="modal modal-bottom sm:modal-middle">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">{{__('general.edit')}}</h3>
                                <livewire:update-profile-component :user="$user"/>
                                <div class="modal-action">
                                    <form method="dialog">
                                        <button class="btn" wire:click="$refresh">{{__('general.close')}}</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        <dialog id="roleModal{{$user->id}}" class="modal modal-bottom sm:modal-middle">
                            <livewire:settings.change-roles-for-user :user="$user" />
                        </dialog>
                        <dialog id="deleteModal{{$user->id}}" class="modal modal-bottom sm:modal-middle">
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
                        </dialog>
                    </div>
                @endteleport
            </div>
        </th>
    @endif
</tr>
