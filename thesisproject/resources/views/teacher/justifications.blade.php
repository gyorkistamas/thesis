@extends('layout.default_layout')

@section('title', __('teacher.justifications'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:teacher.justifications.justification-list />
    </x-rounded-container>
@endsection
