@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/estates" enctype="multipart/form-data">
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
                            <label for="address" class="block text-sm font-medium text-gray-700">Адрес</label>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('address') border-red-500 @enderror rounded-md">
                            @error('address')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="longitude" class="block text-sm font-medium text-gray-700">Долгота</label>
                            <input type="text" id="longitude" name="longitude"
                                   value="{{ old('longitude') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('longitude') border-red-500 @enderror rounded-md">
                            @error('longitude')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="latitude" class="block text-sm font-medium text-gray-700">Широта</label>
                            <input type="text" id="latitude" name="latitude"
                                   value="{{ old('latitude') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('latitude') border-red-500 @enderror rounded-md">
                            @error('latitude')
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
                            <label for="mask" class="block text-sm font-medium text-gray-700">Маска договора</label>
                            <input type="text" id="mask" name="mask"
                                   value="{{ old('mask') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('mask') border-red-500 @enderror rounded-md">
                            @error('mask')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="info" class="block text-sm font-medium text-gray-700">
                                Общая информация
                            </label>
                            <div class="mt-1">
                                <textarea id="info" name="info" rows="3"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 @error('info') border-red-500 @enderror rounded-md">{{ old('info') }}</textarea>
                            </div>
                            @error('info')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex items-start">
                            <div class="text-sm">
                                <label for="status" class="font-medium text-gray-700">Статус</label>
                            </div>
                            <div class="ml-3 flex items-center h-5">
                                <input id="status" name="status" type="checkbox"
                                       @if(old('status')) checked @endif
                                       value="1"
                                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border border-gray-300 @error('status') border-red-500 @enderror rounded">
                                @error('status')
                                <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
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
@endsection