<aside class="w-full min-w-72 md:w-64 bg-gray-800 md:min-h-screen" x-data="{ isOpen: false }">
    <div class="flex items-center justify-between bg-gray-900 p-4 h-16">
        <a href="/" class="flex items-center">
            <svg class="w-6" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32.6883 0.335913C32.3407 -0.0248702 31.7929 -0.104067 31.3596 0.142322L19.2249 6.96861L20.3117 1.53926C20.4063 1.06188 20.1797 0.582302 19.7529 0.353512C19.3261 0.126923 18.7981 0.199519 18.455 0.544904L2.96986 16.03C2.94127 16.052 2.91487 16.0762 2.89067 16.1026C1.02735 17.9945 0 20.4804 0 23.1005C0 28.5584 4.4416 33 9.89955 33C12.5218 33 15.0077 31.9727 16.8974 30.1115C16.926 30.0829 16.9502 30.0543 16.9766 30.0235L30.1232 16.8792C30.4532 16.5492 30.539 16.0454 30.3366 15.6252C30.1364 15.205 29.6876 14.9674 29.2235 15.0092L24.4409 15.5394L32.8379 1.67125C33.0975 1.24227 33.0381 0.694497 32.6883 0.335913ZM9.89955 29.7002C6.25431 29.7002 3.29985 26.7457 3.29985 23.1005C3.29985 19.4552 6.25431 16.5008 9.89955 16.5008C13.5448 16.5008 16.4992 19.4552 16.4992 23.1005C16.4992 26.7457 13.5448 29.7002 9.89955 29.7002Z" fill="#667EEA"/>
            </svg>

            <span class="text-gray-300 text-xl font-semibold mx-2">АрендаСофт</span>
        </a>
        <div class="flex md:hidden">
            <button type="button" @click="isOpen = !isOpen"
                    class="text-gray-300 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                <svg class="fill-current w-8" fill="none" stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="px-2 py-6 md:block" :class="isOpen? 'block': 'hidden'" >
        <ul>
            <li>
                <a href="/" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded {{ (request()->is('/')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ env('APP_URL') }}/teams" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Компании</span>
                </a>
            </li>
            <li>
                <a href="/estates" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('estates*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Недвижимость</span>
                </a>
            </li>
            <li>
                <a href="/employees" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('employees*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Сотрудники</span>
                </a>
            </li>
            <li>
                <a href="/tenants" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('tenants*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Арендаторы</span>
                </a>
            </li>
            <li>
                <a href="/requisites" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('requisites*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Реквизиты</span>
                </a>
            </li>
            <li>
                <a href="/statements" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('statements*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Выписки</span>
                </a>
            </li>
            <li>
                <a href="/applications" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('applications*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Заявки</span>
                </a>
            </li>
            <li>
                <a href="/bills" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('bills*')) ? 'bg-gray-900' : '' }}">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Счета</span>
                </a>
            </li>
        </ul>
        <div class="border-t border-gray-700 -mx-2 mt-2 md:hidden"></div>
        <ul class="mt-6 md:hidden">
            <li>
                <a href="#" class="flex items-center px-2 py-3 hover:bg-gray-900 rounded mt-2 {{ (request()->is('requisites*')) ? 'bg-gray-900' : '' }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Выйти</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
