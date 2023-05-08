<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Group Details</h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="#" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">My Group</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Group Details</a>
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
                                <th class="px-3 py-3">Members</th>
                                <th class="px-3 py-3">ID</th>
                                <th class="px-3 py-3">Batch</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">01</td>
                                <td class="px-4 py-3 font-semibold text-sm ">Kim</td>
                                <td class="px-4 py-3 font-semibold text-sm ">2192081980</td>
                                <td class="px-4 py-3 font-semibold  text-sm ">49</td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">02</td>
                                <td class="px-4 py-3 font-semibold text-sm ">Nam</td>
                                <td class="px-4 py-3 font-semibold text-sm ">2192081990</td>
                                <td class="px-4 py-3 font-semibold  text-sm ">49</td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">03</td>
                                <td class="px-4 py-3 font-semibold text-sm ">Joon</td>
                                <td class="px-4 py-3 font-semibold text-sm ">2192081970</td>
                                <td class="px-4 py-3 font-semibold  text-sm ">49</td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">04</td>
                                <td class="px-4 py-3 font-semibold text-sm ">Jin</td>
                                <td class="px-4 py-3 font-semibold text-sm ">2192081977</td>
                                <td class="px-4 py-3 font-semibold  text-sm ">49</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        </table>
    </div>
    </div>

    </div>
    </div>


</x-frontend.student.layouts.master>
