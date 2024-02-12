@extends('layout.default_layout')

@section('title', __('student.loginToClass'))

@section('content')
    <x-rounded-container class="mt-5">
        <livewire:student.class-login.login-to-class :class-id="$classId"/>
    </x-rounded-container>
@endsection
