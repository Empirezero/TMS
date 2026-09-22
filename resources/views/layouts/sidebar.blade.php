<aside :class="open ? 'w-64' : 'w-20'"
    class="bg-white dark:bg-gray-900 h-screen fixed left-0 top-0 z-50 flex flex-col transition-all duration-300 ease-in-out border-r border-gray-200 dark:border-gray-700 shadow-sm">

    <!-- Sidebar Header -->
    <div class="flex items-center h-16 px-4 border-b border-gray-100 dark:border-gray-800" :class="open ? 'justify-between' : 'justify-center'">
        <h2 x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="text-sm font-bold uppercase tracking-wider text-green-600 dark:text-green-400">
            Konza Move
        </h2>
        <button @click="open = !open" class="p-1.5 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-500 hover:text-red-600 dark:hover:text-red-400 focus:outline-none transition-colors">
            <!-- Toggle icon rotates when closed -->
            <svg xmlns="http://www.w3.org" class="h-6 w-6 transition-transform duration-300" :class="{'rotate-180': !open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">

        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                Dashboard
            </span>
        </a>
        <!-- Service Requests Link -->
        <a href="{{ route('servicerequests.index') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('servicerequests.index') ? 'bg-indigo-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200">
                Service Requests
            </span>
        </a>

        <!-- Services Link -->
        <a href="{{ route('services.index') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('services.index') ? 'bg-indigo-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                </svg>
            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200">
                Services
            </span>
        </a>
        <!-- ServicesStation Link -->
        <a href="{{ route('servicestations.index') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('servicestations.index') ? 'bg-indigo-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>

            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200">
                Service Stations
            </span>
        </a>

        <!-- Vehicles Link -->
        <a href="{{ route('vehicles.index') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('vehicles.index') ? 'bg-indigo-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>

            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200">
                Vehicles
            </span>
        </a>


        <!-- Separator -->
        <div class="my-4 border-t border-gray-100 dark:border-gray-800"></div>

        <!-- Users Link -->
        <a href="{{ route('users.index') }}"
            class="flex items-center p-2 rounded-lg transition-colors group {{ request()->routeIs('users.index') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span x-show="open" class="ml-3 font-medium whitespace-nowrap" x-transition:enter="transition ease-out duration-200">
                Users
            </span>
        </a>

    </nav>
</aside>