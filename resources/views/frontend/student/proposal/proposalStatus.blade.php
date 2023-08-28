<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Proposal Status </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
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
        @if (session('message'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        {{ strtoupper(session('message')) }}
                    </div>
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        data-dismiss="alert" aria-label="Close"
                        onclick="this.parentElement.parentElement.style.display='none'">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        @if ($proposal)

            @if ($proposal->supervisor_feedback == 'suggestion')
                <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">

                            <span class="leading-tight text-green-600 font-bold">
                                Suggestion From
                                {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                            </span>
                        </div>
                        <button type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            data-dismiss="alert" aria-label="Close"
                            onclick="this.parentElement.parentElement.style.display='none'">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
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
                        @elseif ($proposal->supervisor_feedback == 'suggestion')
                            <div class="relative top-1/4  w-full bg-green-100 text-gray-700 px-4 py-4 rounded-lg shadow"
                                id="alert">
                                <span class=" leading-tight text-blue-700 font-bold ">
                                    Suggestion:
                                </span>
                                <span class="text-md">
                                    {{ $proposal_feedback->suggestion }}
                                </span>


                                <div class="flex justify-end space-x-4">
                                    <form action="{{ route('student.proposalDelete') }}" method="post"
                                        class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">

                                        <a href="{{ route('student.editProposalForm', $proposal->id) }}" type="submit"
                                            name="response"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-2 mt-2 rounded-md text-sm">
                                            Accept
                                        </a>
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-2 mt-2 rounded-md text-sm ml-2">
                                            Cancel
                                        </button>

                                    </form>
                                </div>


                            </div><br>
                        @elseif ($proposal->proposalFeedback->is_denied == 1)
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


                    </span>

                </div>
                <div class="p-4">
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Supervisor:</span>
                        <span
                            class="col-span-3 font-semibold">{{ ucfirst($supervisor->first_name) . ' ' . $supervisor->last_name }}</span>
                    </div>
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
        @elseif ($is_denied)
            <div class="relative top-1/4  w-full bg-red-200 text-red-700 px-4 py-4 rounded-lg shadow" id="alert">
                <span class=" leading-tight text-blue-700 font-bold ">
                    Status:
                </span>
                <span class="text-md">Supervisor <button
                        class="text-red-700 bg-red-100 px-2 py-1 rounded-full">Rejected</button>
                </span>
            </div><br>
            <div class="flex justify-center h-screen ">
                <div class="text-center">
                    <h3 class="my-6">Make Another Proposal</h3>
                </div>
            </div>
        @elseif ($in_project)
            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow" id="alert">
                Project already Allocated for your group!
                <button type="button"
                    class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                    onclick="this.parentElement.style.display ='none'">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
        @else
            <div class="flex justify-center h-screen ">
                <div class="text-center">
                    <h3 class="my-6">Make a Proposal First</h3>
                </div>
            </div>
        @endif
    </div>
</x-frontend.student.layouts.master>
