<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="mt-6 px-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Change Password </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.changePassword') }}" class="text-gray-900 dark:text-white"> Change Password
                    </a>
                </li>
            </ol>
        </div>
        <div class="px-2 py-2 ">
            <div class="p-8 bg-white dark:bg-gray-800 rounded-lg shadow-2xl">
                <form action="#" method="">
                    <!-- Current Password -->
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="currentPassword">Current Password</label>
                        </div>
                        <div class="md:w-3/4">
                            <input type="password" id="currentPassword" name="currentPassword"
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-gray-300 form-input text-gray-500">
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label for="newPassword"
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4">New
                                Password</label>
                        </div>
                        <div class="md:w-3/4">
                            <input type="password" id="newPassword" name="newPassword"
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-gray-300 form-input text-gray-500">
                        </div>
                    </div>
                    <!-- Confirm New Password -->
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label for="confirmNewPassword"
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4">Confirm
                                New Password</label>
                        </div>
                        <div class="md:w-3/4">
                            <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-gray-300 form-input text-gray-500">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-6 flex justify-center">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg">Change
                            Password</button>
                    </div>
                </form>



            </div>




        </div>


    </div>
    </div>







</x-frontend.student.layouts.master>
