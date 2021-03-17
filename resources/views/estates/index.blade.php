@extends('layouts.app')
@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-medium">Недвижимость</h2>
        <a href="/estates/create" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Создать
        </a>
    </div>

    <div class="grid gap-4 grid-cols-1 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2">
        @foreach($estates as $estate)
        <div class="flex flex-col justify-between rounded-xl shadow-lg bg-white overflow-hidden">
            <div class="flex-grow flex flex-col justify-center">
            @if(count($estate['images']))
                <img src="{{ $estate['images'][0]['image_url'] }}" class="max-h-80 object-cover">
            @else
                <img src="{{ asset('storage/no-image.png') }}">
            @endif
            </div>
            <div class="p-6 rounded-b-xl">
                <div class="text-base text-indigo-600 font-semibold tracking-wide">
                    <a href="/estates/{{ $estate['id'] }}">{{ $estate['name'] }}</a>
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    {{ $estate['address'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

