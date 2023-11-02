<div class="modal-box">
    <h3 class="font-bold text-lg">{{__('general.changeRoles')}} - {{$user->name}}</h3>
    <form class="mx-auto mt-3">
        <div class="form-control w-52">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('general.superadmin')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model.live="superadmin" />
            </label>
        </div>

        <div class="form-control w-52">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('general.admin')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model.live="admin" />
            </label>
        </div>

        <div class="form-control w-52">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('general.teacher')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model.live="teacher" />
            </label>
        </div>

        <div class="form-control w-52">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('general.student')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model.live="student" />
            </label>
        </div>
    </form>
    <div class="modal-action">
        <form method="dialog">
            <button class="btn btn-accent"
                    wire:click="$dispatch('updateRoles')" wire:loading.attr="disabled">{{__('general.save')}}</button>
            <button class="btn">{{__('general.close')}}</button>
        </form>
    </div>
    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading.delay.longest></span>
    </div>
</div>
