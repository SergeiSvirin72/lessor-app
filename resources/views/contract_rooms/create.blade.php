@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-2 gap-6">
        <div class="mt-5 md:mt-0 col-span-2 lg:col-span-1">
            <form method="POST" action="/tenants/{{ $tenant['id'] }}/contractRooms">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6 grid">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="estate_id" class="block text-sm font-medium text-gray-700">Недвижимость</label>
                                <select id="estates" name="estate_id" data-dependent="floors"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" selected>Выберите недвижимость</option>
                                    @foreach($estates as $estate)
                                        <option value="{{ $estate['id'] }}">{{ $estate['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="floor_id" class="block text-sm font-medium text-gray-700">Этаж</label>
                                <select id="floors" name="floor_id" data-dependent="rooms"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Выберите этаж</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="room_id" class="block text-sm font-medium text-gray-700">Помещение</label>
                                <select id="rooms" name="room_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('room_id') border-red-500 @enderror">
                                    <option value="">Выберите помещение</option>
                                </select>
                                @error('room_id')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6">
                                <label for="price" class="block text-sm font-medium text-gray-700">Сумма</label>
                                <input type="text" id="price_square_foot" name="price_square_foot"
                                       value="{{ old('price_square_foot') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('price_square_foot') border-red-500 @enderror rounded-md">
                                @error('price_square_foot')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="date_start" class="block text-sm font-medium text-gray-700">Дата заезда</label>
                                <input type="date" id="moved_at" name="moved_at"
                                       value="{{ old('moved_at') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('moved_at') border-red-500 @enderror rounded-md">
                                @error('moved_at')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="date_start" class="block text-sm font-medium text-gray-700">Дата начала оплаты</label>
                                <input type="date" id="pay_start" name="pay_start"
                                       value="{{ old('pay_start') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('pay_start') border-red-500 @enderror rounded-md">
                                @error('pay_start')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="contract_id" class="block text-sm font-medium text-gray-700">Договор</label>
                                <select id="contract_id" name="contract_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white @error('contract_id') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($contracts as $contract)
                                        <option value="{{ $contract['id'] }}">{{ $contract['number'] }}</option>
                                    @endforeach
                                </select>
                                @error('contract_id')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-span-2 order-first lg:col-span-1 lg:order-last">
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <div id="floor_image" class="bg-white overflow-auto">

                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import RoomCoordinates from '{{ asset('js/canvasCoordinates.js') }}';

        let dropdowns = document.querySelectorAll('select[data-dependent]');
        for (let dropdown of dropdowns) {
            dropdown.addEventListener('change', fetchDropdown);
        }

        function fetchDropdown() {
            let dependent = this.dataset.dependent;
            let value = this.value;

            fetch('/contractRooms/' + dependent, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({ value: value }),
            })
                .then(response => response.text())
                .then(result => {
                    let dropdown = document.getElementById(dependent);
                    dropdown.innerHTML = result;

                    let event = new Event('change');
                    dropdown.dispatchEvent(event);
                })
        }

        let floor_dropdown = document.getElementById('floors');
        let floor_image = document.getElementById('floor_image');
        floor_dropdown.addEventListener('change', changeFloor);

        function changeFloor() {
            let value = this.value;
            fetch('/contractRooms/floor_img', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({ value: value }),
            })
                .then(response => response.text())
                .then(result => {
                    floor_image.innerHTML = result;
                })
        }

        let room_dropdown = document.getElementById('rooms');
        room_dropdown.addEventListener('change', changeRoom);
        let roomCoordinates;

        function changeRoom() {
            let value = this.value;
            fetch('/contractRooms/room_coordinates', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({ value: value }),
            })
                .then(response => response.json())
                .then(result => {
                    let image = document.getElementById('image');

                    if (result.room && JSON.parse(result.room.coordinates).length) {
                        let coordinates = result.room.coordinates;
                        roomCoordinates = new RoomCoordinates(image, JSON.parse(coordinates), false, (elem) => {
                            image.parentNode.replaceChild(elem, image);
                            elem.classList.add('mx-auto');
                        });
                    } else if (roomCoordinates) {
                        changeFloor.apply(floor_dropdown);
                    }
                })
        }
    </script>
@endsection
