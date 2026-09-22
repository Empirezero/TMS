<!-- Dashboard -->
<x-app-layout>
    <div class="py-8 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-4 sm:px-0">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Welcome back, {{ Auth::user()->name }} 👋
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        System Role: <span class="px-3 py-1 text-xs font-bold rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200 uppercase tracking-wide">{{ Auth::user()->role }}</span>
                    </p>
                </div>
                <div class="text-sm font-semibold text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    📅 {{ now()->format('D, M d, Y') }}
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Vehicles -->
                <div class="group p-9 rounded-2xl shadow-lg bg-gradient-to-br from-blue-600 to-indigo-700 text-white relative overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                    <div class="relative z-10">
                        <h3 class="text-white/80 text-xs font-bold uppercase tracking-widest">Active Fleet</h3>
                        <p class="text-5xl font-black mt-2">{{ $totalVehicles }}</p>
                    </div>
                    <span class="text-7xl opacity-20 absolute -right-2 -bottom-4 group-hover:scale-110 transition-transform duration-500">🚛</span>
                </div>

                <!-- Total Fuel -->
                <div class="group p-9 rounded-2xl shadow-lg bg-gradient-to-br from-orange-500 to-red-600 text-white relative overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                    <div class="relative z-10">
                        <h3 class="text-white/80 text-xs font-bold uppercase tracking-widest">Total Fuel Logged</h3>
                        <p class="text-5xl font-black mt-2">{{ number_format($totalfuelscosts, 1) }} <span class="text-lg font-normal opacity-80">Ltrs</span></p>
                    </div>
                    <span class="text-7xl opacity-20 absolute -right-2 -bottom-4 group-hover:scale-110 transition-transform duration-500">⛽</span>
                </div>

                <!-- Total Service Cost -->
                <div class="group p-9 rounded-2xl shadow-lg bg-gradient-to-br from-emerald-500 to-green-700 text-white relative overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                    <div class="relative z-10">
                        <h3 class="text-white/80 text-xs font-bold uppercase tracking-widest">Maintenance Spend</h3>
                        <p class="text-5xl font-black mt-2"><span class="text-lg font-normal opacity-80">KES</span> {{ number_format($totalservicescosts, 0) }}</p>
                    </div>
                    <span class="text-7xl opacity-20 absolute -right-2 -bottom-4 group-hover:scale-110 transition-transform duration-500">🛠️</span>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="px-4 sm:px-0">
                <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                    <span class="mr-3 p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">🚀</span>
                    Quick Actions & Management
                </h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @if(in_array(Auth::user()->role, ['system_admin', 'transport_officer']))
                    <!-- Service Requests -->
                    <a href="{{ route('servicerequests.index') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-blue-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">📋</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Service Requests</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Approve and track all pending maintenance tickets.</p>
                    </a>

                    <!-- Vehicles -->
                    <a href="{{ route('vehicles.index') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-green-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">🚗</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Fleet List</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Manage registrations, conditions, and assignments.</p>
                    </a>

                    <!-- Users -->
                    <a href="{{ route('users.index') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-purple-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">👥</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">User Access</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Manage system access for drivers and officers.</p>
                    </a>
                    @endif

                    @if(Auth::user()->role === 'driver')
                    <!-- My Vehicle -->
                    <a href="{{ route('vehicles.index') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-emerald-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">🔑</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">My Assignment</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">View details for your currently assigned vehicle.</p>
                    </a>

                    <!-- Fuel Logs -->
                    <a href="#" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-orange-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">⛽</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Fuel Entry</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Log new refueling data and mileage details.</p>
                    </a>

                    <!-- Service Logs -->
                    <a href="{{ route('services.index') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-teal-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">📝</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">History</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Review past maintenance and service records.</p>
                    </a>
                    @endif

                    <!-- Global: Profile -->
                    <a href="{{ route('profile.edit') }}" class="group block p-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl border-l-4 border-gray-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <span class="text-2xl mr-3 group-hover:scale-125 transition-transform duration-300">⚙️</span>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Settings</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Update your password and profile security.</p>
                    </a>

                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                <!-- Recent Service Requests -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <h4 class="font-bold text-gray-800 dark:text-gray-200">Recent Service Requests</h4>
                        <a href="{{ route('servicerequests.index') }}" class="text-xs text-blue-600 font-semibold hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3">Vehicle</th>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($recentServices as $request)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $request->reg_no }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $request->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $request->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">No requests found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Vehicle Requests -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <h4 class="font-bold text-gray-800 dark:text-gray-200">Recent Vehicle Requests</h4>
                        <a href="#" class="text-xs text-blue-600 font-semibold hover:underline">View All</a>
                    </div>
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Activity Name</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($recentVehicleRequests as $request)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $request->activity_name }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $request->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">No requests found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<!-- end of dashboard -->

