<div>
    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <div class="prose mb-3 flex flex-col flex-wrap justify-center min-w-full max-w-full md:flex-row md:justify-between">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.places')}}</h1>
        <button class="btn btn-success w-fit mt-2 md:mt-0 mx-auto md:mx-0" onclick="newPlaceModal.showModal()">
            <x-icons.plus_fill_small/>{{__('general.createNewPlace')}}</button>
    </div>
    <div>
        @if($places->count() != 0)
            <div>
                <table class="hidden md:table">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>{{__('general.name')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- rows -->
                    @foreach($places as $place)
                       <livewire:administration.place-item-list :place="$place" :key="$place->id" />
                    @endforeach
                    </tbody>
                    <!-- foot -->
                    <tfoot>
                    <tr>
                        <th>{{__('general.name')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        <div id="placeCards" class="md:hidden"></div>
            {{$places->links()}}
        @else
            <div class="prose mx-auto mt-2">
                <h1>{{__('general.searchNotFound')}}</h1>
            </div>
        @endif
    </div>

    <dialog id="newPlaceModal" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createNewPlace')}}</h3>
            <div class="modal-action flex flex-col">
                <form class="">
                    <div class="flex flex-col items-center">
                        <div>
                            <label for="name" class="label w-min">{{__('general.name')}}: </label>
                            <input type="text" name="name" class="input input-bordered input-accent w-full max-w-xs" wire:model="newName"/>
                        </div>
                        @error('newName')
                        <x-error-alert class="mt-3 mx-5">{{$message}}</x-error-alert>
                        @enderror
                    </div>
                </form>
                <div class="flex flex-row gap-3 mt-5 justify-end">
                    <button class="btn btn-success" wire:click="newPlace">{{__('general.createNewPlace')}}</button>
                    <form method="dialog">
                        <button class="btn">{{__('general.close')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </dialog>
</div>
