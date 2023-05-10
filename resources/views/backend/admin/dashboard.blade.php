<x-backend.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>

        @if (session('message'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        <div class=" grid gap-10 md:grid-cols-2 xl:grid-cols-3">

            <!-- Cards -->
            <div class="grid gap-6 mb-8 xl:col-span-2  text-center md:grid-cols-1 xl:grid-cols-2">
                <!--Create Group Card -->
                <div class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>

                    <div class="">
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Create Your Group
                        </p>
                        <a href="{{ route('student.createGroup') }}"><button
                                class="px-2 py-1 bg-orange-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-orange-500">
                                Create
                            </button></a>
                    </div>
                </div>

                <!-- Genre and Supervisor Availability card -->
                <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                    <div
                        class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <i class='bx bxs-file text-2xl'></i>
                    </div>

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Genre and Supervisor Availability
                        </p>
                        <button
                            class="px-4 py-1 bg-green-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200 dark:bg-green-500">
                            Info
                        </button>
                    </div>
                </div>


                <!-- Card -->
                <div class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <i class='bx bxs-folder-open text-2xl'></i>
                    </div>

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Previous works
                        </p>
                        <button
                            class="px-4 py-1  bg-blue-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500">
                            Info
                        </button>
                    </div>
                </div>

                <!-- Card -->
                <div class="p-4 bg-white rounded-lg shadow  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <i class="bx bx-news text-2xl"></i>

                    </div>

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Proposal Form
                        </p>
                        <a href="{{ route('student.proposalForm') }}"><button
                                class="px-3 py-1  bg-teal-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-teal-500">
                                View
                            </button></a>
                    </div>
                </div>
            </div>



            {{-- Notice --}}
            <div class="mb-8 py-4 px-6 h-[60vh] overflow-y-auto bg-white rounded shadow float-right dark:bg-gray-800">
                <h2 class="mb-2  font-medium text-gray-700 dark:text-gray-400">
                    Notice
                </h2>
                {{-- Notice Card --}}
                <div class="mb-4 p-4 bg-gray-50 rounded shadow  dark:bg-gray-900">

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            notice notice notice notice notice notice notice notice .......
                        </p>
                        <button
                            class="px-2 py-1 bg-blue-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500 flex ml-auto">
                            view
                        </button>
                    </div>
                </div>
                {{-- Notice Card --}}
                <div class="mb-4 p-4 bg-gray-50 rounded shadow  dark:bg-gray-900">

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            notice notice notice notice notice notice notice notice .......
                        </p>
                        <button
                            class="px-2 py-1 bg-blue-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500 flex ml-auto">
                            view
                        </button>
                    </div>
                </div>

                {{-- Notice Card --}}
                <div class="mb-4 p-4 bg-gray-50 rounded shadow  dark:bg-gray-900">

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            notice notice notice notice notice notice notice notice .......
                        </p>
                        <button
                            class="px-2 py-1 bg-blue-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500 flex ml-auto">
                            view
                        </button>
                    </div>
                </div>

                {{-- Notice Card --}}
                <div class="mb-4 p-4 bg-gray-50 rounded shadow  dark:bg-gray-900">

                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            notice notice notice notice notice notice notice notice .......
                        </p>
                        <button
                            class="px-2 py-1 bg-blue-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500 flex ml-auto">
                            view
                        </button>
                    </div>
                </div>





            </div>
        </div>
    </div>

</x-backend.layouts.master>
