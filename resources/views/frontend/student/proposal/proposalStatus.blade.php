<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Proposal Status </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Project Proposal</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.proposalStatus') }}" class="text-gray-900 dark:text-white">Status</a>
                </li>
            </ol>
        </div>
        {{-- Details --}}
        @if ($proposal)
            <div class="container mx-auto mt-2 p-4 bg-white shadow-md rounded-lg">

                <div class="p-4 ">

                    <span>
                        @if ($proposal->supervisor_feedback == 'pending')
                            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow"
                                id="alert">
                                <span class=" leading-tight text-blue-700 font-bold ">
                                    Status:
                                </span>
                                <span class="text-md"><button
                                        class="text-yellow-700 bg-yellow-100 font-bold px-2 py-1 rounded-full">pending</button>
                                </span>

                            </div><br>
                        @elseif ($proposal->supervisor_feedback == 'accepted')
                            <div class="relative top-1/4  w-full bg-green-100 text-gray-700 px-4 py-4 rounded-lg shadow"
                                id="alert">
                                <span class=" leading-tight text-blue-700 font-bold ">
                                    Status:
                                </span>
                                <span class="text-md">Supervisor <button
                                        class="text-green-700 bg-green-200 px-2 font-bold py-1 rounded-full">accepted</button>,
                                    Coordinator approval <button
                                        class="text-yellow-600 bg-yellow-100 px-2 py-1 font-bold rounded-full">pending</button>
                                </span>

                            </div><br>
                        @elseif ($proposal->supervisor_feedback == 'rejected')
                            <div class="relative top-1/4  w-full bg-red-200 text-red-700 px-4 py-4 rounded-lg shadow"
                                id="alert">
                                <span class=" leading-tight text-blue-700 font-bold ">
                                    Status:
                                </span>
                                <span class="text-md"><button
                                        class="text-red-700 bg-red-100 px-2 py-1 rounded-full">Rejected</button>
                                </span>

                            </div><br>
                        @endif

                        {{-- <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow"
                                    id="alert">
                                    
                                    <span class="text-md"><button
                                            class="text-yellow-700 bg-yellow-100 px-2 py-1 rounded-full">pending</button></span>
                                    <button type="button"
                                        class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                                        onclick="this.parentElement.style.display ='none'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                                d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </button>
                                </div><br> --}}
                    </span>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Project Type:</span>
                        <span class="col-span-3">{{ ucfirst($proposal->project_type) }}</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Domain:</span>
                        <span class="col-span-3">{{ $proposal->domain }}</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Project Title:</span>
                        <span class="col-span-3"> {{ $proposal->title }}</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Description:</span>
                        <span class="col-span-3">{{ $proposal->description }}</span>
                    </div>

                </div>
            </div>
            
        @endif
    </div>
</x-frontend.student.layouts.master>
