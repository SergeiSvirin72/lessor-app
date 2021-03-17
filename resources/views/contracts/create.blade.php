@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/tenants/{{ $tenant['id'] }}/contracts" enctype="multipart/form-data">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="number" class="block text-sm font-medium text-gray-700">Номер</label>
                            <input type="text" id="number" name="number"
                                   value="{{ old('number') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('number') border-red-500 @enderror rounded-md">
                            @error('number')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="tenants" class="block text-sm font-medium text-gray-700">Арендаторы</label>
                            <select id="tenants" name="tenants[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('tenants') border-red-500 @enderror @error('tenants.*') border-red-500 @enderror sm:text-sm">
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant['id'] }}">{{ $tenant['short_name'] }}</option>
                                @endforeach
                            </select>
                            @error('tenants')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            @error('tenants.*')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="date_start" class="block text-sm font-medium text-gray-700">Дата начала</label>
                            <input type="date" id="date_start" name="date_start"
                                   value="{{ old('date_start') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('date_start') border-red-500 @enderror rounded-md">
                            @error('date_start')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="date_start" class="block text-sm font-medium text-gray-700">Дата начала</label>
                            <input type="date" id="date_end" name="date_end"
                                   value="{{ old('date_end') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('date_end') border-red-500 @enderror rounded-md">
                            @error('date_end')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="security_payment" class="block text-sm font-medium text-gray-700">Обеспечительный платеж</label>
                            <input type="text" id="security_payment" name="security_payment"
                                   value="{{ old('security_payment') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('security_payment') border-red-500 @enderror rounded-md">
                            @error('security_payment')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="attachments" class="block text-sm font-medium text-gray-700">
                                Приложения
                            </label>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 @error('attachments.*') border-red-500 @enderror border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input id="attachments" type="file" name="attachments[]" multiple>
                                </div>
                            </div>
                            @error('attachments.*')
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
