<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Pending Groups </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="#" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Pending Groups</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Group Name</th>
                                <th class="px-3 py-3">Info</th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    01
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">Bangtan</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <a href="{{ route('student.pendingGroupDetails') }}">
                                        <button
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Details
                                        </button></a>
                                </td>
                            </tr>

                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    02
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">Ami</p>
                                    </div>
                                </td>
                                
                                <td class="px-4 py-3 text-xs">
                                    <a href="{{ route('student.pendingGroupDetails') }}">
                                        <button
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Details
                                        </button></a>
                                </td>
                            </tr>

                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    03
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">Sonyeondan</p>
                                    </div>
                                </td>
                               
                                <td class="px-4 py-3 text-xs">
                                    <a href="{{ route('student.pendingGroupDetails') }}">
                                        <button
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Details
                                        </button></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</x-frontend.student.layouts.master>
