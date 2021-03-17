@extends('layouts.layout')
@section('content')
    <div class="container mx-auto p-16">
        <div class="px-4 py-5 sm:px-6 mb-4">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                Недвижимость в компании {{ $team->name }}
            </h3>
        </div>

        @foreach($estates as $estate)
            <div class="mx-auto bg-white rounded-xl shadow overflow-hidden mb-4">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        @if(count($estate['images']))
                            <img src="{{ $estate['images'][0]['image_url'] }}" class="h-48 w-full object-cover md:w-48">
                        @else
                            <img src="{{ asset('storage/no-image.png') }}" class="h-48 w-full object-cover md:w-48">
                        @endif
                    </div>
                    <div class="p-8">
                        <a href="/estates/{{ $estate['id'] }}" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                            {{ $estate['name'] }}
                        </a>
                        <p class="mt-2 text-gray-500">
                            {{ $estate['address'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection