<x-backend.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Show Designation </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Show
                        Designation</a>
                </li>
            </ol>
        </div>

        <div class="container px-6 mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <div class="p-4 border-b">
                    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Designation Details
                    </h2>
                </div>
                <div class="p-4">
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4">
                                Designation Name
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <p
                                class="text-sm dark:text-gray-300 dark:bg-gray-700 focus:bg-white bg-gray-100 rounded-md px-2 py-1 border-none">
                                {{ $designation->name }}
                            </p>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-4">
                    <a href="{{ route('designations.index') }}"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-800 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Back to List
                    </a>
                </div>
                
            </div>
        </div>
    </div>

</x-backend.layouts.master>
