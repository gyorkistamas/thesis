<div class="col-span-1 mt-3 @if(!Auth::user()->hasRole('student')) xl:col-span-2 @endif">
    <x-rounded-container>
        <div class="prose">
            <h2>{{__('general.justificationToRespondTo')}}</h2>
        </div>
        <div class="divider mt-1"></div>
        <div class="md:max-h-72 overflow-y-auto pr-2">
            @forelse($justifications as $justification)
                <div class="card bg-base-100 mb-2 p-0">
                    <div class="card-body p-1 ps-3 gap-1 ">
                        <div class="flex flex-row justify-between flex-wrap">
                            <div>
                                <h2 class="card-title">{{$justification->User->name}}</h2>
                                <h2 class="card-title">{{$justification->start_date->isoFormat('Y.MM.D')}}
                                    - {{$justification->end_time->isoFormat('Y.MM.D')}}</h2>
                            </div>

                            <div class="flex flex-row items-center justify-end">
                                <!--TODO NAVIGATE TO JUSTIFICATION -->
                                <a class="btn btn-success btn-sm">
                                    <x-icons.view_fill_small/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="prose">
                    <h3>{{__('general.noResult')}}</h3>
                </div>
            @endforelse
        </div>
    </x-rounded-container>
</div>
