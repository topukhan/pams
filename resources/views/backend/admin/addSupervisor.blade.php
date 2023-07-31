<x-backend.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add New Supervisor </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('admin.addSupervisorForm') }}" class="text-gray-900 dark:text-white">Add
                        Superviosr</a>
                </li>
            </ol>
        </div>

        <div class="px-2 py-2">
            @if (session('message'))
            <div class="alert alert-success alert-dismissible " role="alert">
                {{ session('message') }} 
                <button type="button" class="bg-green-400" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                {{-- form --}}
                <form method="POST" action="{{ route('admin.addSupervisor') }}">
                    @csrf
                    {{-- role --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="role" type="hidden" name="role" value="supervisor">
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
                                id="first_name" type="text" name="first_name" value=""
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
                                id="last_name" type="text" name="last_name" value=""
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
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:bg-gray-700 dark:text-gray-600"
                                id="department">
                                <option value="0" selected disabled>select department</option>
                                <option value="CSE">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="BBA">BBA</option>
                                <option value="others">Others</option>
                            </select>
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>
                    </div>

                    {{-- batch/section
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class=" text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 "
                                for="batch">
                                Batch /
                            </label>
                            <label
                                class=" text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="section">
                                Section
                            </label>
                        </div>
                        <div class="md:w-3/4 md:flex space-x-2">
                            <div class="md:w-2/4">
                                <input
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                    id="batch" type="number" name="batch" value="" placeholder="Enter Batch">
                                    <x-input-error :messages="$errors->get('batch')" class="mt-2" />
                            </div>
                            <div class="md:w-2/4">
                                <input
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                    id="section" type="text" name="section" value="" placeholder="Enter Section">
                                    <x-input-error :messages="$errors->get('section')" class="mt-2" />
                            </div>
                        </div>
                        
                    </div>

                    {{-- availability --}}
                    {{-- <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <span class="text-gray-700 font-semibold dark:text-gray-300">
                                availability :
                            </span>
                        </div>
                        <div class="md:w-3/4 pl-5">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="availability" value="day" />
                                <span class="ml-2 ">Day</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="availability" value="evening" />
                                <span class="ml-2 ">Evening</span>
                            </label>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>
                    </div> --}}

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
                                id="phone_number" type="tel" name="phone_number" value=""
                                placeholder="Enter Contact Number">
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Faculty ID --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="faculty_ID">
                                Faculty ID
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="faculty_ID" type="number" name="faculty_id" value=""
                                placeholder="Enter faculty ID">
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

                    {{-- Expertise Area --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="expertise_area">
                                Expertise Area
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="expertise_area"
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:bg-gray-700 dark:text-gray-600"
                                id="expertise_area">
                                <option value="0" selected disabled>select Area</option>
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->name }}">{{ $domain->name }}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('expertise_area')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Availability --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <span class="text-gray-700 font-semibold dark:text-gray-300">
                                Availability :
                            </span>
                        </div>
                        <div class="md:w-3/4 pl-5">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="availability" value="1" />
                                <span class="ml-2 ">Yes</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="availability" value="0" />
                                <span class="ml-2 ">No</span>
                            </label>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
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
                                id="email" type="email" name="email" value=""
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
