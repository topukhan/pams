<x-backend.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add New Coordinator </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('admin.addCoordinatorForm') }}" class="text-gray-900 dark:text-white">Add
                        Coordinator</a>
                </li>
            </ol>
        </div>

        {{-- form --}}
        <div class="px-2 py-2">
            {{-- session message  --}}
            @if (session('message'))
                <div class="bg-purple-100 border-t-4 border-purple-500 rounded-b text-purple-900 px-4 py-3 shadow-md my-4 "
                    id="sessionMessage">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-purple-500 rounded-full flex-shrink-0">
                            <svg class="w-4 h-4 fill-current text-white mx-auto my-1" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 011-1h2a1 1 0 010 2h-2a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 010 2h-2a1 1 0 01-1-1z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            {{ session('message') }}
                        </div>
                        <button type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            data-dismiss="alert" aria-label="Close" onclick="dismissAlert()">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <script>
                    function dismissAlert() {
                        document.getElementById('sessionMessage').style.display = 'none';
                    }
                    // Automatically dismiss the alert after 3 seconds
                    setTimeout(dismissAlert, 3000);
                </script>
            @endif


            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form method="POST" action="{{ route('admin.addCoordinator') }}">
                    @csrf
                    {{-- role --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="role" type="hidden" name="role" value="coordinator">
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
                                id="first_name" type="text" name="first_name" value="{{ old('first_name') }}"
                                placeholder="Enter first name">
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
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
                                id="last_name" type="text" name="last_name" value="{{ old('last_name') }}"
                                placeholder="Enter last name">
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
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
                                <option value="0" selected disabled>select department</option>
                                <option value="CSE">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="others">others</option>
                            </select>
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>
                    </div>
                    {{-- Phone Number --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="phone_number">
                                Contact Number
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="phone_number" type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                placeholder="Enter Contact Number">
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Faculty ID --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="faculty_id">
                                Faculty ID
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="faculty_id" type="number" name="faculty_id" value="{{ old('faculty_id') }}"
                                placeholder="Enter Faculty ID">
                            <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Designation --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="designation">
                                Designation
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="designation" type="text" name="designation" value=""
                                placeholder="Enter designation">
                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
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
                                id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter email ">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                                id="password" type="password" name="password" value=""
                                placeholder="Enter password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    {{-- submit button --}}
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button
                                class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                type="submit">
                                ADD
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

</x-backend.layouts.master>
