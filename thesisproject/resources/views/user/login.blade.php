@extends('layout.default_layout')

@section('title', __('auth.login'))

@section('content')
    <x-rounded-container class="prose mx-auto mt-10">
        <h1 class="mb-0 w-fit mx-auto">{{__('auth.login')}}</h1>
        <hr class="mt-3 mb-5"/>

        @if(session('status'))
            <div class="alert alert-info mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{session('status')}}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="flex flex-col justify-center">
                <input type="text" placeholder="{{__('auth.neptunOrEmail')}}" class="input input-bordered input-primary" name="email" value="{{old('email')}}"/>

                @error('email') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <input type="password" placeholder="{{__('auth.passwordText')}}" class="input input-bordered input-primary mt-3" name="password" />

                @error('password') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror
            </div>

            <div class="flex flex-row flex-wrap justify-between mt-4">
                <div class="form-control">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-success" name="remember" />
                        <span class="label-text ms-2">{{__('auth.rememberMe')}}</span>
                    </label>
                </div>

                <button class="btn btn-primary" type="submit">{{__('auth.login')}}</button>
            </div>
            <div class="flex flex-row justify-between mt-3">
                <a class="link link-primary" href="/forgot-password">{{__('auth.forgotPassword')}}</a>
                <a class="link link-primary" href="{{ route('register') }}">{{__('auth.register')}}</a>
            </div>
        </form>
    </x-rounded-container>
@endsection
