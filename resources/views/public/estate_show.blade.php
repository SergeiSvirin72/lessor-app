@extends('layouts.layout')
@section('content')
    <div class="container mx-auto p-16">
        <div class="px-4 py-5 sm:px-6 mb-4">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                {{ $estate['name'] }}
            </h3>
        </div>

        <div class="grid gap-4 grid-cols-2 mb-4">
            <div class="overflow-hidden col-span-2 lg:col-span-1">
                @if(count($estate['images']))
                    <img src="{{ $images[0]['image_url'] }}" class="shadow rounded-lg">
                @else
                    <img src="{{ asset('storage/no-image.png') }}" class="shadow rounded-lg">
                @endif
            </div>

            @if($estate['longitude'] && $estate['latitude'])
                <div class="overflow-hidden shadow rounded-lg col-span-2 lg:col-span-1">
                    <div class="bg-white overflow-auto">
                        <img src="{{ asset('storage/simple-google-map.png') }}">
                    </div>
                    <div>
                        <dl>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Координаты
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $estate['longitude']  }} - {{  $estate['latitude'] }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            @endif
            <div class="col-span-2">
                <div class="bg-white shadow overflow-hidden rounded-lg border-t border-gray-200">
                    <dl>
                        @if($estate['address'])
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Адрес
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estate['address'] }}</dd>
                            </div>
                        @endif
                        @if($estate['info'])
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Общая информация
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $estate['info'] }}
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <div class="px-4 py-5 sm:px-6 mb-4">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                Помещения в недвижимости {{ $estate['name'] }}
            </h3>
        </div>

        <div class="bg-white shadow rounded-lg px-4 py-5 col-span-2 mb-4">
            <a name="rooms"></a>
            <form action="/estates/{{ $estate['id'] }}" method="POST">
                @csrf
                <div class="grid grid-cols-6 gap-6 align-bottom mb-4">
                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                        <label for="floor_id" class="block text-sm font-medium text-gray-700">Этаж</label>
                        <select name="floor_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('floor_id') border-red-500 @enderror sm:text-sm">
                            @foreach($floors as $floor)
                                <option
                                    value="{{ $floor['id'] }}" {{ request()->floor_id == $floor['id'] ? 'selected' : '' }}>
                                    {{ $floor['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('floor_id')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                        <label for="status" class="block text-sm font-medium text-gray-700">Статус</label>
                        <select name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror sm:text-sm">
                            <option value="all">Все</option>
                            <option value="free" {{ request()->status === 'free' ? 'selected' : '' }}>Свободные</option>
                            <option value="not_free" {{ request()->status === 'not_free' ? 'selected' : '' }}>Арендованные</option>
                        </select>
                        @error('status')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Найти
                    </button>
                </div>
            </form>
        </div>

        <a name="rooms"></a>

        @foreach($rooms as $room)
            <div class="mx-auto bg-white rounded-xl shadow overflow-hidden mb-4">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        @if(count($room['images']))
                            <img src="{{ $room['images'][0]['image_url'] }}" class="h-48 w-full object-cover md:w-48">
                        @else
                            <img src="{{ asset('storage/no-image.png') }}" class="h-48 w-full object-cover md:w-48">
                        @endif
                    </div>
                    <div class="p-8">
                        <a href="/estates/{{ $estate['id'] }}/rooms/{{ $room['id'] }}" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                            {{ $room['name'] }}
                        </a>
                        <p class="mt-2 text-gray-500 ">
                            {{ $room['price'] }} руб./кв.м.
                        </p>
                        <span class="mt-2 px-3 inline-flex font-semibold rounded-full {{ $room['status'] === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $room['status'] === 1 ? 'Свободно' : 'Арендовано' }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
