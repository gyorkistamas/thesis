<div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.userSettings')}}</h1>
        <div class="min-w-full max-w-full flex flex-col items-center gap-3 mt-2 md:flex-row md:min-w-fit md:max-w-fit">
            <button class="btn btn-success w-fit" onclick="newUserModal.showModal()">
                <x-icons.plus_fill_small/>{{__('general.createNewUser')}}</button>
            <button class="btn btn-success w-fit" onclick="importModal.showModal()">
                <x-icons.plus_fill_small/>{{__('general.importUsers')}}</button>
        </div>
    </div>
    <div class="flex flex-col flex-wrap gap-2 content-center lg:flex-row mb-5">
        <form class="w-full max-w-xs mx-auto lg:mx-0 flex flex-row gap-2 min-w-full justify-center md:justify-start"
              wire:submit="searchUsers">
            <input type="search"
                   placeholder="{{__('general.search')}}: {{__('general.neptunCode')}} {{__('general.or')}} {{__('general.name')}}"
                   class="input input-bordered input-accent w-full max-w-xs lg:mx-0" wire:model.live.debounce.500ms="search"/>
        </form>
        <div class="flex flex-col flex-wrap content-center md:flex-row gap-5">
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.superadmin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model.live="superadmin" @click="$dispatch('resetUserList')"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.admin')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model.live="admin"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.teacher')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model.live="teacher"/>
                </label>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <span class="label-text me-2">{{__('general.student')}}</span>
                    <input type="checkbox" class="checkbox checkbox-accent" wire:model.live="student"/>
                </label>
            </div>
        </div>
    </div>

    @if($users->count() != 0)
        <div>
            <table class="table" wire:loading.class="blur-md">
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
                    <livewire:settings.user-row :user="$user"
                                                :key="$user->id.$superadmin.$teacher.$student.$admin.$search"/>
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
        <div class="prose mx-auto mt-2" wire:loading.class="blur-md">
            <h1>{{__('general.searchNotFound')}}</h1>
        </div>
    @endif

    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <dialog id="newUserModal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createNewUser')}}</h3>
            <livewire:settings.create-new-user/>
            <div class="modal-action">
                <button class="btn btn-success"
                        wire:click="$dispatch('createNewUser')">{{__('general.createNewUser')}}</button>
                <form method="dialog">
                    <button class="btn" wire:click="redraw">{{__('general.close')}}</button>
                </form>
            </div>
        </div>
    </dialog>
    <dialog id="importModal" class="modal modal-bottom sm:modal-middle">
        <livewire:settings.import-users/>
    </dialog>

</div>
