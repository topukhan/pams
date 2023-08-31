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
            Request For Group Members</h2>
        <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Members Available:</span>
                    <span class="col-span-2">2</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Members Needed:</span>
                    <span class="col-span-2">2</span>
                </div>

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
                    <span class="col-span-2 font-bold  text-blue-700 dark:text-blue-100">need more members</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Description:</span>
                    <span class="col-span-2">asdfghjkl;</span>
                </div>

                <div class="flex justify-end space-x-2">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.requestGroupMembersDetails') }}">Add</a>
                    </button>

                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="">Groups</a>
                    </button>
                    <button class=" bg-violet-500 hover:bg-violet-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="">Cancel</a>
                    </button>
                </div>

            </div>

        </div>


    </div>

</x-frontend.coordinator.layouts.master>
