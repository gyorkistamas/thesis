@extends('layout.default_layout')

@section('title', __('auth.register'))

@section('content')
    <x-rounded-container class="prose mx-auto mt-10">
        <h1 class="mb-0 w-fit mx-auto">{{__('auth.register')}}</h1>
        <hr class="mt-3 mb-5"/>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex flex-col justify-center">
                <input type="text" name="neptun" placeholder="{{__('general.neptunCode')}}@if(config('presencetracker.requireNeptunCode'))* @endif" class="input input-bordered input-primary" value="{{old('neptun')}}">
                @error('neptun') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <input type="text" name="name" placeholder="{{__('general.name')}}*" class="input input-bordered input-primary mt-3" value="{{old('name')}}">
                @error('name') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <input type="email" name="email" placeholder="{{__('general.email')}}*" class="input input-bordered input-primary mt-3" value="{{old('email')}}">
                @error('email') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <input type="password" name="password" placeholder="{{__('auth.passwordText')}}*" class="input input-bordered input-primary mt-3">
                @error('password') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <input type="password" name="password_confirmation" placeholder="{{__('auth.passwordAgain')}}*" class="input input-bordered input-primary mt-3">
                @error('password_confirmation') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror
                <span class="text-warning text-sm mt-1">*: {{__('general.required')}}</span>

                <button class="btn btn-primary mx-auto mt-5">{{__('auth.register')}}</button>
            </div>


        </form>
    </x-rounded-container>
@endsection
