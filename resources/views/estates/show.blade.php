@extends('layouts.app')
@section('content')
    <div class="grid gap-4 grid-cols-2">
        <div class="col-span-2 lg:col-span-1">
            <div class="bg-white shadow overflow-hidden rounded-lg border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Полное наименование
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $estate['name'] }}
                        </dd>
                    </div>
                    @if($estate['address'])
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Адрес
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estate['address'] }}</dd>
                        </div>
                    @endif
                    @if($estate['longitude'] && $estate['latitude'])
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Долгота
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $estate['longitude'] }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Широта
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $estate['latitude'] }}
                            </dd>
                        </div>
                    @endif
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Статус
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estate['status'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $estate['status'] ? 'Активно' : 'Неактивно' }}
                            </span>
                        </dd>
                    </div>
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

        @if(count($images))
            <div class="overflow-hidden col-span-2 lg:col-span-1">
                <img src="{{ $images[0]['image_url'] }}" class="shadow rounded-lg">
            </div>
        @endif

        <a name="rooms"></a>

        <div class="bg-white shadow rounded-lg px-4 py-5 col-span-2">
            <div class="flex items-center flex-wrap gap-4 justify-between mb-4">
                <h2 class="text-xl font-bold leading-tight text-gray-900">Этажи</h2>
                <a href="/estates/{{ $estate['id'] }}/floors/create"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Создать этаж
                </a>
            </div>
            {{--<select id="floor"--}}
            {{--class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4">--}}
            {{--@foreach($floors as $floor)--}}
            {{--<option value="{{ $floor['id'] }}">{{ $floor['name'] }}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}

            <div x-data="{ isOpen: false }" class="relative inline-block text-left mb-4">
                <div>
                    <a type="button" @click="isOpen = !isOpen"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                            id="options-menu" aria-haspopup="true" aria-expanded="true">
                        <span>Выберите этаж</span>
                        <!-- Heroicon name: chevron-down -->
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-100 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="origin-top-right absolute left-0 mt-2 w-56 rounded-md bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
                     role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1">
                        @foreach($floors as $floor)
                            <div @click="isOpen = !isOpen"
                                 class="flex justify-between text-sm text-gray-700"
                                 role="menuitem">
                                <span data-floor="{{ $floor['id'] }}" class="flex-grow px-4 py-2 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                                    {{ $floor['name'] }}
                                </span>
                                <a href="/estates/{{ $estate['id'] }}/floors/{{ $floor['id'] }}/edit" class="px-4 py-2 hover:bg-gray-100 hover:text-gray-900">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{--<div class="flex flex-col mb-4">--}}
                {{--<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
                    {{--<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">--}}
                        {{--<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">--}}
                            {{--<table class="min-w-full divide-y divide-gray-200">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th scope="col"--}}
                                        {{--class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                        {{--Помещения--}}
                                    {{--</th>--}}
                                    {{--<th scope="col"--}}
                                        {{--class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                        {{--Статус--}}
                                    {{--</th>--}}
                                    {{--<th scope="col"--}}
                                        {{--class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                        {{--Площадь--}}
                                    {{--</th>--}}
                                    {{--<th scope="col"--}}
                                        {{--class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                        {{--Цена--}}
                                    {{--</th>--}}
                                    {{--<th scope="col"--}}
                                        {{--class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                        {{--План--}}
                                    {{--</th>--}}
                                    {{--<th scope="col" class="px-6 py-3 bg-gray-50"></th>--}}
                                    {{--<th scope="col" class="px-6 py-3 bg-gray-50"></th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody id="rooms" class="bg-white divide-y divide-gray-200">--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="flex flex-col mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Помещения</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Статус</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Площадь</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Цена</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell"></th>
                                </tr>
                                </thead>
                                <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <a href="/estates/{{ $estate['id'] }}/rooms/create"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Создать помещение
                </a>
            </div>
        </div>
    </div>

    <script>
        // let dropdown = document.getElementById('floor');
        // dropdown.addEventListener('change', fetchData);
        //
        // if (dropdown.value) {
        //     fetchData();
        // }
        //
        // function fetchData() {
        //     fetch('/floors/' + dropdown.value + '/rooms')
        //         .then(response => response.text())
        //         .then(result => {
        //             console.log(result);
        //             document.getElementById('rooms').innerHTML = result;
        //         });
        // }

        let floors = document.querySelectorAll('span[data-floor]');
        for (let floor of floors) {
            floor.addEventListener('click', changeFloor);
        }

        changeFloor.apply(floors[0]);

        function changeFloor() {
            fetch('/floors/' + this.dataset.floor + '/rooms')
                .then(response => response.text())
                .then(result => {
                    document.getElementById('rooms').innerHTML = result;
                    document.getElementById('options-menu').firstElementChild.innerHTML = this.innerHTML;
                });
        }
    </script>
@endsection
