@extends('layouts.layout')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <svg class="mx-auto h-12 w-auto" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32.6883 0.335913C32.3407 -0.0248702 31.7929 -0.104067 31.3596 0.142322L19.2249 6.96861L20.3117 1.53926C20.4063 1.06188 20.1797 0.582302 19.7529 0.353512C19.3261 0.126923 18.7981 0.199519 18.455 0.544904L2.96986 16.03C2.94127 16.052 2.91487 16.0762 2.89067 16.1026C1.02735 17.9945 0 20.4804 0 23.1005C0 28.5584 4.4416 33 9.89955 33C12.5218 33 15.0077 31.9727 16.8974 30.1115C16.926 30.0829 16.9502 30.0543 16.9766 30.0235L30.1232 16.8792C30.4532 16.5492 30.539 16.0454 30.3366 15.6252C30.1364 15.205 29.6876 14.9674 29.2235 15.0092L24.4409 15.5394L32.8379 1.67125C33.0975 1.24227 33.0381 0.694497 32.6883 0.335913ZM9.89955 29.7002C6.25431 29.7002 3.29985 26.7457 3.29985 23.1005C3.29985 19.4552 6.25431 16.5008 9.89955 16.5008C13.5448 16.5008 16.4992 19.4552 16.4992 23.1005C16.4992 26.7457 13.5448 29.7002 9.89955 29.7002Z" fill="#667EEA"/>
                </svg>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Добро пожаловать в Arendasoft
                </h2>
            </div>
            <div class="mt-8 space-y-2">

                <div>
                    <a href="/login/google" class="group relative w-full flex justify-center py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                          <img class="w-4" src="{{ asset('storage/login/google-icon.svg') }}" alt="google-logo">
                      </span>
                        Войти с аккаунтом Google
                    </a>
                </div>
                <div>
                    <a href="/login/yandex" class="group relative w-full flex justify-center py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                          <img class="w-5" src="{{ asset('storage/login/6rDvXXB38VOBgtxkOExfxnZPUWs.png') }}" alt="google-logo">
                      </span>
                        Войти с аккаунтом Yandex
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
