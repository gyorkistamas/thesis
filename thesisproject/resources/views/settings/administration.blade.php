@extends('layout.default_layout')

@section('title', __('general.administration'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:administration.administration wire:key="administration"/>
    </x-rounded-container>
@endsection
