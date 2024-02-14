@extends('layout.default_layout')

@section('title', __('student.mySubjectsSlashCourses'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:student.my-subjects />
    </x-rounded-container>
@endsection
