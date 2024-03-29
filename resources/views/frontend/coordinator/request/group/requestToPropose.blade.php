<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Request Details
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Request
                        Details</a>
                </li>
            </ol>
        </div>
        {{-- Details --}}
        <h2
            class="p-3 leading-tight text-blue-700 bg-blue-100  dark:bg-blue-700 dark:text-blue-100 font-bold text-center ">
            Request To Propose</h2>
        <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Preferred Type:</span>
                    <span class="col-span-2">thesis</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Preferred Domain:</span>
                    <span class="col-span-2">AI</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 ">Reason:</span>
                    <span class="col-span-2 font-bold  text-blue-700 dark:text-blue-100">want to propose for
                        project</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Description:</span>
                    <span class="col-span-2">blah blah blah blah blah</span>
                </div>


                <div class="w-full mt-2 overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto shadow-md">
                        <table class="w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Student ID</th>
                                    <th class="px-3 py-3">Member</th>
                                    <th class="px-3 py-3">Email</th>

                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        1
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">21345567</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">ofh</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">mail</p>
                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                
            </div>
        </div>
        
        <div class="flex justify-end space-x-2 mb-3">
            <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                <a href="">Approve</a>
            </button>

            <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                <a href="">Deny</a>
            </button>

        </div>

    </div>

</x-frontend.coordinator.layouts.master>
