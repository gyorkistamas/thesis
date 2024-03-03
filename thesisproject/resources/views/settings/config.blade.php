@extends('layout.default_layout')

@section('title', __('config.siteConfig'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:settings.config />
    </x-rounded-container>
@endsection