<!-- Service Requests Section - index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Service Requests
            </h2>

            <a href="{{ route('servicerequests.create') }}">
                <x-primary-button>
                    New Request
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Reference No</th>
                                <th class="px-4 py-2 text-left">Reg No</th>
                                <th class="px-4 py-2">Service Type</th>
                                <th class="px-4 py-2">Driver</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($servicerequests as $request)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $request->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $request->reference_no }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $request->reg_no }}
                                </td>

                                <td class="px-4 py-3 capitalize">
                                    {{ $request->service_type }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $request->driver_name }}
                                </td>


                                <td class="px-4 py-3">
                                    @if($request->status === 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                    @elseif($request->status === 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                    @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center gap-3">

                                        <!-- View Action -->
                                        <div class="relative group">
                                            <a href="{{ route('servicerequests.show', $request) }}"
                                                class="p-1.5 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                                <svg xmlns="http://www.w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </a>
                                            <!-- Tooltip -->
                                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-[10px] font-bold text-white bg-gray-900 rounded shadow-lg whitespace-nowrap z-50">
                                                View Details
                                            </span>
                                        </div>


                                        @if($request->status === 'rejected')
                                        <!-- Edit Action -->

                                        <div class="relative group">
                                            <a href="{{ route('servicerequests.edit', $request) }}"
                                                class="p-1.5 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>

                                            </a>
                                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-[10px] font-bold text-white bg-gray-900 rounded shadow-lg whitespace-nowrap z-50">
                                                Edit Request
                                            </span>
                                        </div>
                                        @endif

                                        <!-- Approve Action (Only for Pending) -->
                                        @if($request->status === 'pending')
                                        <div class="relative group">
                                            <a href="{{ route('servicerequests.openapproval', $request) }}"
                                                class="p-1.5 rounded-lg text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all">
                                                <svg xmlns="http://www.w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                </svg>
                                            </a>
                                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-[10px] font-bold text-white bg-gray-900 rounded shadow-lg whitespace-nowrap z-50">
                                                Approve
                                            </span>
                                        </div>
                                        @endif

                                        <!-- Download Action (Only for Approved) -->
                                        @if($request->status === 'approved')
                                        <div class="relative group">
                                            <a href="{{ route('servicerequests.download', $request) }}"
                                                class="p-1.5 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                                                <svg xmlns="http://www.w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </a>
                                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-[10px] font-bold text-white bg-gray-900 rounded shadow-lg whitespace-nowrap z-50">
                                                Download PDF
                                            </span>
                                        </div>
                                        @endif

                                    </div>
                                </td>


                            </tr>
                            @empty
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-4 text-center text-gray-500">
                                    No service requests found.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $servicerequests->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<!-- End of Service Requests Section - index.blade.php -->

<!-- create service request form -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Motor Vehicle Service & Repair Requisition Form') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST"
                    action="{{ route('servicerequests.store') }}"
                    enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @php $today = date('Y-m-d'); @endphp
                    <!-- <div class="mb-4">
                        <label class="block mb-1 required font-semibold">Date of Request</label>
                        <input type="date" name="request_date" value="{{ old('request_date', $today) }}" min="{{ $today }}" max="{{ $today }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div> -->
                    <div class="mb-4">
                        <label class="block mb-1 required font-semibold">Date of Request</label>
                        <input type="date" name="request_date" value="{{ old('request_date') }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>


                    <!-- ============================= -->
                    <!-- 1. VEHICLE IDENTIFICATION -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        1. Vehicle Identification Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- <div>
                            <x-input-label value="Select Vehicle Registration" />
                            <select id="reg_no" name="reg_no" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Vehicle --</option>
                                @foreach($vehicles as $id => $reg_no)
                                <option value="{{ $reg_no }}" {{ old('reg_no') == $reg_no ? 'selected' : '' }}>
                                    {{ $reg_no }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('reg_no')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label value="Make" />
                            <x-text-input name="make" class="block mt-1 w-full"
                                :value="old('make')" required />
                        </div>

                        <div>
                            <x-input-label value="Model / Type" />
                            <x-text-input name="model" class="block mt-1 w-full"
                                :value="old('model')" required />
                        </div> -->
                        <div>
                            <x-input-label value="Select Vehicle Registration" />
                            <select id="reg_no" name="reg_no" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Vehicle --</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->plate_number }}"
                                    data-make="{{ $vehicle->make }}"
                                    data-model="{{ $vehicle->model }}"
                                    data-last-km="{{ $vehicle->last_km }}"
                                    data-driver-name="{{ $vehicle->current_driver_name }}"

                                    {{ old('reg_no') == $vehicle->plate_number ? 'selected' : '' }}>
                                    {{ $vehicle->plate_number }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('reg_no')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label value="Make" />
                            <x-text-input id="make_input" name="make" class="block mt-1 w-full bg-gray-50"
                                :value="old('make')" readonly required />
                        </div>

                        <div>
                            <x-input-label value="Model / Type" />
                            <x-text-input id="model_input" name="model" class="block mt-1 w-full bg-gray-50"
                                :value="old('model')" readonly required />
                        </div>


                        <div>
                            <x-input-label value="Engine CC" />
                            <x-text-input name="engine_cc" class="block mt-1 w-full"
                                :value="old('engine_cc')" required />
                        </div>

                        <div>
                            <x-input-label value="Fuel Type" />
                            <x-text-input name="fuel_type" class="block mt-1 w-full"
                                :value="old('fuel_type')" required />
                        </div>

                        <!-- <div>
                            <x-input-label value="Previous service Odometer Reading" />
                            <x-text-input type="number" name="previous_km"
                                class="block mt-1 w-full"
                                :value="old('previous_km')" required />
                        </div> -->
                        <div>
                            <x-input-label value="Previous service Odometer Reading" />
                            <x-text-input type="number" id="previous_km" name="previous_km"
                                class="block mt-1 w-full"
                                :value="old('previous_km')" required />
                        </div>


                        <div>
                            <x-input-label value="Current KM" />
                            <x-text-input type="number" name="current_km"
                                class="block mt-1 w-full"
                                :value="old('current_km')" required />
                        </div>

                        <div>
                            <x-input-label value="Assigned Driver" />

                            <!-- <select id="assigned_driver" name="assigned_driver" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Driver --</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->name }}"
                                    {{ old('driver_name') == $driver->name ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                                @endforeach
                            </select> -->

                            <select id="driver_id" name="assigned_driver" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Driver --</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->name }}" {{ old('assigned_driver') == $driver->name ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>



                    </div>
                    <div>
                        <x-input-label value="Select Service Station" />
                        <select id="service_station" name="service_station" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Select Service Station --</option>
                            @foreach($serviceStations as $station)
                            <option value="{{ $station->name }}"
                                {{ old('service_station') == $station->name ? 'selected' : '' }}>
                                {{ $station->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('reg_no')" class="mt-2" />
                    </div>
                    <!-- ============================= -->
                    <!-- 2. SERVICE TYPE -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        2. Type of Service Required
                    </h3>

                    <div>
                        <select name="service_type"
                            class="block w-full mt-1 border-gray-300 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm">
                            <option value="minor">Minor Service</option>
                            <option value="major">Major Service</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- <div id="other_service_type" style="display:none;"> -->
                    <div id="other_service_type">
                        <x-input-label value="Other Specifications on the service type" />
                        <textarea name="service_type_other"
                            class="block w-full mt-1 rounded-md border-gray-300 dark:bg-gray-900 dark:text-gray-100"></textarea>
                    </div>

                    <!-- ============================= -->
                    <!-- 3. DESCRIPTION -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        3. Detailed Description of Fault / Service Requirement
                    </h3>

                    <textarea name="description"
                        class="block w-full mt-1 rounded-md border-gray-300 dark:bg-gray-900 dark:text-gray-100"
                        rows="4"></textarea>

                    <!-- ============================= -->
                    <!-- 4. VEHICLE CONDITION -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        4. Vehicle Condition Declaration
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label value="Vehicle Drivable" />
                            <select name="vehicle_drivable"
                                class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Warning Lights On" />
                            <select name="warning_lights"
                                class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Visible Body Damage" />
                            <select name="body_damage"
                                class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Fluid Leaks Observed" />
                            <select name="fluid_leaks"
                                class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Tyre Condition" />
                            <select name="tyre_condition"
                                class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="good">Good</option>
                                <option value="worn">Fair</option>
                                <option value="replace">Worn Out</option>
                            </select>
                        </div>
                    </div>

                    <!-- ============================= -->
                    <!-- 5. DRIVER DECLARATION -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        5. Driver Declaration
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label value="Driver Name" />
                            <x-text-input
                                name="driver_name"
                                class="block mt-1 w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed"
                                value="{{ Auth::user()->name }}"
                                readonly
                                required />
                        </div>
                        <input type="hidden" name="driver_id" value="{{ Auth::id() }}">
                        <div>
                            <x-input-label value="Date" />
                            <input type="date" name="driver_date" value="{{ old('driver_date', $today) }}" required
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label value="Driver Signature" />

                            <canvas id="signature-canvas"
                                class="border border-gray-300 w-full h-48 rounded bg-white touch-none"></canvas>

                            <input type="hidden"
                                name="driver_signature"
                                id="signature">

                            <button type="button"
                                id="clear-signature"
                                class="mt-2 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-800">
                                Clear
                            </button>

                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <x-primary-button>
                            Submit Service Request
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <script>
        document.getElementById('reg_no').addEventListener('change', function() {
            // Get the selected option
            const selectedOption = this.options[this.selectedIndex];

            // Extract data from attributes
            const make = selectedOption.getAttribute('data-make') || '';
            const model = selectedOption.getAttribute('data-model') || '';

            // Update the input fields
            document.getElementById('make_input').value = make;
            document.getElementById('model_input').value = model;
        });
    </script>
    <script>
        document.getElementById('reg_no').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const lastKm = selected.getAttribute('data-last-km');
            const kmInput = document.getElementById('previous_km');

            if (lastKm && lastKm !== "" && lastKm !== "null") {
                // Record found: auto-fill and make read-only
                kmInput.value = lastKm;
                kmInput.readOnly = true;
                kmInput.style.backgroundColor = "#f3f4f6"; // Gray out
            } else {
                // No previous record: allow manual entry
                kmInput.value = "";
                kmInput.readOnly = false;
                kmInput.style.backgroundColor = "#ffffff";
                kmInput.placeholder = "No history found - enter manually";
            }


            // Auto-select the Driver
            const driverName = selected.getAttribute('data-driver-name');
            const driverSelect = document.getElementById('driver_id');

            if (driverName && driverName !== "null" && driverName !== "") {
                // Auto-select by name (since your option values are names)
                driverSelect.value = driverName;
                driverSelect.disabled = true;
                driverSelect.classList.add('bg-gray-100');
            } else {
                driverSelect.value = "";
                driverSelect.disabled = false;
                driverSelect.classList.remove('bg-gray-100');
            }

        });
    </script>



    <!-- Signature Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const canvas = document.getElementById('signature-canvas');
            const signatureInput = document.getElementById('signature');
            const clearBtn = document.getElementById('clear-signature');
            const ctx = canvas.getContext('2d');

            function resizeCanvas() {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            }

            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            let drawing = false;

            function getPosition(e) {
                const rect = canvas.getBoundingClientRect();

                if (e.touches) {
                    return {
                        x: e.touches[0].clientX - rect.left,
                        y: e.touches[0].clientY - rect.top
                    };
                }

                return {
                    x: e.clientX - rect.left,
                    y: e.clientY - rect.top
                };
            }

            function startPosition(e) {
                drawing = true;

                const pos = getPosition(e);

                ctx.beginPath(); // start a new path
                ctx.moveTo(pos.x, pos.y); // move cursor to click point
            }

            function endPosition() {
                drawing = false;
                ctx.beginPath();
                signatureInput.value = canvas.toDataURL();
            }

            function draw(e) {

                if (!drawing) return;

                const pos = getPosition(e);

                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = '#000';

                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
            }

            canvas.addEventListener('mousedown', startPosition);
            canvas.addEventListener('mouseup', endPosition);
            canvas.addEventListener('mousemove', draw);

            canvas.addEventListener('touchstart', startPosition);
            canvas.addEventListener('touchend', endPosition);
            canvas.addEventListener('touchmove', draw);

            clearBtn.addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                signatureInput.value = '';
            });

        });
    </script>


    <!-- show other on select -->
    <!-- <script>
        document.querySelector('select[name="service_type"]').addEventListener('change', function() {
            const otherField = document.getElementById('other_service_type');
            if (this.value === 'other') {
                otherField.style.display = 'block';
            } else {
                otherField.style.display = 'none';
            }
        });
    </script> -->

