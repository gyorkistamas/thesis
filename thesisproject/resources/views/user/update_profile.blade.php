@extends('layout.default_layout')

@section('title', __('general.profile'))

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <x-rounded-container>
            <livewire:update-profile-component :user="Auth::user()"/>
        </x-rounded-container>

        <x-rounded-container class="">
            <livewire:update-password :user="Auth::user()"/>
        </x-rounded-container>
    </div>
@endsection
