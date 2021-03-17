@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/tenants/{{ $tenant['id'] }}">
            @csrf
            @method('put')
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <h2 class="text-xl font-bold leading-tight text-gray-900 py-4">Контактное лицо</h2>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">ФИО</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') ?: $contact['name'] }}"
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
                                   value="{{ old('phone') ?: $contact['phone'] }}"
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
                                   value="{{ old('email') ?: $contact['email'] }}"
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
                    <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
