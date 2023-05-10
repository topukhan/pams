<x-backend.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add New Student </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('admin.addStudent') }}" class="text-gray-900 dark:text-white">Add Student</a>
                </li>
            </ol>
        </div>

        {{-- form --}}
        <div class="px-2 py-2">
            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="#">
                     {{-- role --}}
                     <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="role">
                                Role
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="role"
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:bg-gray-700 dark:text-gray-300"
                                id="role">
                                <option value="" selected disabled>select role</option>
                                <option value="">Student</option>
                                <option value="">Supervisor</option>
                                <option value="">Coordinator</option>
                            </select>
                        </div>
                    </div>

                    {{-- first name --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="first_name">
                                First Name
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="first_name" type="text" name="first_name" value="" placeholder="Enter first name">
                        </div>
                    </div>

                    {{-- Last name --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="last_name">
                                Last Name
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="last_name" type="text"  name="last_name" value="" placeholder="Enter last name">
                        </div>
                    </div>

                    {{-- Department --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="department">
                                Department
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="department"
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:bg-gray-700 dark:text-gray-300"
                                id="department">
                                <option value="" selected disabled>select department</option>
                                <option value="">CSE</option>
                                <option value="">EEE</option>
                                <option value="">RIP</option>
                            </select>
                        </div>
                    </div>

                    {{-- batch --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="batch">
                                Batch
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="batch" type="text"  name="batch" value="" placeholder="Enter Batch">
                        </div>
                    </div>

                    {{-- Shift --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <span class="text-gray-700 font-semibold dark:text-gray-300">
                                Shift :
                            </span>
                        </div>
                        <div class="md:w-3/4 pl-5">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="shift" value="" />
                                <span class="ml-2 ">DAY</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="shift" value="" />
                                <span class="ml-2 ">Night</span>
                            </label>
                        </div>
                    </div>

                    {{-- Student ID --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="student_ID">
                                Student ID
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="student_ID" type="text"  name="student_ID" value="" placeholder="Enter student ID">
                        </div>
                    </div>

                    {{-- Email  --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="email">
                                Email
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="email" type="text" name="email" value="" placeholder="Enter email ">
                        </div>
                    </div>

                    {{-- password --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="password">
                                Password
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="email" type="text"  name ="password" value="" placeholder="Enter password">
                        </div>
                    </div>

                    {{-- submit button --}}
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button
                                class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                type="button">
                                ADD
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        {{-- <div class="grid md:grid-cols-2 gap-4">
            <div class=" mb-4">
                <div class="md:flex mb-2">
                   
                    <label
                        class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                        for="my-textfield">
                        Department
                    </label>
                </div>
                <div class="w-10/12">
                    <input
                        class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                        id="my-textfield" type="text" value="" placeholder="Enter department">
                </div>
            </div>

            <div class=" mb-4">
                <div class="md:flex mb-2">
                   
                    <label
                        class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                        for="my-textfield">
                        Batch
                    </label>
                </div>
                <div class="w-10/12">
                    <input
                        class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                        id="my-textfield" type="text" value="" placeholder="Enter batch">
                </div>
            </div>
        </div> --}}

</x-backend.layouts.master>
