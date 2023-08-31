<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>
        <div class=" grid gap-10 md:grid-cols-2 xl:grid-cols-3">
            <!-- Cards -->
            <div class="grid gap-6 mb-8 xl:col-span-2  text-center md:grid-cols-1 xl:grid-cols-2">
                <!--Group Management Card -->
                <div
                    class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-green-50">
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
                            Group Management
                        </p>
                        <a href="{{ route('student.createGroup') }}"><button
                                class="px-4 py-1 bg-green-300 hover:bg-green-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-green-500 transition duration-200 ease-in-out">
                                Manage
                            </button></a>
                    </div>
                </div>

                <!-- Project Allocation card -->
                <div
                    class="p-4 bg-white rounded-lg shadow dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-orange-50">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <i class='bx bxs-archive text-2xl'></i>
                    </div>

                    <div>
                        <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                            Project Allocation
                        </p>
                        <button
                            class="px-2 py-1 bg-orange-300 hover:bg-orange-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-orange-500 transition duration-200 ease-in-out">
                            Allocate
                        </button>
                    </div>
                </div>


                <!-- Report Evaluation -->
                <div
                    class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-blue-50">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <i class="bx bx-news text-2xl"></i>
                    </div>

                    <div>
                        <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                            Report Evaluation
                        </p>
                        <button
                            class="px-4 py-1  bg-blue-300 hover:bg-blue-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-blue-500 transition duration-200 ease-in-out">
                            Details
                        </button>
                    </div>
                </div>

                <!-- Communication and Notifications card -->
                <div
                    class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800 transition duration-200 ease-in-out hover:bg-teal-50">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <i class='bx bxs-bell-ring text-2xl'></i>

                    </div>

                    <div>
                        <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                            Communication and Notifications
                        </p>
                        <a href="{{ route('student.proposalForm') }}"><button
                                class="px-3 py-1  bg-teal-200 hover:bg-teal-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200  dark:bg-teal-500 transition duration-200 ease-in-out">
                                View
                            </button></a>
                    </div>
                </div>
            </div>



            {{-- Notice --}}
            <div class="mb-8 py-4 px-6 h-[60vh] overflow-y-auto bg-white rounded shadow float-right dark:bg-gray-800">
                <h2 class="mb-2 font-medium text-gray-700 dark:text-gray-400">
                    Notices
                </h2>
                {{-- Notice Card 1 --}}
                <div
                    class="mb-4 p-4 hover:bg-gray-100 bg-gray-100 rounded shadow dark:bg-gray-900 transition duration-200 ease-in-out">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            <span class="font-bold">Attention:</span> You have new proposal request
                        </p>
                        <a href=" {{ route('supervisor.groupRequests') }}">
                            <button
                                class="px-2 py-1 text-sm bg-cyan-300 hover:bg-cyan-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-blue-500 mx-auto transition duration-200 ease-in-out">
                                Details
                            </button>
                        </a>
                    </div>
                </div>

                {{-- Notice Card 2 --}}
                <div
                    class="mb-4 p-4 hover:bg-gray-100 bg-gray-50 rounded shadow dark:bg-gray-900 transition duration-200 ease-in-out">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            <span class="font-bold">Important:</span> Project Topic Update
                        </p>
                        <button
                            class="px-2 py-1 text-sm bg-cyan-300 hover:bg-cyan-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-blue-500 flex transition duration-200 ease-in-out">
                            Details
                        </button>
                    </div>
                </div>

                {{-- Notice Card 3 --}}
                <div
                    class="mb-4 p-4 hover:bg-gray-100 bg-gray-50 rounded shadow dark:bg-gray-900 transition duration-200 ease-in-out">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            <span class="font-bold">Announcement</span> Project Allocation Confirmation
                        </p>
                        <button
                            class="px-2 py-1 text-sm bg-cyan-300 hover:bg-cyan-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-blue-500 flex transition duration-200 ease-in-out">
                            Details
                        </button>
                    </div>
                </div>

                {{-- Notice Card 4 --}}
                <div
                    class="mb-4 p-4 hover:bg-gray-100 bg-gray-50 rounded shadow dark:bg-gray-900 transition duration-200 ease-in-out">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            <span class="font-bold">Reminder:</span> Supervisor Feedback Due
                        </p>
                        <button
                            class="px-2 py-1 text-sm bg-cyan-300 hover:bg-cyan-500 rounded shadow text-md font-semibold text-gray-700 hover:text-white dark:text-gray-200 dark:bg-blue-500 flex transition duration-200 ease-in-out">
                            Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-frontend.supervisor.layouts.master>
