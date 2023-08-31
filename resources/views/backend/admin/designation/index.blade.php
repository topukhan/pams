<x-backend.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Designation list </h2>

        {{-- breadcrumb --}}
        <div class="px-4 ">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('designations.index') }}" class="text-gray-900 dark:text-white">
                        Designation</a>
                </li>
            </ol>
        </div>


        <div class="px-2 py-2">

            {{-- create button --}}
            <div class="px-2 py-2 ">
                <a href="{{ route('designations.create') }}"
                    class="inline-block px-4 py-2 shadow-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-800 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Create Designation
                </a>
            </div>
            <div class="p-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-2">
                    {{-- session message  --}}
                    @if (session('message'))
                        <div
                            class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    {{ session('message') }}
                                </div>
                                <button type="button"
                                    class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                                    data-dismiss="alert" aria-label="Close"
                                    onclick="this.parentElement.parentElement.style.display='none'">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif


                    {{-- table --}}
                    <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500 bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-3">Sl.</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Calculate the starting serial number for the current page --}}
                                @php
                                    $starting_serial = ($designations->currentPage() - 1) * $designations->perPage() + 1;
                                @endphp
                                @foreach ($designations as $key => $designation)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-3">{{ $starting_serial++ }}</td>
                                        <td class="px-4 py-3">{{ $designation->name }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('designations.show', $designation->id) }}"
                                                class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-800">
                                                Show
                                            </a>
                                            <a href="{{ route('designations.edit', $designation->id) }}"
                                                class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-yellow-600 transition duration-200 bg-yellow-200 rounded-md hover:bg-yellow-300 ml-2">
                                                Edit
                                            </a>
                                            <form action="{{ route('designations.destroy', $designation->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-red-600 transition duration-200 bg-red-200 rounded-md hover:bg-red-300 ml-2"
                                                    onclick="return confirm('Are you sure you want to delete this designation?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <nav class="flex items-center">
                            {{-- Previous Page Link --}}
                            @if ($designations->onFirstPage())
                                <span
                                    class="px-2 py-1 text-sm font-medium leading-5 text-gray-400 cursor-not-allowed">First</span>
                                <span
                                    class="px-2 py-1 text-sm font-medium leading-5 text-gray-400 cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $designations->url(1) }}"
                                    class="relative inline-flex items-center px-2 py-1 text-sm font-medium leading-5 text-blue-600 transition duration-150 ease-in-out border rounded-md cursor-pointer hover:text-blue-800">First</a>
                                <a href="{{ $designations->previousPageUrl() }}"
                                    class="relative inline-flex items-center px-2 py-1 text-sm font-medium leading-5 text-blue-600 transition duration-150 ease-in-out border rounded-md cursor-pointer hover:text-blue-800">Previous</a>
                            @endif

                            {{-- Page Links --}}
                            <span class="px-2 py-1 text-sm font-medium leading-5 text-gray-600">
                                Page: {{ $designations->currentPage() }} of {{ $designations->lastPage() }} Records:
                                {{ $designations->total() }}
                            </span>

                            {{-- Next Page Link --}}
                            @if ($designations->hasMorePages())
                                <a href="{{ $designations->nextPageUrl() }}"
                                    class="relative inline-flex items-center px-2 py-1 text-sm font-medium leading-5 text-blue-600 transition duration-150 ease-in-out border rounded-md cursor-pointer hover:text-blue-800">Next</a>
                                <a href="{{ $designations->url($designations->lastPage()) }}"
                                    class="relative inline-flex items-center px-2 py-1 text-sm font-medium leading-5 text-blue-600 transition duration-150 ease-in-out border rounded-md cursor-pointer hover:text-blue-800">Last</a>
                            @else
                                <span
                                    class="px-2 py-1 text-sm font-medium leading-5 text-gray-400 cursor-not-allowed">Next</span>
                                <span
                                    class="px-2 py-1 text-sm font-medium leading-5 text-gray-400 cursor-not-allowed">Last</span>
                            @endif
                        </nav>
                    </div>

                </div>

            </div>
        </div>

</x-backend.layouts.master>
