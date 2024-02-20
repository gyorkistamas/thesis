@extends('layout.default_layout')

@section('title', __('general.timetable'))

@section('content')
    <livewire:landing.timetable :user="Auth::user()" wire:key="timetable"/>
@endsection
