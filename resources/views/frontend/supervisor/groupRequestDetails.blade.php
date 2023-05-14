<x-frontend.supervisor.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Group Details</h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href=" {{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3"><a href="{{ route('supervisor.groupRequests') }}"
                        class="text-gray-900 dark:text-white">Request Groups</a></li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('supervisor.groupRequestDetails') }}" class="text-gray-900 dark:text-white"> Group
                        Details</a>
                </li>
            </ol>
        </div>
        <div class="flex md:w-full space-x-4">
            <div class="md:w-2/4">
                <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Group Name:</label>
                <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <p class="text-md text-gray-600 dark:text-gray-400">
                        {{ $group->name }}

                    </p>
                </div>
            </div>
            <div class="md:w-2/4">
                <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Domain:</label>
                <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <p class="text-md text-gray-600 dark:text-gray-400">
                        {{ $proposal->domain }}
                    </p>
                </div>
            </div>

        </div>

        <div class="md:w-full">
            <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Topic:</label>
            <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <p class="text-md text-gray-600 dark:text-gray-400">
                    {{ $proposal->title }}
                </p>
            </div>
        </div>
        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Members</th>
                                <th class="px-3 py-3">ID</th>
                                <th class="px-3 py-3">Batch</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($group->group_members as $group_member)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $group_member->name }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $group_member->student_ID }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $group_member->batch }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-x-2">
                <a href="#">
                    <button type="button"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded-sm hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Approve
                    </button>
                </a>

                <a href="{{ route('supervisor.rejectedGroups', ['id' => $proposal->id]) }}">
                    <button
                        class="px-4 py-2 font-bold text-white bg-red-500 rounded-sm hover:bg-red-700 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Deny
                    </button>
                </a>
            </div>


        </div>

    </div>


</x-frontend.supervisor.layouts.master>
