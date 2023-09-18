<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>
        {{-- <div class=" grid gap-10 md:grid-cols-2 xl:grid-cols-3"> --}}
        <!-- Cards -->
        <div class="grid gap-6 mb-8 xl:col-span-2 text-center md:grid-cols-1 xl:grid-cols-2">
            <!--Group Management Card -->
            <div
                class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-green-50">
                <div
                    class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div class="">
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Group Requests
                    </p>
                    <a href="{{ route('coordinator.requests') }}"><button
                            class="px-4 py-1 bg-green-300 hover:bg-green-500 rounded shadow-lg text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-green-500 transition duration-200 ease-in-out">
                            View
                        </button></a>
                </div>
            </div>
            <!-- Project Progress card -->
            <div
                class="p-4 bg-white rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-orange-50">
                <div
                    class="p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <i class='bx bx-receipt text-2xl'></i>
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Project Progress
                    </p>
                    <button
                        class="px-2 py-1 bg-orange-300 hover:bg-orange-500 rounded shadow-lg text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-orange-500 transition duration-200 ease-in-out">
                        View
                    </button>
                </div>
            </div>
            <!-- Report Evaluation -->
            <div
                class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-blue-50">
                <div
                    class="p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <i class="bx bx-news text-2xl"></i>
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Project Proposals
                    </p>
                    <a href="{{ route('coordinator.proposalList') }}">
                        <button
                            class="px-4 py-1  bg-blue-300 hover:bg-blue-500 rounded shadow-lg text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-blue-500 transition duration-200 ease-in-out">
                            View
                        </button>
                    </a>
                </div>
            </div>
            <!-- Communication and Notifications card -->
            <div
                class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-teal-50">
                <div
                    class="p-3 mb-4 w-12 mx-auto text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <i class='bx bxs-bell-ring text-2xl'></i>
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Notice
                    </p>
                    <a href="{{ route('coordinator.noticeCreate') }}"><button
                            class="px-3 py-1  bg-teal-200 hover:bg-teal-500 rounded shadow-lg text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-teal-500 transition duration-200 ease-in-out">
                            Create
                        </button></a>
                </div>
            </div>
        </div>

        {{-- </div> --}}
    </div>
</x-frontend.coordinator.layouts.master>
