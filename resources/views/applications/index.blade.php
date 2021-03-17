@extends('layouts.app')
@section('content')
    <div class="mb-4">
        <h2 class="text-2xl font-medium">Заявки</h2>
    </div>
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden bg-white border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Недвижимость
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Помещение
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Телефон
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Имя
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Актуально до
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                            <tr class="hover:bg-gray-100 hover:text-gray-900">
                                <td class="px-6 py-4 text-sm text-gray-900 w-px">
                                    {{ $application['room']['floor']['estate']['name'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 w-px">
                                    {{ $application['room']['name'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 w-px">
                                    {{ $application['phone'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 w-px">
                                    {{ $application['name'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 w-px">
                                    {{ $application['date'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap w-px">
                                    <form action="/applications/{{ $application['id'] }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Обработать
                                        </button>
                                    </form>
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
