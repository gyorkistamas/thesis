@extends('layout.default_layout')

@section('title', __('student.myJustifications'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:student.justifications.student-justification-page />
    </x-rounded-container>
@endsection
