@extends('layouts.app')
@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Компания
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $team['name'] }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Поддомен
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $team['alias'] }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Ссылка для приглашения
                    </dt>
{{--                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">--}}
{{--                        {{ isset($team['data']['invite'])--}}
{{--                            ? env('APP_URL').'/teams/join/'.$team['data']['invite']['data']['token']--}}
{{--                            : 'Нет ссылки' }}--}}
{{--                    </dd>--}}
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if (session('invite_url')) {{ session('invite_url') }} @else {{ 'Нет ссылки' }} @endif
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500"></dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <form action="/invite" method="POST">
                            @csrf
                            <button id="button" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Получить ссылку приглашения
                            </button>
                        </form>
                    </dd>
                </div>

            </dl>
        </div>
    </div>
@endsection
