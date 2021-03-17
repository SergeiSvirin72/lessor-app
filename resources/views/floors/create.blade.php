@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/estates/{{ $estate['id'] }}/floors" enctype="multipart/form-data">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
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

                        <div class="col-span-6 sm:col-span-6">
                            <label for="img" class="block text-sm font-medium text-gray-700">
                                Изображение
                            </label>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 @error('img') border-red-500 @enderror border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input id="img" type="file" name="img">
                                </div>
                            </div>
                            @error('img')
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
@endsection
