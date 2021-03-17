@extends('layouts.layout')
@section('content')
    <div class="container mx-auto p-16">
        <div class="px-4 py-5 sm:px-6 mb-4">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                {{ $room['name'] }}
            </h3>
        </div>

        <div class="grid gap-4 grid-cols-2 mb-4">
            <div class="col-span-2 lg:col-span-1">
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    @if(count($room['images']))
                        <div class="flex justify-center">
                            <img src="{{ $room['images'][0]['image_url'] }}">
                        </div>
                    @endif
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Площадь
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $room['size'] }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Цена/м2
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $room['price'] }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Статус
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $room['status'] === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $room['status'] === 1 ? 'Свободно' : 'Арендовано' }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <div class="bg-white overflow-auto">
                        <img id="image" class="mx-auto"
                             src="{{ asset($room['floor']['image_url']) }}" alt="{{ $room['floor']['name'] }}">
                    </div>
                    <div>
                        <dl>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    План
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $room['floor']['name'] }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <a name="application"></a>

        <div class="px-4 py-5 sm:px-6 mb-4">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                Оставьте заявку и вам позвонят
            </h3>
        </div>

        @if(session('status') !== null)
            <div class="{{ session('status') ? 'bg-green-100' : 'bg-red-100' }} rounded-lg mb-4 col-span-2">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                            <p class="ml-3 font-medium text-white truncate">
                        <span class="{{ session('status') ? 'text-green-800' : 'text-red-800' }} leading-5 font-semibold">
                            {{ session('status')
                            ? 'Заявка успешно отправлена'
                            : 'Ошибка' }}
                        </span>
                            </p>
                        </div>
                        <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                            <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                                <span class="sr-only">Dismiss</span>
                                <!-- Heroicon name: x -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg px-4 py-5 col-span-2 mb-4">
            <a name="rooms"></a>
            <form action="/estates/{{ $estate['id'] }}/rooms/{{ $room['id'] }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Телефон *</label>
                            <input type="text" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('phone') border-red-500 @enderror rounded-md">
                            @error('phone')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-12 lg:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">ФИО</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('name') border-red-500 @enderror rounded-md">
                            @error('name')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-12 lg:col-span-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Актуально до</label>
                            <input type="date" id="date" name="date"
                                   value="{{ old('date') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('date') border-red-500 @enderror rounded-md">
                            @error('date')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <input id="coordinates" type="hidden" name="coordinates" value="{{ $room['coordinates'] }}">

    <script type="module">
        import RoomCoordinates from '{{ asset('js/canvasCoordinates.js') }}';

        let coordinates_input = document.getElementById('coordinates');
        let coordinates = JSON.parse(coordinates_input.value);
        let image = document.getElementById('image');

        let roomCoordinates = new RoomCoordinates(image, coordinates, false, (elem) => {
            image.parentNode.replaceChild(elem, image);
            elem.classList.add('mx-auto');
        });
    </script>
@endsection