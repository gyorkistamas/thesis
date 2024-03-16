<div class="col-span-1 mt-3 @if(!Auth::user()->hasRole('student')) xl:col-span-2 @endif">
    <x-rounded-container>
        <div class="prose">
            <h2>{{__('general.taughtClassesToday')}}</h2>
        </div>
        <div class="divider mt-1"></div>
        <div class="md:max-h-96 overflow-y-auto pr-2">
            @forelse($classes as $class)
                <div class="card bg-base-100 mb-2 p-0">
                    <div class="card-body p-1 ps-3 gap-1 ">
                        <div class="flex flex-row justify-between">
                            <div>
                                <h2 class="card-title">{{$class->Course->Subject->name}} - {{$class->Course->course_id}}
                                    @if($class->isOnGoing())
                                        <div class="badge badge-success gap-2">
                                            {{__('general.onGoing')}}
                                        </div>
                                    @endif
                                </h2>
                                <span class="flex flex-row flex-wrap items-center gap-1">
                                    <x-icons.time_fill_small/>
                                     <span class="mr-2">
                                        {{$class->start_time->isoFormat('HH:mm')}} - {{$class->end_time->isoFormat('HH:mm')}},
                                    </span>
                                    <x-icons.map_fill_small/>
                                    <span>{{$class->Place ? $class->Place->name : '-'}}</span>
                                </span>
                            </div>

                            <div class="flex flex-row items-center justify-end">
                                <a class="btn btn-success btn-sm" href="{{route('teacher-view-class', ['courseClass' => $class->id])}}" wire:navigate><x-icons.view_fill_small /></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="prose">
                    <h3>{{__('general.noClassesToday')}}</h3>
                </div>
            @endforelse
        </div>
    </x-rounded-container>
</div>
