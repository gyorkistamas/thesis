@extends('layout.default_layout')

@section('title', __('general.mainPage'))

@section('content')

    <x-rounded-container class="mx-auto prose flex flex-col md:flex-row md:min-w-fit mt-5">
        <div class="flex flex-col md:me-3">
            <img src="def_logo.png" class="w-[200px] mb-2 mx-auto"/>
            <h2 class="mt-0 w-fit mx-auto">{{config('presencetracker.sitename')}}</h2>
        </div>

        <hr class="my-0 md:hidden"/>

        <div class="flex flex-col md:justify-center content-center md:ms-3">
            <h2 class="mt-3">{{__('general.welcomeTitle')}}</h2>
            <p>{{__('general.welcomeMessage')}}</p>
            <a class="btn btn-primary md:w-[200px]" href="/login">{{__('auth.login')}}</a>
        </div>
    </x-rounded-container>
@endsection
