<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Student Profile </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="#" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Student Profile</a>
                </li>
            </ol>
        </div>

        {{-- Info --}}

        <div class="px-2 py-2 mb-2">
            <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Student ID:</label>
                    <span class="col-span-2">{{ session('studentData')->student_ID }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2 ">First Name:</label>
                    <span class="col-span-2">{{ session('studentUser')->first_name }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2 ">Last Name:</label>
                    <span class="col-span-2">{{ session('studentUser')->last_name }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Email:</label>
                    <span class="col-span-2">{{ session('studentUser')->email }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Phone Number:</label>
                    <span class="col-span-2">{{ session('studentUser')->phone_number }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Department:</label>
                    <span class="col-span-2">{{ session('studentUser')->department }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Batch:</label>
                    <span class="col-span-2">{{ session('studentData')->batch }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Section:</label>
                    <span class="col-span-2">{{ session('studentData')->section }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Shift:</label>
                    <span class="col-span-2">{{ session('studentData')->shift }}</span>
                </div>
            </div>
        </div>

        <div class="px-2 py-2 mb-6">
            <div class="container mx-auto mt-2 p-4 bg-white shadow-md rounded-lg">
                <h2 class="text-gray-700 bg-gray-50 font-semibold mb-4 ">Choose</h2>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Project Type:</label>
                    <p class="col-span-2">
                        <label class=" text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                name="type" value="project" />
                            <span class="ml-2 ">Project</span>
                        </label>
                        <label class=" ml-6 text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                name="type" value="thesis" />
                            <span class="ml-2 ">Thesis</span>
                        </label>
                    </p>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1">
                    <label class="text-gray-700 font-bold mb-2">Domain:</label>
                    <select name="domain"
                        class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                        id="domain">
                        <option value="0" selected disabled>select domain</option>
                    </select>
                </div>

                <div class="flex justify-center">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        Save
                    </button>

                </div>

            </div>
        </div>

    </div>


</x-frontend.student.layouts.master>
