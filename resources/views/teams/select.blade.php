@extends('layouts.layout')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="absolute top-8 right-8">
            <button class="mx-2 text-gray-700 focus:outline-none"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg class="h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

        <div class="shadow max-w-md w-full space-y-8 px-4 py-5 bg-white rounded-lg">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold leading-tight text-gray-900">Выберите компанию</h2>
                <a href="/teams/create"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Создать</a>
            </div>
            <form class="mt-4 space-y-6" action="/teams/select" method="POST">
                @csrf
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="col-span-6 sm:col-span-3">
                        <select id="teams" name="team_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('team_id') border-red-500 @enderror sm:text-sm">
                            @foreach($teams as $team)
                                <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                            @endforeach
                        </select>
                        @error('team_id')
                        <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                </div>

                <button id="button" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Выбрать
                </button>
            </form>
        </div>
    </div>
@endsection
