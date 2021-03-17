@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/tenants">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="inn" class="block text-sm font-medium text-gray-700">ИНН</label>
                            <input type="text" id="inn" name="inn"
                                   value="{{ old('inn') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('inn') border-red-500 @enderror rounded-md">
                            @error('inn')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <h2 class="text-xl font-bold leading-tight text-gray-900 py-4">Документы</h2>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="document_full_name" class="block text-sm font-medium text-gray-700">
                                Полное наименование
                            </label>
                            <div class="mt-1">
                                <textarea id="document_full_name" name="document_full_name" rows="3"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 @error('document_full_name') border-red-500 @enderror rounded-md">{{ old('document_full_name') }}</textarea>
                            </div>
                            @error('document_full_name')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-12 lg:col-span-6">
                            <label for="document_short_name" class="block text-sm font-medium text-gray-700">Краткое наименование</label>
                            <input type="text" id="document_short_name" name="document_short_name"
                                   value="{{ old('document_short_name') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('document_short_name') border-red-500 @enderror rounded-md">
                            @error('document_short_name')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <h2 class="text-xl font-bold leading-tight text-gray-900 py-4">Контактное лицо</h2>
                    <div class="grid grid-cols-12 gap-6">
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
                            <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
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
                            <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
                            <input type="text" id="email" name="email"
                                   value="{{ old('email') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('email') border-red-500 @enderror rounded-md">
                            @error('email')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-white sm:px-6">
                    <button id="button" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Получить
                    </button>
                </div>

                <div id="info"></div>
            </div>
        </form>
    </div>

    <script>
        let button = document.getElementById('button');
        let inn = document.getElementById('inn');
        button.addEventListener('click', () => fetchData(inn.value));

        function fetchData(inn = "") {
            fetch('/tenants/get/' + inn)
                .then(response => response.text())
                .then(result => {
                    console.log(result);
                    document.getElementById('info').innerHTML = result;
                });
        }
    </script>
@endsection
