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
