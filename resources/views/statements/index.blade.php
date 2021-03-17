@extends('layouts.app')
@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-medium">Выписки по счету</h2>
        <a href="statements/create" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Импортировать</a>
    </div>
    @if(session('status') !== null)
        <div class="{{ session('status') ? 'bg-green-100' : 'bg-red-100' }} rounded-lg mb-4 col-span-2">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <p class="ml-3 font-medium text-white truncate">
                        <span class="{{ session('status') ? 'text-green-800' : 'text-red-800' }} leading-5 font-semibold">
                            {{ session('status')
                            ? 'Файл успешно загружен'
                            : 'Ошибка' }}
                        </span>
                        </p>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden bg-white border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Дата
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Дебет
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Кредит
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Сумма
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Арендатор
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($statements as $statement)
                            <tr onclick="document.location = '/statements/{{ $statement['id'] }}';" class="cursor-pointer hover:bg-gray-100 hover:text-gray-900">
                                <td class="px-6 py-4 text-xs text-gray-500 whitespace-no-wrap w-px">
                                    {{ $statement['date'] }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-900 w-px">
                                    {{ $statement['debet_account'] }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-900 w-px">
                                    {{ $statement['credit_account'] }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-900 w-px">
                                    {{ $statement['amount'] }}
                                </td>
                                <form action="/statements/{{ $statement['id'] }}" method="post">
                                    @csrf
                                    @method('put')
                                    <td onclick="event.stopPropagation()" class="px-6 py-4 whitespace-nowrap">
                                        <select name="tenant_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach($tenants as $tenant)
                                                <option value="{{ $tenant['id'] }}">{{ $tenant['short_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td onclick="event.stopPropagation()" class="px-6 py-4 whitespace-nowrap w-px">
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Оплатить
                                        </button>
                                    </td>
                                </form>
                                <form action="/statements/{{ $statement['id'] }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <td onclick="event.stopPropagation()" class="px-6 py-4 whitespace-nowrap w-px">
                                        <button class="text-xs text-indigo-600 hover:text-indigo-900">
                                            Скрыть
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end">
                        {{ $statements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
