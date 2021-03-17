@extends('layouts.layout')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="shadow max-w-md w-full space-y-8 px-4 py-5 bg-white rounded-lg">
            <h2 class="text-xl font-bold leading-tight text-gray-900">Новая компания</h2>
            <form class="mt-8 space-y-6" action="/teams" method="POST">
                @csrf
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="mb-8">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('name') border-red-500 @enderror rounded-md">
                        @error('name')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alias" class="block text-sm font-medium text-gray-700">Поддомен</label>
                        <input type="text" id="alias" name="alias"
                               value="{{ old('alias') }}"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('alias') border-red-500 @enderror rounded-md">
                        @error('alias')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <h3 class="text-lg font-bold leading-tight text-gray-900">Документы</h3>
                    <div class="mb-4">
                        <label for="document_full_name" class="block text-sm font-medium text-gray-700">Полное наименование</label>
                        <textarea id="document_full_name" name="document_full_name" rows="3"
                                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 @error('document_full_name') border-red-500 @enderror rounded-md">{{ old('document_full_name') }}</textarea>
                        @error('document_full_name')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
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

                    <div class="mb-4">
                        <label for="document_signature" class="block text-sm font-medium text-gray-700">Подписывающее лицо</label>
                        <input type="text" id="document_signature" name="document_signature"
                               value="{{ old('document_signature') }}"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('document_signature') border-red-500 @enderror rounded-md">
                        @error('document_signature')
                        <span class="block text-sm font-small text-red-500" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <button id="button" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
