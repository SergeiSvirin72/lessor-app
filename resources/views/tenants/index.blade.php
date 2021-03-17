@extends('layouts.app')
@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-medium">Арендаторы</h2>
        <div>
            <a href="tenants/export/debtor" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Выгрузить должников</a>
            <a href="contracts/export/active" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Выгрузить активных</a>
            <a href="tenants/create" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Создать</a>
        </div>
    </div>
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Арендатор
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ИНН
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Количество помещений
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Депозит
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Долг
                            </th>
                        </tr>
                        </thead>
                        <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                        @foreach($tenants as $tenant)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium">
                                <a href="/tenants/{{ $tenant['id'] }}?tab=contracts"
                                   class="text-indigo-600 hover:text-indigo-900">{{ $tenant['short_name'] }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                {{ $tenant['inn'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                {{ $tenant['contract_rooms_count'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                {{ $tenant['balance'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                {{ $tenant['debt'] }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
