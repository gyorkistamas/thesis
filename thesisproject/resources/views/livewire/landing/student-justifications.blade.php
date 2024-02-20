<div class="col-span-1 mt-3 @if(!Auth::user()->hasRole('teacher')) xl:col-span-2 @endif">
    <x-rounded-container >
        <div class="prose">
            <h2>{{__('general.myPendingJustifications')}}</h2>
        </div>
        <div class="divider mt-1"></div>
        <div class="md:max-h-96 overflow-y-auto pr-2">
            @forelse($justifications as $justification)
                <div class="card bg-base-100 mb-2 p-0">
                    <div class="card-body p-1 ps-3 gap-1 ">
                        <h2 class="card-title">{{$justification->start_date->isoFormat('Y.MM.D')}} - {{$justification->end_time->isoFormat('Y.MM.D')}}</h2>
                        <div class="flex flex-col gap-1">
                            @foreach($justification->GetTeachers()->get() as $teacher)
                                <div class="w-full flex flex-row justify-between flex-wrap pr-1">
                                    <span>{{$teacher->name}}</span>
                                    @switch($teacher->pivot->status)
                                        @case('accepted')
                                            <div class="badge badge-success">
                                                {{__('student.accepted')}}
                                            </div>
                                            @break

                                        @case('denied')
                                            <div class="badge badge-error">
                                                {{__('student.rejected')}} ({{$teacher->pivot->comment}})
                                            </div>
                                            @break

                                        @case('na')
                                            <div class="badge badge-info">
                                                {{__('student.noResponse')}}
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            @endforeach
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
