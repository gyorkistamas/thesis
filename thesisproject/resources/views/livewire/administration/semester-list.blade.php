<div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.semesters')}}</h1>
        <button class="btn btn-success w-fit" onclick="newSemesterModal.showModal()">
            <x-icons.plus_fill_small/>{{__('general.createNewSemester')}}</button>
    </div>
    <div>
        @if($terms->count() != 0)
            <div>
                <table class="table">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>{{__('general.name')}}</th>
                        <th>{{__('general.startDate')}}</th>
                        <th>{{__('general.endDate')}}</th>
                        <th>{{__('general.active')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- rows -->

                    </tbody>
                    <!-- foot -->
                    <tfoot>
                    <tr>
                        <th>{{__('general.name')}}</th>
                        <th>{{__('general.startDate')}}</th>
                        <th>{{__('general.endDate')}}</th>
                        <th>{{__('general.active')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
            {{$terms->links()}}
        @else
            <div class="prose mx-auto mt-2">
                <h1>{{__('general.searchNotFound')}}</h1>
            </div>
        @endif
    </div>

    <dialog id="newSemesterModal" class="modal modal-bottom sm:modal-middle" wire:ignore.self>
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createNewSemester')}}</h3>
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

                    <div class="flex flex-row justify-between">
                        <div class="w-max">
                            <label for="start" class="label mt-3">{{__('general.startDate')}}: </label>
                            <input type="date" name="start" class="input input-bordered input-accent w-full max-w-xs" wire:model="newStart"/>
                            @error('newStart')
                            <x-error-alert class="mt-3">{{$message}}</x-error-alert>
                            @enderror
                        </div>

                        <div class="w-max">
                            <label for="end" class="label mt-3">{{__('general.endDate')}}: </label>
                            <input type="date" name="end" class="input input-bordered input-accent w-full max-w-xs" wire:model="newEnd"/>
                            @error('newEnd')
                            <x-error-alert class="mt-3">{{$message}}</x-error-alert>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="flex flex-row gap-3 mt-5 justify-end">
                    <button class="btn btn-success" wire:click="newSemester">{{__('general.createNewSemester')}}</button>
                    <form method="dialog">
                        <button class="btn" wire:click="">{{__('general.close')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </dialog>
</div>
