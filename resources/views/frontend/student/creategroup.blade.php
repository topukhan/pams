<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create Group </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('createGroup') }}" class="text-gray-900 dark:text-white">Create Group</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2">
            <form action="#" method="POST">
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto shadow-lg">
                        <table class="w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Name</th>
                                    <th class="px-3 py-3">ID</th>
                                    <th class="px-3 py-3">Email</th>
                                    <th class="px-3 py-3">Batch</th>
                                    <th class="px-3 py-3">Phone</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                {{-- Member 1 --}}
                                <tr class="text-gray-700 dark:text-gray-400 ">
                                    <td class="px-4 py-3 text-sm">
                                       01
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="w-full border-gray-100 h-8 rounded  dark:bg-gray-800 ">
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="id" placeholder="Enter ID"
                                            class="w-full  border-gray-100 h-8 rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3 ">
                                        <input type="email" name="email" placeholder="Enter email"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="batch" placeholder="Enter batch"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="tel" name="phone" placeholder="Enter phone"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                </tr>
                                {{-- Member 2 --}}
                                <tr class="text-gray-700 dark:text-gray-400 ">
                                    <td class="px-4 py-3 text-sm">
                                        02
                                     </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="w-full  border-gray-100 h-8 rounded dark:bg-gray-800 ">
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="id" placeholder="Enter ID"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3 ">
                                        <input type="email" name="email" placeholder="Enter email"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="batch" placeholder="Enter batch"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="tel" name="phone" placeholder="Enter phone"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                </tr>
                                {{-- Member 3 --}}
                                <tr class="text-gray-700 dark:text-gray-400 ">
                                    <td class="px-4 py-3 text-sm">
                                        03
                                     </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="id" placeholder="Enter ID"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3 ">
                                        <input type="email" name="email" placeholder="Enter email"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="batch" placeholder="Enter batch"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="tel" name="phone" placeholder="Enter phone"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                </tr>
                                {{-- Member 4 --}}
                                <tr class="text-gray-700 dark:text-gray-400 ">
                                    <td class="px-4 py-3 text-sm">
                                        04
                                     </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="id" placeholder="Enter ID"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3 ">
                                        <input type="email" name="email" placeholder="Enter email"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="text" name="batch" placeholder="Enter batch"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                    <td class="px-3 py-3">
                                        <input type="tel" name="phone" placeholder="Enter phone"
                                            class="w-full  border-gray-100 h-8  rounded dark:bg-gray-800 ">
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-80 flex justify-between">
                        <button type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            Add Member</button>

                        <button type="submit" class="px-4 py-2 font-bold bg-blue-500 text-white rounded hover:bg-blue-700">
                            Submit </button>
                </div>
            </form>
        </div>

    </div>





</x-frontend.student.layouts.master>