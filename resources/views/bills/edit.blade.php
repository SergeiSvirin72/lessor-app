@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/tenants/{{ $tenant['id'] }}/bills/{{ $bill['id'] }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 lg:col-span-3">
                            <label for="contract_id" class="block text-sm font-medium text-gray-700">Договор</label>
                            <select id="contract_id" name="contract_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract['id'] }}" {{ $contract['id'] === $bill['contract_id'] ? ' selected' : '' }}>
                                        {{ $contract['number'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="price" class="block text-sm font-medium text-gray-700">Сумма</label>
                            <input type="text" id="price" name="price"
                                   value="{{ old('price') ?: $bill['price'] }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('price') border-red-500 @enderror rounded-md">
                            @error('price')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label for="requisite_id" class="block text-sm font-medium text-gray-700">Реквизиты</label>
                            <select id="requisite_id" name="requisite_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($requisites as $requisite)
                                    <option value="{{ $requisite['id'] }}" {{ $requisite['id'] === $bill['requisite_id'] ? ' selected' : '' }}>
                                        {{ $requisite['name'] }} - {{ $requisite['account'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="comment" class="block text-sm font-medium text-gray-700">
                                Комментарий
                            </label>
                            <div class="mt-1">
                                <textarea id="comment" name="comment" rows="3"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 @error('comment') border-red-500 @enderror rounded-md">{{ old('comment') ?: $bill['comment'] }}</textarea>
                            </div>
                            @error('comment')
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