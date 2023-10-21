@extends('layout.default_layout')

@section('title', __('auth.login'))

@section('content')
    <x-rounded-container class="prose mx-auto mt-10">
        <h1 class="mb-0 w-fit mx-auto">{{__('auth.login')}}</h1>
        <hr class="mt-3 mb-5"/>
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
        </form>
    </x-rounded-container>
@endsection
