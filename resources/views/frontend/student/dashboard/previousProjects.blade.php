<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Previous Projects </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{route('student.dashboard')}}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{route('student.previousProjects')}}" class="text-gray-900 dark:text-white"> Upcoming Events</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2 ">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Title</th>
                                <th class="px-3 py-3">Year</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    1
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col items-start ">
                                        <p class="font-semibold text-sm">Project Allocation and Management System</p>
                                        <p class=" text-xs">Project</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">03 August 2023</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    2
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col items-start ">
                                        <p class="font-semibold text-sm"> System Allocation and Management System</p>
                                        <p class=" text-xs">Thesis</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">03 August 2023</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        
    </div>


</x-frontend.student.layouts.master>



