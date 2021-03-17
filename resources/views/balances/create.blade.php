@extends('layouts.app')
@section('content')
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="/tenants/{{ $tenant['id'] }}/balances">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Сумма</label>
                            <input type="text" id="amount" name="amount"
                                   value="{{ old('amount') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 @error('amount') border-red-500 @enderror rounded-md">
                            @error('amount')
                            <span class="block text-sm font-small text-red-500" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="comment" class="block text-sm font-medium text-gray-700">
                                Комментарий
                            </label>
                            <div class="mt-1">
                                <textarea id="comment" name="comment" rows="3"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 @error('comment') border-red-500 @enderror rounded-md">{{ old('comment') }}</textarea>
                            </div>
                            @error('comment')
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
