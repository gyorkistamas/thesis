@extends('layout.default_layout')

@section('title', __('general.administration'))

@section('content')
    <x-rounded-container class="mt-5">
        <div role="tablist" class="tabs tabs-lifted">

            <input type="radio" name="administration" role="tab" class="tab" aria-label="{{__('general.semesters')}}" checked />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                <livewire:administration.semester-list />
            </div>

            <input type="radio" name="administration" role="tab" class="tab" aria-label="{{__('general.subjects')}}" />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                <div class="prose mb-3 flex flex-row flex-wrap justify-between min-w-full max-w-full md:flex-row">
                    <h1 class="mb-0 mx-auto md:mx-0 md:ms-1">{{__('general.subjects')}}</h1>
                </div>
            </div>

        </div>
    </x-rounded-container>
@endsection
