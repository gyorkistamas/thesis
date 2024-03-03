@extends('layout.layout')

@section('content_place')

    <div class="w-full h-screen flex flex-col justify-center items-center">
        <x-rounded-container class="w-fit">
            <div class="prose">
                <h1>{{__('general.currentlyOffline')}}</h1>
            </div>
        </x-rounded-container>
    </div>

@endsection
