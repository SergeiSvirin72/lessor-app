@extends('layouts.app')
@section('content')
    <div class="grid gap-4 grid-cols-2">
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
                                Помещение
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $room['name'] }}
                            </dd>
                        </div>
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
        <div class="bg-white shadow overflow-hidden rounded-lg col-span-2">
            <div class="px-4 py-5">
                <h2 class="text-xl font-bold leading-tight text-gray-900">Арендаторы</h2>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Арендатор
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата заезда
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Оплачено до
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Статус
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($room['contractRooms'] as $contractRoom)
                                    @foreach($contractRoom['contract']['tenants'] as $tenant)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $tenant['short_name'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                                {{ $contractRoom['pay_start'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                                {{ $contractRoom['paid_till'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                  Active
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <!-- More rows... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
