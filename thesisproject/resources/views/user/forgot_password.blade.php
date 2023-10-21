@extends('layout.default_layout')

@section('title', __('auth.forgotPassword'))

@section('content')
    <x-rounded-container class="prose mx-auto mt-10">
        <h1 class="mb-0 w-fit mx-auto">{{__('auth.forgotPassword')}}</h1>
        <hr class="mt-3 mb-5"/>

        @if(session('status'))
            <div class="alert alert-info mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{session('status')}}
            </div>
        @endif

        <form method="POST" action="/forgot-password">
            @csrf
            <div class="flex flex-col justify-center">
                <input type="email" name="email" placeholder="{{__('general.email')}}" class="input input-bordered input-primary" value="{{old('email')}}">
                @error('email') <x-error-alert class="p-2 mt-2">{{$message}}</x-error-alert> @enderror

                <button class="btn btn-primary mx-auto mt-5">{{__('general.send')}}</button>
            </div>


        </form>
    </x-rounded-container>
@endsection
