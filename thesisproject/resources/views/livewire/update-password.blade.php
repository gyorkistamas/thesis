<div>
    <form class="flex flex-col" wire:submit="changePassword">
        <span class="prose w-fill mx-auto mb-3"><h1>{{__('auth.changePassword')}}</h1></span>
        <input type="password" wire:model.live="currentPassword" class="input input-bordered input-primary mb-3" placeholder="{{__('auth.currentPassword')}}" />
        @error('currentPassword')<x-error-alert class="mb-2">{{$message}}</x-error-alert> @enderror

        <input type="password" wire:model.live="password" class="input input-bordered input-primary mb-3" placeholder="{{__('auth.newPassword')}}" />
        @error('password')<x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror

        <input type="password" wire:model.live="password_confirmation" class="input input-bordered input-primary mb-3" placeholder="{{__('auth.newPasswordAgain')}}" />
        @error('email')<x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror

        <button type="submit" class="btn btn-primary">{{__('general.send')}}</button>
    </form>
</div>
