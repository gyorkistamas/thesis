@extends('layout.default_layout')

@section('title', __('general.userSettings'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:settings.list-users wire:key="updateUser"/>
    </x-rounded-container>
@endsection
