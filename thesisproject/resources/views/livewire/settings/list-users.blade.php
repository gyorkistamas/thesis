<div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0">{{__('general.userSettings')}}</h1>
        <div class="min-w-full max-w-full flex flex-col items-center gap-3 mt-2 md:flex-row md:min-w-fit md:max-w-fit">
            <button class="btn btn-success w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"
                          clip-rule="evenodd"/>
                </svg>
                {{__('general.createNewUser')}}</button>
            <button class="btn btn-success w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"
                          clip-rule="evenodd"/>
                </svg>
                {{__('general.importUsers')}}</button>
        </div>
    </div>
    <div class="flex flex-col flex-wrap gap-2 content-center lg:flex-row mb-5">
        <input type="text"
               placeholder="{{__('general.search')}}: {{__('general.neptunCode')}} {{__('general.or')}} {{__('general.name')}}"
               class="input input-bordered input-accent w-full max-w-xs mx-auto lg:mx-0" wire:model.live="search"/>
        <div class="flex flex-col flex-wrap content-center md:flex-row gap-5">
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.superadmin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.admin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.teacher')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.student')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent"/>
                </label>
            </div>
        </div>
    </div>

    @if($users->count() != 0)
        <div class="">
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
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="{{$user->get_pic()}}" alt="profil_pic"/>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{$user->name}}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->hasRole('superadmin'))
                                <div class="badge badge-error gap-2">
                                    {{__('general.superadmin')}}
                                </div>
                            @endif
                            @if($user->hasRole('admin'))
                                <div class="badge badge-warning gap-2">
                                    {{__('general.admin')}}
                                </div>
                            @endif
                            @if($user->hasRole('teacher'))
                                <div class="badge badge-success gap-2">
                                    {{__('general.teacher')}}
                                </div>
                            @endif
                            @if($user->hasRole('student'))
                                <div class="badge badge-info gap-2">
                                    {{__('general.student')}}
                                </div>
                            @endif
                        </td>
                        <th>
                            <div class="dropdown dropdown-hover">
                                <label tabindex="0" class="btn m-1 btn-sm">{{__('general.options')}}</label>
                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li><a class="text-warning"
                                           onclick="modifyModal{{$user->id}}.showModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                                                <path
                                                    d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"/>
                                            </svg>
                                            {{__('general.edit')}}</a>
                                    </li>
                                    <li><a onclick="deleteModal{{$user->id}}.showModal()"
                                           class="text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                      d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            {{__('general.delete')}}</a></li>
                                </ul>
                            </div>
                            <dialog id="modifyModal{{$user->id}}" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">{{__('general.edit')}}</h3>
                                    <livewire:update-profile-component :user="$user" wire:key="{{$user->id}}"/>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn" wire:click="redraw">{{__('general.close')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                            <dialog id="deleteModal{{$user->id}}" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">{{__('general.delete')}}</h3>
                                    <p class="py-4 text-lg">{{$user->neptun}} - {{$user->name}}</p>
                                    <h2 class="text-error text-xl">{{__('general.confirmDelete')}}</h2>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn btn-error"
                                                    wire:click="deleteUser({{$user->id}})">{{__('general.delete')}}</button>
                                            <button class="btn">{{__('general.close')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
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
</div>
