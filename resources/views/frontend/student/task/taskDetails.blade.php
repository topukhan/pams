<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Task Details </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{route('student.dashboard')}}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Task</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Task Details</a>
                </li>
            </ol>
        </div>


        

        <div class="px-4 py-6">
            <div class="flex justify-between">
                <div class="w-4/6">
                    <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md p-4">
                        <div class="mb-4">
                            <span class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Task:</span>
                            <p class="text-base font-medium">Background study</p>
                        </div>
                        <div class="mb-4">
                            <span class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Instructions:</span>
                            <p class="text-base font-medium">The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dogThe quick brown fox jumps over the lazy dog The quick brown fox jumps over the lazy dog. So it's neumu palla ! The quick brown fox jumps over the lazy dog. So it's neumu palla !The quick brown fox jumps over the lazy dog. So it's neumu palla !</p>
                        </div>
                    </div>
                </div>
                <div class="w-2/6">
                <div class="flex items-start justify-center">
                    <div class="bg-red-500 w-5 h-5 rounded-full flex items-center justify-center text-white font-bold text-lg">!</div>
                    <div class="ml-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Deadline:</span>
                        <p class="text-base font-medium">09.09.2023</p>
                    </div>
                </div>
                    
                    <div class=" p-6">
                        <span class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Question or Query:</span>
                        <form>
                            <textarea class="w-full p-2 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" rows="4" placeholder="Type your question here"></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                                Ask
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
    </div>


</x-frontend.student.layouts.master>
