<div>
    <div class="fixed inset-0 flex items-center justify-center" style="pointer-events: none;">
        <span class="loading loading-dots loading-lg" wire:loading></span>
    </div>
    <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
        <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.subjects')}}</h1>
        <label for="newSubjectModel" class="btn btn-success w-fit"><x-icons.plus_fill_small/>{{__('general.createSubject')}}</label>
    </div>
    
    <input type="checkbox" id="newSubjectModel" class="modal-toggle" wire:ignore.self/>
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{__('general.createSubject')}}</h3>
            <div class="modal-action flex flex-col">
                <form class="">

                    <div>
                        <label for="id" class="label">{{__('general.subjectCode')}}</label>
                        <input type="text" name="id" class="input input-bordered input-accent w-full max-w-xs"/>
                    </div>

                    <div>
                        <label for="name" class="label mt-2">{{__('general.subjectName')}}</label>
                        <input type="text" name="name" class="input input-bordered input-accent w-full max-w-xs"/>
                    </div>

                    <div>
                        <label for="description" class="label mt-2">{{__('general.subjectDescription')}}</label>
                        <input type="text" name="description" class="input input-bordered input-accent w-full max-w-xs"/>
                    </div>
                    <div>
                        <label for="credit" class="label mt-2">{{__('general.subjectCredit')}}</label>
                        <input type="number" name="credit" class="input input-bordered input-accent w-full max-w-xs"/>
                    </div>
                    <div id="ManagerDropdown">
                        <label for="manager" class="label mt-2">{{__('general.subjectManager')}}</label>
                        <select class="js-example-basic-single" name="manager" id="manager">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                </form>
                <div class="flex flex-row gap-3 mt-5 justify-end">
                    <button class="btn btn-success" wire:click="newSemester">{{__('general.createSubject')}}</button>
                        <label class="btn" for="newSubjectModel">{{__('general.close')}}</label>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#manager').select2({
                $dropdownParent: $('#ManagerDropdown')
            });
        });
    </script>
</div>
