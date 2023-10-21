<div>
        <form class="flex flex-col" wire:submit="updateUser">
            <img src="{{$user->get_pic()}}" class="rounded-box w-[100px] h-[100px] mx-auto" />
            <span class="mx-auto">{{__('auth.picChange')}}</span>
            <hr class="my-5"/>

            <input type="text" wire:model.live="neptun" class="input input-bordered input-primary mb-3" placeholder="{{__('general.neptunCode')}}" />
            @error('neptun')<x-error-alert class="mb-2">{{$message}}</x-error-alert> @enderror
            <input type="text" wire:model.live="name" class="input input-bordered input-primary mb-3" placeholder="{{__('general.name')}}" />
            @error('name')<x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror
            <input type="email" wire:model.live="email" class="input input-bordered input-primary mb-3" placeholder="{{__('general.email')}}" />
            @error('email')<x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror
            <button type="submit" class="btn btn-primary">{{__('general.send')}}</button>
        </form>
</div>
