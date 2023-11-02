<div class="flex flex-col md:flex-row gap-2 align-middle">
    <form class="mt-3 flex flex-col gap-3">
        <input type="text" placeholder="{{__('general.neptunCode')}}" class="input input-bordered input-accent w-full max-w-xs" wire:model="neptun"/>
        @error('neptun')
        <div class="alert alert-error p-2 ps-3">
            <span class="text-sm">{{$message}}</span>
        </div>
        @enderror
        <input type="text" placeholder="{{__('general.name')}}" class="input input-bordered input-accent w-full max-w-xs" wire:model="name"/>
        @error('name')
        <div class="alert alert-error p-2 ps-3">
            <span class="text-sm">{{$message}}</span>
        </div>
        @enderror
        <input type="email" placeholder="{{__('general.email')}}" class="input input-bordered input-accent w-full max-w-xs" wire:model="email"/>
        @error('email')
        <div class="alert alert-error p-2 ps-3">
            <span class="text-sm">{{$message}}</span>
        </div>
        @enderror
    </form>

    <div class="mt-3">
        <form class="mx-auto">
            <div class="form-control w-52">
                <label class="cursor-pointer label">
                    <span class="label-text">{{__('general.superadmin')}}</span>
                    <input type="checkbox" class="toggle toggle-accent" wire:model="superadmin" />
                </label>
            </div>

            <div class="form-control w-52">
                <label class="cursor-pointer label">
                    <span class="label-text">{{__('general.admin')}}</span>
                    <input type="checkbox" class="toggle toggle-accent" wire:model="admin" />
                </label>
            </div>

            <div class="form-control w-52">
                <label class="cursor-pointer label">
                    <span class="label-text">{{__('general.teacher')}}</span>
                    <input type="checkbox" class="toggle toggle-accent" wire:model="teacher" />
                </label>
            </div>

            <div class="form-control w-52">
                <label class="cursor-pointer label">
                    <span class="label-text">{{__('general.student')}}</span>
                    <input type="checkbox" class="toggle toggle-accent" wire:model="student" />
                </label>
            </div>
        </form>
    </div>
</div>
