@extends('layout.default_layout')

@section('title', __('general.404NotFound'))
@section('styles')
<style>


</style>
@endsection

@section('content')
    <x-rounded-container>
        <div id="notfound" class="w-full min-w-full">

            <div class="notfound w-full min-w-full">
                <div class="notfound-404">
                    <h1>404</h1>
                </div>
                <h2>{{__('general.pageNotFound')}}!</h2>
                <a class="btn btn-info" wire:navigate href="{{route('home')}}">{{__('general.mainPage')}}</a>
            </div>
        </div>
    </x-rounded-container>
@endsection
