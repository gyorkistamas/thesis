<div>
    <div class="flex flex-col">
        @if(! $picture)
            <div class="tooltip w-fit mx-auto" data-tip="{{__('general.pictureSaved')}}">
                <div class="indicator">
                    <span class="indicator-item badge badge-success badge-sm"></span>
                    <img src="{{$user->get_pic()}}" class="rounded-box w-[100px] h-[100px] mx-auto"/>
                </div>
            </div>
        @else
            <div class="tooltip" data-tip="{{__('general.pictureNotSaved')}}">
                <div class="indicator">
                    <span class="indicator-item badge badge-error badge-sm"></span>
                    <img src="{{$picture->temporaryUrl()}}" class="rounded-box w-[100px] h-[100px] mx-auto"/>
                </div>
            </div>
        @endif
        <div class="flex flex-col md:justify-center gap-2 md:flex-row mt-2">
            <input type="file" wire:model.live="picture" class="file-input file-input-bordered file-input-success"/>
            <button class="btn btn-success" wire:click="savePicture"><x-icons.plus_fill_small />{{__('general.save')}}</button>
            <button class="btn btn-error" wire:click="deletePicture"><x-icons.delete_fill_small />{{__('general.delete')}}</button>
        </div>
        <hr class="my-5"/>

        <input type="text" wire:model.live="neptun" class="input input-bordered input-primary mb-3"
               placeholder="{{__('general.neptunCode')}}" @if(!config('presencetracker.allowChangeNeptunCode') && ! Auth::user()->hasRole('superadmin')) disabled @endif/>
        @error('neptun')
        <x-error-alert class="mb-2">{{$message}}</x-error-alert> @enderror
        <input type="text" wire:model.live="name" class="input input-bordered input-primary mb-3"
               placeholder="{{__('general.name')}}"/>
        @error('name')
        <x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror
        <input type="email" wire:model.live="email" class="input input-bordered input-primary mb-3"
               placeholder="{{__('general.email')}}"/>
        @error('email')
        <x-error-alert class="mb-2">{{$message}}</x-error-alert>@enderror
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:click="updateUser">{{__('general.send')}}</button>
    </div class="flex flex-col">
    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
</div>
