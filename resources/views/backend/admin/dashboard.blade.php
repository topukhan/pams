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

        <div class=" grid gap-10 md:grid-cols-2 xl:grid-cols-2">

            <!-- Cards -->
            <div class="grid gap-6 mb-8 xl:col-span-2  text-center md:grid-cols-1 xl:grid-cols-2">
                <!--Add Student Card -->
                <div class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>

                    <div class="">
                        <p class="mb-2 text-md font-semibold text-gray-600 dark:text-gray-400">
                            Add Student
                        </p>
                        <a href="{{ route('admin.addStudent') }}"><button
                                class="px-6 py-1 bg-orange-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-orange-500">
                                Add
                            </button></a>
                    </div>
                </div>

                <!-- Add supervisor card -->
                <div class="p-4 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <div
                        class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>

                    <div>
                        <p class="mb-2 text-md font-semibold text-gray-600 dark:text-gray-400">
                            Add Supervisor
                        </p>

                        <a href="{{ route('admin.addSupervisor') }}"><button
                                class="px-6 py-1 bg-green-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200 dark:bg-green-500">
                                Add
                            </button></a>
                    </div>
                </div>


                <!-- Card -->
                <div class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <i class='bx bxs-cog text-2xl'></i>
                    </div>

                    <div>
                        <p class="mb-2 text-md font-semibold text-gray-600 dark:text-gray-400">
                            Change Settings
                        </p>
                        <button
                            class="px-6 py-1  bg-blue-300 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500">
                            Settings
                        </button>
                    </div>
                </div>

                <!-- Card -->
                <div class="p-4 bg-white rounded-lg shadow-xl  dark:bg-gray-800">
                    <div
                        class="p-3 mb-4 w-12 mx-auto text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <i class='bx bxs-help-circle text-2xl'></i>

                    </div>

                    <div>
                        <p class="mb-2 text-md font-semibold text-gray-600 dark:text-gray-400">
                            Support
                        </p>
                        <a href="{{ route('student.proposalForm') }}"><button
                                class="px-6 py-1  bg-teal-200 rounded shadow text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-teal-500">
                                Help
                            </button></a>
                    </div>
                </div>
            </div>




        </div>
    </div>

</x-backend.layouts.master>
