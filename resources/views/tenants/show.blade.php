@extends('layouts.app')
@section('content')
    <div class="grid gap-4 grid-cols-2">
        <div class="col-span-2 lg:row-span-2 lg:col-span-1">
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $tenant['full_name'] }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{ $tenant['short_name'] }}
                        </p>
                    </div>
                    <a href="/tenants/{{ $tenant['id'] }}/edit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Изменить</a>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Адрес
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $tenant['address'] }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Коды статистики
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                ОКАТО: {{ $tenant['okato'] }} <br>
                                ОКТМО: {{ $tenant['oktmo'] }} <br>
                                ОКПО: {{ $tenant['okpo'] }} <br>
                                ОКОГУ: {{ $tenant['okogu'] }} <br>
                                ОКФС: {{ $tenant['okfs'] }} <br>
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                ОГРН
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $tenant['ogrn'] }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                ИНН / КПП
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $tenant['inn'] }} / {{ $tenant['kpp'] }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Статус
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tenant['status'] === "ACTIVE" ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $tenant['status'] }}
                        </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg col-span-2 lg:col-span-1 lg:row-span-1">
            <div class="bg-white px-5 py-6 sm:p-8">
                <h2 class="text-xl font-bold leading-tight text-gray-900 mb-8">Финансы</h2>
                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: chart-bar -->
                    <svg class="flex-shrink-0 h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            Депозит
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $tenant['balance'] }} &#8381;
                        </p>
                    </div>
                </div>

                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: cursor-click -->
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            Обеспечительный платеж
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $tenant['security_payment'] }} &#8381;
                        </p>
                    </div>
                </div>

                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: shield-check -->
                    <svg class="flex-shrink-0 h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            Долг
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $tenant['debt'] }} &#8381;
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden rounded-lg col-span-2 lg:col-span-1 lg:row-span-1">
            <div class="bg-white px-5 py-6 sm:p-8">
                <h2 class="text-xl font-bold leading-tight text-gray-900 mb-8">Контактное лицо</h2>
                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: chart-bar -->
                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            ФИО
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $contact['name'] }}
                        </p>
                    </div>
                </div>

                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: cursor-click -->
                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            Телефон
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $contact['phone'] }}
                        </p>
                    </div>
                </div>

                <div class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                    <!-- Heroicon name: shield-check -->
                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                            Электронная почта
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $contact['email'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <a name="tab"></a>

        @if(session('status') !== null)
            <div class="{{ session('status') ? 'bg-green-500' : 'bg-red-500' }} rounded-lg mb-4 col-span-2">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                            <p class="ml-3 font-medium text-white truncate">
                        <span>
                            {{ session('status')
                            ? 'Счет успешно оплачен'
                            : 'Недостаточно средств' }}
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

        <div class="bg-white shadow rounded-lg col-span-2">
            <div class="flex flex-wrap p-4 gap-4">
                <div class="flex">
                    <a href="/tenants/{{ $tenant['id'] }}?tab=contracts#tab" data-tab="contracts"
                       class="inline-flex px-4 py-2 items-center border border-gray-300 rounded-l-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Договоры</a>
                    <a href="/tenants/{{ $tenant['id'] }}/contracts/create"
                       class="inline-flex px-2 py-2 items-center border border-gray-300 rounded-r-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -ml-1">+</a>
                </div>
                <div class="flex">
                    <a href="/tenants/{{ $tenant['id'] }}?tab=estates#tab" data-tab="estates"
                       class="inline-flex px-4 py-2 items-center border border-gray-300 rounded-l-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Помещения</a>
                    <a href="/tenants/{{ $tenant['id'] }}/contractRooms/create"
                       class="inline-flex px-2 py-2 items-center border border-gray-300 rounded-r-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -ml-1">+</a>
                </div>
                <div class="flex">
                    <a href="/tenants/{{ $tenant['id'] }}?tab=bills#tab" data-tab="bills"
                       class="inline-flex px-4 py-2 items-center border border-gray-300 rounded-l-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Счета</a>
                    <a href="/tenants/{{ $tenant['id'] }}/bills/create"
                       class="inline-flex px-2 py-2 items-center border border-gray-300 rounded-r-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -ml-1">+</a>
                </div>
                <div class="flex">
                    <a href="/tenants/{{ $tenant['id'] }}?tab=balances#tab" data-tab="balances"
                       class="inline-flex px-4 py-2 items-center border border-gray-300 rounded-l-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Баланс</a>
                    <a href="/tenants/{{ $tenant['id'] }}/balances/create"
                       class="inline-flex px-2 py-2 items-center border border-gray-300 rounded-r-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -ml-1">+</a>
                </div>
            </div>
            <div class="flex flex-col">
                @if(request()->query('tab') === 'contracts')
                <div data-content="contracts" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Номер
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Срок с
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Срок по
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Обеспечительный платеж
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                                @foreach($contracts as $contract)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium">
                                        <a href="/tenants/{{ $tenant['id'] }}/contracts/{{ $contract['id'] }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            {{ $contract['number'] }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                        {{ $contract['date_start'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                        {{ $contract['date_end'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                        {{ $contract['security_payment'] }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @elseif(request()->query('tab') === 'bills')
                <div data-content="acts" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Номер
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Сумма
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Статус
                                    </th>
                                    {{--<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Изменить</th>--}}
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Оплатить
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Акт
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                                @foreach($bills as $bill)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="/tenants/{{ $tenant['id'] }}/bills/{{ $bill['id'] }}"
                                               class="text-indigo-600 hover:text-indigo-900">
                                                {{ $bill['number'] }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $bill['amount'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex whitespace-no-wrap text-xs leading-5 font-semibold rounded-full {{ $bill['status'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $bill['status'] ? 'Оплачен' : 'Не оплачен' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                            @if(!$bill['status'])
                                                <form action="/tenants/{{ $tenant['id'] }}/bills/{{ $bill['id'] }}/pay" method="post">
                                                    @csrf
                                                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Оплатить
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                            @if(!$bill['act'])
                                                <form action="/tenants/{{ $tenant['id'] }}/bills/{{ $bill['id'] }}/act" method="post">
                                                    @csrf
                                                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Создать
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ $bill['act']['document_url'] }}" class="text-indigo-600 hover:text-indigo-900">Загрузить</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-end">
                                {{ $bills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(request()->query('tab') === 'estates')
                <div data-content="estates" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Недвижимость
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Помещение
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Сумма
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата заезда
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Оплачено до
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                                @foreach($contractRooms as $contractRoom)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                            {{ $contractRoom['room']['floor']['estate']['name'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                            {{ $contractRoom['room']['name'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                            {{ $contractRoom['price_square_foot'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                            {{ $contractRoom['pay_start'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                            {{ $contractRoom['paid_till'] }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @elseif(request()->query('tab') === 'balances')
                <div data-content="balances" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <form method="POST" action="/tenants/{{ $tenant['id'] }}/export/revise">
                                @csrf
                                <div class="px-4 py-2 bg-white sm:p-6">
                                    <div class="grid grid-cols-12 gap-6 items-end">
                                        <div class="col-span-12 sm:col-span-4">
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

                                        <div class="col-span-12 sm:col-span-4">
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

                                        <div class="col-span-12 sm:col-span-4">
                                            <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Создать акт проверки
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Тип
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Сумма
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Статус
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Комментарий
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="rooms" class="bg-white divide-y divide-gray-200">
                                @foreach($balances as $balance)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $balance['type'] === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $balance['type'] === 1 ? 'Дебит' : 'Кредит' }}
                                        </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                            {{ $balance['amount'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                        <span class="px-2 inline-flex whitespace-no-wrap text-xs leading-5 font-semibold rounded-full {{ $balance['status'] === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $balance['status'] === 1 ? 'Оплачен' : 'Не оплачен' }}
                                        </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500">
                                            {{ $balance['created_at'] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $balance['comment'] }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-end">
                                {{ $balances->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
