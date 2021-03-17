@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-2 gap-6">
        <div class="mt-5 md:mt-0 col-span-2 lg:col-span-1">
            <form id="room_create_form" method="POST" action="/estates/{{ $estate['id'] }}/rooms" enctype="multipart/form-data">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <input id="coordinates" type="hidden" name="coordinates">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700">Наименование</label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('name') border-red-500 @enderror rounded-md">
                                @error('name')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="size" class="block text-sm font-medium text-gray-700">Площадь</label>
                                <input type="text" id="size" name="size"
                                       value="{{ old('size') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('size') border-red-500 @enderror rounded-md">
                                @error('size')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="price_square_foot" class="block text-sm font-medium text-gray-700">Цена/м2</label>
                                <input type="text" id="price_square_foot" name="price_square_foot"
                                       value="{{ old('price_square_foot') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('price_square_foot') border-red-500 @enderror rounded-md">
                                @error('price_square_foot')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="floor_id" class="block text-sm font-medium text-gray-700">Этаж</label>
                                <select id="floors" name="floor_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('floor_id') border-red-500 @enderror sm:text-sm">
                                    <option value="">Выберите этаж</option>
                                    @foreach($floors as $floor)
                                        <option value="{{ $floor['id'] }}">{{ $floor['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('floor_id')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="images" class="block text-sm font-medium text-gray-700">
                                    Изображения
                                </label>
                                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 @error('images.*') border-red-500 @enderror border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input id="images" type="file" name="images[]" multiple>
                                    </div>
                                </div>
                                @error('images.*')
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
            <div class="shadow overflow-hidden bg-white sm:rounded-lg">
                <div id="wrapper" class="overflow-auto">

                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="button" id="clear" class="inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Очистить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import RoomCoordinates from '{{ asset('js/canvasCoordinates.js') }}';

        let roomCoordinates;
        let form = document.getElementById('room_create_form');
        let coordinates_input = document.getElementById('coordinates');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (roomCoordinates) {
                coordinates_input.value = JSON.stringify(roomCoordinates.getCoordinates());
            }

            this.submit();
        });

        let floor_dropdown = document.getElementById('floors');
        let floor_image = document.getElementById('wrapper');
        floor_dropdown.addEventListener('change', changeFloor);

        function changeFloor() {
            let value = this.value;
            fetch('/rooms/floor_img', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({ value: value }),
            })
                .then(response => response.text())
                .then(result => {
                    floor_image.innerHTML = result;
                    let image = document.getElementById('image');

                    image.addEventListener("load", function(){
                        roomCoordinates = new RoomCoordinates(image, [], true, (elem) => {
                            elem.classList.add('mx-auto');
                            image.parentNode.replaceChild(elem, image);
                        });

                        document.getElementById('clear')
                            .addEventListener('click', () => roomCoordinates.clearCoordinates());
                    });
                })
        }
    </script>
@endsection
