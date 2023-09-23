<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Proposal Details </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('supervisor.dashboard')}}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Proposal List</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Details</a>
                </li>
            </ol>
        </div>
        {{-- Details --}}
        @if (session('error'))
                <div
                    class="max-w-3xl mx-auto bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            {{ session('error') }}
                        </div>
                        <button type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            data-dismiss="alert" aria-label="Close"
                            onclick="this.parentElement.parentElement.style.display='none'">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        <h2
            class="p-3 leading-tight text-blue-700 bg-blue-100  dark:bg-blue-700 dark:text-blue-100 font-bold text-center ">
            Project Proposal</h2>
        <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Project Title:</span>
                    <span class="col-span-2"> {{ $proposal->title }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Course:</span>
                    <span class="col-span-2"> {{ $proposal->course }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Project Type:</span>
                    <span class="col-span-2">{{ ucfirst($proposal->project_type) }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Domain:</span>
                    <span class="col-span-2">{{ $proposal->domain }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Description:</span>
                    <span class="col-span-2">{{ $proposal->description }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Group Name:</span>
                    <span class="col-span-2">{{ $group->name }}</span>
                </div>
                <div class="mb-4 flex justify-between">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Members:</span>
                    <span class="col-span-2 text-gray-400">
                        Requested at: {{ \Carbon\Carbon::parse($proposal->created_at)->addHours(6)->format('d-M-Y h:i A') }}
                    </span>
                </div>
                <div class="w-full mt-2 overflow-hidden rounded-lg shadow-xs">
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
                                @foreach ($members as $member)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">{{ $member->student->student_id }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">{{ $member->first_name }}
                                                    {{ $member->last_name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">{{ $member->email }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center space-x-4 mb-4">
            <form action="{{ route('supervisor.proposalResponse') }}" method="post">
                @csrf
                <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                <button type="submit" name="response" value="approved"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold mt-4 py-2 px-4 rounded-md">
                    Approve
                </button>
                <button type="submit" name="response" value="denied"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold mt-4 py-2 px-4 rounded-md">
                    Deny
                </button>
            </form>
            <a href="{{ route('supervisor.proposalSuggest', ['group_id' => $group->id, 'proposal_id' => $proposal->id]) }}" class="text-blue-500 dark:text-blue-500 underline text-md mt-4 py-2 px-4">Do you want to suggest something? </a>
        </div>
    </div>
</x-frontend.supervisor.layouts.master>
