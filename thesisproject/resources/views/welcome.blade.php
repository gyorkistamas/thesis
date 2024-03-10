@extends('layout.default_layout')

@section('title', __('general.mainPage'))

@section('content')

    @guest
        <x-rounded-container class="mx-auto prose flex flex-col md:flex-row md:min-w-fit mt-5">
            <div class="flex flex-col md:me-3">
                <img src="{{config('presencetracker.logo')}}" class="w-[200px] mb-2 mx-auto"/>
                <h2 class="mt-0 w-fit mx-auto">{{config('presencetracker.sitename')}}</h2>
            </div>

            <hr class="my-0 md:hidden"/>

            <div class="flex flex-col md:justify-center content-center md:ms-3">
                <h2 class="mt-3">{{__('general.welcomeTitle')}}</h2>
                <p>{{__('general.welcomeMessage')}}</p>
                <a class="btn btn-primary md:w-[200px]" href="/login" wire:navigate>{{__('auth.login')}}</a>
            </div>
        </x-rounded-container>
    @endguest

    @auth

        @if(Auth::user()->hasRole('student') || Auth::user()->hasRole('teacher'))
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-0 md:gap-5">
                @if(Auth::user()->hasRole('student'))
                    <livewire:landing.student-classes :user="Auth::user()"/>
                    <livewire:landing.student-justifications :user="Auth::user()" />
                @endif

                @if(Auth::user()->hasRole('teacher'))
                    <livewire:landing.teacher-classes :user="Auth::user()" />
                    <livewire:landing.teacher-justifications :user="Auth::user()" />
                @endif
            </div>
        @endif

        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin'))
            <x-rounded-container class="mt-3">
                <div class="prose">
                    <h2>{{__('general.statistics')}}</h2>
                </div>

                <div class="divider mt-1"></div>

                <livewire:landing.statistics />
            </x-rounded-container>
        @endif
    @endauth

@endsection
