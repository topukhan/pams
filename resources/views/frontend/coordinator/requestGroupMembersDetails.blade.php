<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            My Group </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">Group Members Details</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
       
            <div class="px-2 py-2 ">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-3">             
                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Domain: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">web</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Project Type: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">project</span>
                        </div>
                    </div>
                </div>


                <div class="w-full overflow-hidden rounded-lg shadow-xs">
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
                <div class=" flex justify-center">
                    <button class="bg-purple-500 hover:bg-purple-600 text-lg text-white font-bold mt-4 py-1 px-3 rounded">
                        <a href="">+</a>
                    </button>
                </div>

            </div>
        
    </div>

   


</x-frontend.student.layouts.master>
