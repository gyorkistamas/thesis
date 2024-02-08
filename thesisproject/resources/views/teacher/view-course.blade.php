@extends('layout.default_layout')

@section('title', __('teacher.viewClass'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:teacher.view-class :class="$courseClass"/>
    </x-rounded-container>
@endsection


