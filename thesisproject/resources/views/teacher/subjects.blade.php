@extends('layout.default_layout')

@section('title', __('teacher.mySubjectSlashCourses'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:teacher.subject-course-view />
    </x-rounded-container>
@endsection
