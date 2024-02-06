@extends('layout.layout')

@section('content_place')

    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="navbar bg-base-300 m-2 w-auto rounded-2xl">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2"><a href="/" wire:navigate>{{config('presencetracker.sitename')}}</a></div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <li><a href="{{route('home')}}" wire:navigate>{{__('general.homePage')}}</a></li>
                        @if(Auth::user() && Auth::user()->hasRole('teacher'))
                            <li><a href="{{route('teacher-subjects')}}" wire:navigate>{{__('teacher.mySubjectSlashCourses')}}</a></li>
                        @endif
                        @if(Auth::user() && Auth::user()->hasRole(['admin', 'superadmin']))
                            <li tabindex="0">
                                @if(Auth::user()->hasRole('superadmin'))
                                    <details>
                                        <summary>{{__('general.siteAdministration')}}</summary>
                                        <ul class="p-2">
                                            <li><a href="{{route('user-settings')}}"
                                                   wire:navigate>{{__('general.userSettings')}}</a></li>
                                            <li><a href="{{route('administration')}}" wire:navigate>{{__('general.administration')}}</a></li>
                                        </ul>
                                    </details>
                                @else
                                    <a href="{{route('administration')}}" wire:navigate>{{__('general.administration')}}</a>
                                @endif
                            </li>
                        @endif
                    </ul>

                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn">
                            <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 512 512">
                                <path
                                    d="M363,176,246,464h47.24l24.49-58h90.54l24.49,58H480ZM336.31,362,363,279.85,389.69,362Z"></path>
                                <path
                                    d="M272,320c-.25-.19-20.59-15.77-45.42-42.67,39.58-53.64,62-114.61,71.15-143.33H352V90H214V48H170V90H32v44H251.25c-9.52,26.95-27.05,69.5-53.79,108.36-32.68-43.44-47.14-75.88-47.33-76.22L143,152l-38,22,6.87,13.86c.89,1.56,17.19,37.9,54.71,86.57.92,1.21,1.85,2.39,2.78,3.57-49.72,56.86-89.15,79.09-89.66,79.47L64,368l23,36,19.3-11.47c2.2-1.67,41.33-24,92-80.78,24.52,26.28,43.22,40.83,44.3,41.67L255,362Z"></path>
                            </svg>
                            <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z"
                                      class="fill-transparent"></path>
                                <path
                                    d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.632Z"
                                    class="fill-slate-400 dark:fill-slate-500"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17 3a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z"
                                      class="fill-slate-400 dark:fill-slate-500"></path>
                            </svg>
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li class="flex flex-row justify-center">
                                <livewire:languageswitcher/>
                            </li>
                            <li class="flex flex-row justify-center">
                                <livewire:themeswitcher/>
                            <li>
                        </ul>
                    </div>

                    @auth
                        <div class="dropdown dropdown-end flex-row align-top">
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img src="{{Auth::user()->get_pic()}}"/>
                                </div>
                            </label>
                            <ul tabindex="0"
                                class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                                <li><a href="{{route('update-profile')}}" wire:navigate>{{__('general.profile')}}</a>
                                </li>
                                <li>
                                    <form method="POST" action="/logout">@csrf
                                        <button>{{__('general.logout')}}</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown dropdown-end align-top">
                            <a tabindex="0" class="btn btn-ghost btn-circle avatar" href="/login" wire:navigate>
                                <div class="w-10 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="stroke-neutral">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        <div class="drawer-side z-[9999]">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200">
                <!-- Sidebar content here -->
                <!--TODO Add sidebar items here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>

    <div class="mx-3">
        @yield('content')
    </div>
@endsection
