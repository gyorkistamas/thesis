<div>
    <div class="w-full prose">
        <h1>{{__('config.siteConfig')}}</h1>
    </div>

    <div class="divider mt-1 mb-1"></div>

    <!-- TODO fix errors -->
    <div class="flex flex-col items-center ">
        <div>
            <label class="input input-bordered input-accent flex items-center gap-2">
                {{__('general.siteName')}}
                <input type="text" class="grow" wire:model="siteName"/>
            </label>
            @error('siteName')
            <x-error-alert class="mt-3">
                {{$message}}
            </x-error-alert>
            @enderror
        </div>

        <div class="form-control w-72 mt-4">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('general.allowRegister')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model="allowRegister" />
                @error('allowRegister')
                <x-error-alert>
                    {{$message}}
                </x-error-alert>
                @enderror
            </label>
        </div>

        <div class="form-control w-72 mt-4">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('config.allowChangeNeptunCode')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model="allowChange" />
                @error('allowChange')
                <x-error-alert>
                    {{$message}}
                </x-error-alert>
                @enderror
            </label>
        </div>

        <div class="form-control w-72 mt-4">
            <label class="cursor-pointer label">
                <span class="label-text">{{__('config.requireNeptunCode')}}</span>
                <input type="checkbox" class="toggle toggle-accent" wire:model="requireNeptun" />
                @error('requireNeptun')
                <x-error-alert>
                    {{$message}}
                </x-error-alert>
                @enderror
            </label>
        </div>

        <label class="form-control w-72 mt-4">
            <div class="label">
                <span class="label-text">{{__('config.sitePicture')}}</span>
            </div>
            <input type="file" class="file-input file-input-bordered file-input-accent w-full max-w-xs" wire:model="logo" />
            @error('logo')
            <x-error-alert>
                {{$message}}
            </x-error-alert>
            @enderror
        </label>

        <button class="btn btn-success mt-4 w-72" wire:click="save"><x-icons.plus_fill_small />{{__('general.save')}}</button>
    </div>
</div>