</x-app-layout>
<!-- end of create service request form -->

<!-- edit service request form -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Motor Vehicle Service Request') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded text-red-700">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST"
                    action="{{ route('servicerequests.update',$serviceRequest->id) }}"
                    enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf
                    @method('PUT')

                    @php $today = date('Y-m-d'); @endphp

                    <!-- Request Date -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Date of Request</label>

                        <input type="date"
                            name="request_date"
                            value="{{ old('request_date',$serviceRequest->request_date) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>

                    <!-- ============================= -->
                    <!-- VEHICLE DETAILS -->
                    <!-- ============================= -->

                    <h3 class="text-lg font-semibold border-b pb-2">
                        Vehicle Identification Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label value="Vehicle Registration" />

                            <select name="reg_no"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">

                                <option value="">Select Vehicle</option>

                                @foreach($vehicles as $id=>$reg_no)

                                <option value="{{ $reg_no }}"
                                    {{ old('reg_no',$serviceRequest->reg_no)==$reg_no?'selected':'' }}>

                                    {{ $reg_no }}

                                </option>

                                @endforeach
                            </select>

                        </div>

                        <div>
                            <x-input-label value="Make" />
                            <x-text-input name="make"
                                class="block mt-1 w-full"
                                :value="old('make',$serviceRequest->make)" />
                        </div>

                        <div>
                            <x-input-label value="Model" />
                            <x-text-input name="model"
                                class="block mt-1 w-full"
                                :value="old('model',$serviceRequest->model)" />
                        </div>

                        <div>
                            <x-input-label value="Engine CC" />
                            <x-text-input name="engine_cc"
                                class="block mt-1 w-full"
                                :value="old('engine_cc',$serviceRequest->engine_cc)" />
                        </div>

                        <div>
                            <x-input-label value="Fuel Type" />
                            <x-text-input name="fuel_type"
                                class="block mt-1 w-full"
                                :value="old('fuel_type',$serviceRequest->fuel_type)" />
                        </div>

                        <div>
                            <x-input-label value="Previous KM" />
                            <x-text-input type="number"
                                name="previous_km"
                                class="block mt-1 w-full"
                                :value="old('previous_km',$serviceRequest->previous_km)" />
                        </div>

                        <div>
                            <x-input-label value="Current KM" />
                            <x-text-input type="number"
                                name="current_km"
                                class="block mt-1 w-full"
                                :value="old('current_km',$serviceRequest->current_km)" />
                        </div>

                        <div>
                            <x-input-label value="Assigned Driver" />
                            <x-text-input name="assigned_driver"
                                class="block mt-1 w-full"
                                :value="old('assigned_driver',$serviceRequest->assigned_driver)" />
                        </div>

                    </div>

                    <!-- Service Station -->

                    <div>

                        <x-input-label value="Service Station" />

                        <select name="service_station"
                            class="block mt-1 w-full border-gray-300 rounded-md">

                            <option value="">Select Service Station</option>

                            @foreach($serviceStations as $station)

                            <option value="{{ $station->name }}"
                                {{ old('service_station',$serviceRequest->service_station)==$station->name?'selected':'' }}>

                                {{ $station->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- ============================= -->
                    <!-- SERVICE TYPE -->
                    <!-- ============================= -->

                    <h3 class="text-lg font-semibold border-b pb-2">
                        Service Type
                    </h3>

                    <select name="service_type"
                        class="block w-full mt-1 border-gray-300 rounded-md">

                        <option value="minor"
                            {{ old('service_type',$serviceRequest->service_type)=='minor'?'selected':'' }}>

                            Minor Service

                        </option>

                        <option value="major"
                            {{ old('service_type',$serviceRequest->service_type)=='major'?'selected':'' }}>

                            Major Service

                        </option>

                        <option value="other"
                            {{ old('service_type',$serviceRequest->service_type)=='other'?'selected':'' }}>

                            Other

                        </option>

                    </select>

                    <div id="other_service_type">

                        <x-input-label value="Other Service Type" />

                        <textarea name="service_type_other"
                            class="block w-full mt-1 rounded-md border-gray-300">

                        {{ old('service_type_other',$serviceRequest->service_type_other) }}

                        </textarea>

                    </div>

                    <!-- ============================= -->
                    <!-- DESCRIPTION -->
                    <!-- ============================= -->

                    <h3 class="text-lg font-semibold border-b pb-2">
                        Detailed Description of Fault / Service Requirement
                    </h3>

                    <textarea name="description"
                        rows="4"
                        class="block w-full mt-1 rounded-md border-gray-300">

                    {{ old('description',$serviceRequest->description) }}

                    </textarea>

                    <!-- ============================= -->
                    <!-- 4. VEHICLE CONDITION -->
                    <!-- ============================= -->
                    <h3 class="text-lg font-semibold border-b pb-2">
                        4. Vehicle Condition Declaration
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Vehicle Drivable -->
                        <div>
                            <x-input-label value="Vehicle Drivable" />
                            <select name="vehicle_drivable" class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1" {{ old('vehicle_drivable',$serviceRequest->vehicle_drivable) == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('vehicle_drivable',$serviceRequest->vehicle_drivable) == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Warning Lights -->
                        <div>
                            <x-input-label value="Warning Lights On" />
                            <select name="warning_lights" class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1" {{ old('warning_lights',$serviceRequest->warning_lights) == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('warning_lights',$serviceRequest->warning_lights) == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Body Damage -->
                        <div>
                            <x-input-label value="Visible Body Damage" />
                            <select name="body_damage" class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1" {{ old('body_damage',$serviceRequest->body_damage) == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('body_damage',$serviceRequest->body_damage) == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Fluid Leaks -->
                        <div>
                            <x-input-label value="Fluid Leaks Observed" />
                            <select name="fluid_leaks" class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="1" {{ old('fluid_leaks',$serviceRequest->fluid_leaks) == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('fluid_leaks',$serviceRequest->fluid_leaks) == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Tyre Condition -->
                        <div>
                            <x-input-label value="Tyre Condition" />
                            <select name="tyre_condition" class="block w-full mt-1 border-gray-300 rounded-md">
                                <option value="good" {{ old('tyre_condition',$serviceRequest->tyre_condition) == 'good' ? 'selected' : '' }}>Good</option>
                                <option value="worn" {{ old('tyre_condition',$serviceRequest->tyre_condition) == 'worn' ? 'selected' : '' }}>Fair</option>
                                <option value="replace" {{ old('tyre_condition',$serviceRequest->tyre_condition) == 'replace' ? 'selected' : '' }}>Worn Out</option>
                            </select>
                        </div>

                    </div>

                    <!-- ============================= -->
                    <!-- DRIVER -->
                    <!-- ============================= -->

                    <h3 class="text-lg font-semibold border-b pb-2">
                        Driver Declaration
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label value="Driver Name" />
                            <x-text-input name="driver_name"
                                class="block mt-1 w-full"
                                :value="old('driver_name',$serviceRequest->driver_name)" />
                        </div>
                        <input type="hidden" name="driver_id" value="{{ Auth::id() }}">
                        <div>
                            <x-input-label value="Driver Date" />

                            <input type="date"
                                name="driver_date"
                                value="{{ old('driver_date',$serviceRequest->driver_date) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2">

                        </div>

                    </div>

                    <!-- Submit -->

                    <div class="flex justify-end">

                        <x-primary-button>

                            Update Service Request

                        </x-primary-button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
<!-- end of edit service request form -->

<!-- Show service request details -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Service Request Details
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Reference Number:</strong> {{ $serviceRequest->reference_no }}</p>
                    <p><strong>Request Date:</strong> {{ $serviceRequest->request_date }}</p>
                    <p><strong>Registration No:</strong> {{ $serviceRequest->reg_no }}</p>
                    <p><strong>Make:</strong> {{ $serviceRequest->make }}</p>
                    <p><strong>Model:</strong> {{ $serviceRequest->model }}</p>
                    <p><strong>Engine CC:</strong> {{ $serviceRequest->engine_cc }}</p>
                    <p><strong>Fuel Type:</strong> {{ $serviceRequest->fuel_type }}</p>
                    <p><strong>Previous Service KM:</strong> {{ $serviceRequest->previous_km }}</p>
                    <p><strong>Current KM:</strong> {{ $serviceRequest->current_km }}</p>
                    <p><strong>Assigned Driver:</strong> {{ $serviceRequest->assigned_driver }}</p>
                    <p><strong>Service Type:</strong> {{ $serviceRequest->service_type }}</p>
                    <p><strong>Service Type Details:</strong> {{ $serviceRequest->service_type_other ?? 'N/A' }}</p>
                    <p><strong>Description:</strong> {{ $serviceRequest->description ?? 'N/A' }}</p>
                    <p><strong>Vehicle Drivable:</strong> {{ $serviceRequest->vehicle_drivable ? 'Yes' : 'No' }}</p>
                    <p><strong>Warning Lights:</strong> {{ $serviceRequest->warning_lights ? 'Yes' : 'No' }}</p>
                    <p><strong>Body Damage:</strong> {{ $serviceRequest->body_damage ? 'Yes' : 'No' }}</p>
                    <p><strong>Fluid Leaks:</strong> {{ $serviceRequest->fluid_leaks ? 'Yes' : 'No' }}</p>
                    <p><strong>Tyre Condition:</strong> {{ $serviceRequest->tyre_condition }}</p>
                    <p><strong>Driver Name:</strong> {{ $serviceRequest->driver_name }}</p>
                    <p><strong>Driver Date:</strong> {{ $serviceRequest->driver_date }}</p>
                    <div>
                        @if($serviceRequest->driver_signature)
                        <p><strong>Driver Signature:</strong></p>
                        <img src="{{$serviceRequest->driver_signature }}" alt="Driver Signature" class="h-32">
                        @endif
                    </div>

                </div>



                @if ($serviceRequest->status !== 'pending')
                <hr class="my-6 border-gray-300">
                <h3 class="text-lg font-semibold mb-4">OFFICIAL USE ONLY</h3>

                <div class="grid md:grid-cols-3 gap-4 mb-4 text-gray-700 dark:text-gray-300">
                    <div class="mb-4">
                        <span class="font-medium">Transport Officer Comments:</span>
                        <div>{{ $serviceRequest->inspection_findings ?? '-' }}</div>
                    </div>

                    <div class="md:col-span-2">
                        <span class="font-medium">Request Approver (Full Name):</span>
                        <div> {{ $serviceRequest->approver?->name ?? '-' }}</div>
                    </div>

                </div>

                <div class="mb-6">
                    <span class="font-medium">Request Approver Signature:</span>
                    @if ($serviceRequest->approver_signature)
                    <div class="mt-2">
                        <img src="{{ $serviceRequest->approver_signature }}" alt="Signature" class="border rounded w-64">
                    </div>
                    @else
                    <div>-</div>
                    @endif
                </div>
                @endif



                <div class="mt-6">
                    <a href="{{ route('servicerequests.index') }}" class="text-blue-500 hover:underline">&larr; Back to List</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<!-- end of show service request details -->