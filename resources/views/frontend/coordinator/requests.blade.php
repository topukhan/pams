<x-frontend.coordinator.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('coordinator.requests') }}" class="text-gray-900 dark:text-white">Requests</a>
                </li>
            </ol>
        </div>


        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Request For</th>
                                <th class="px-3 py-3">Type</th>
                                <th class="px-3 py-3">Domain</th>
                                <th class="px-3 py-3">Info</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm ">1</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-sm font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                        Group Members
                                    </span>  
                                </td>
                                <td class="px-4 py-3 text-sm ">Project</td>
                                <td class="px-4 py-3 text-sm ">Web</td>
                                <td class="px-4 py-3 text-xs ">
                                    <a href="{{ route('coordinator.formedGroupsLists') }}">
                                        <button
                                            class="px-2 py-1 font-bold text-lg align-middle leading-tight text-violet-700 bg-violet-100 rounded-full dark:bg-violet-700 dark:text-violet-100">
                                            +
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm ">2</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        Supervisor
                                    </span>  
                                </td>
                                <td class="px-4 py-3 text-sm ">thesis</td>
                                <td class="px-4 py-3 text-sm ">AI</td>
                                <td class="px-4 py-3 text-xs ">
                                    <a href="#">
                                        <button
                                            class="px-2 py-1 font-bold text-lg align-middle leading-tight text-violet-700 bg-violet-100 rounded-full dark:bg-violet-700 dark:text-violet-100">
                                            +
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>

        </div>
    </div>
</x-frontend.coordinator.layouts.master>