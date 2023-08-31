<x-backend.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add New Project Type </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('projectTypes.create') }}" class="text-gray-900 dark:text-white">Add
                        Project Type</a>
                </li>
            </ol>
        </div>
        {{-- form --}}
        <div class="px-2 py-2">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session('message') }}
                    <button type="button" class="bg-green-400" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form method="POST" action="{{ route('projectTypes.store') }}">
                    @csrf

                    {{--  Project Type name --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="name">
                                Project Type Name
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="name" type="text" name="name" value=""
                                placeholder="Enter project Type name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    {{-- submit button --}}
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button
                                class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                type="submit">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

</x-backend.layouts.master>
