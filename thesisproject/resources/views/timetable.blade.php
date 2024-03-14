@extends('layout.default_layout')

@section('title', __('general.timetable'))

@section('content')
    <livewire:landing.timetable :user="Auth::user()" wire:key="timetable"/>
@endsection

@section('calendar-scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/hu.js"></script>
@endsection
