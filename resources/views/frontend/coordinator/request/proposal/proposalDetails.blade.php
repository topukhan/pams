<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Proposal Details </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Proposals </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Details</a>
                </li>
            </ol>
        </div>
        {{-- Details --}}
        <h2
            class="p-3 leading-tight text-blue-700 bg-blue-100  dark:bg-blue-700 dark:text-blue-100 font-bold text-center ">
            Project Proposal</h2>
        @if ($propose_again and !$propose_again->isEmpty())
            <div class="bg-violet-100 container mx-auto mt-4 p-4 shadow-md  rounded-md ">
                <div class="grid grid-cols-3 gap-4 mb-2">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Old Title:</span>
                    <span class="col-span-2"> {{ $propose_again->old_title }}</span>
                </div>
                @if (!$same_supervisor)
                    <div class="grid grid-cols-3 gap-4  mb-2">
                        <span class="text-gray-700 font-bold  mb-2 col-span-1">Previous Supervisor:</span>
                        <span class="col-span-2"> {{ $old_supervisor->first_name . ' ' . $old_supervisor->last_name }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-700 font-bold col-span-1">Reason:</span>
                    <span class="col-span-2">
                        <label for="title">Title Change</label>,
                        <label for="supervisor">Supervisor Change</label>
                    </span>
                </div>
            </div>
        @endif
        <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Supervisor Name:</span>
                    <span class="col-span-2"> {{ $supervisor->first_name . ' ' . $supervisor->last_name }}</span>
                </div>
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
        @if ($propose_again)
        <div class="flex justify-center space-x-5 mb-3">
            <form action="{{ route('coordinator.reProposalFeedback', $proposal) }}" method="POST">
                @csrf
                <button type="submit" name="response" value="1"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold mt-8 py-1 px-4 rounded-md">
                    Approve
                </button>
                <button type="submit" name="response" value="2"
                    class="bg-violet-500 hover:bg-violet-600 text-white font-bold mt-8 py-1 px-4 rounded-md">
                    Deny
                </button>
            </form>
        </div>
        @else
            <div class="flex justify-center space-x-5 mb-3">
            <form action="{{ route('coordinator.projectApprove', $proposal) }}" method="POST">
                @csrf
                <button type="submit" name="response" value="1"
                    class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-1 px-4 rounded-md">
                    Approve
                </button>
                <button type="submit" name="response" value="2"
                    class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-1 px-4 rounded-md">
                    Deny
                </button>
            </form>
        </div>
        @endif
        
    </div>
</x-frontend.coordinator.layouts.master>
