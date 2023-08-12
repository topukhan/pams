<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Group Details </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">Group Members Details</a>
                </li>
            </ol>
        </div>
        {{-- table --}}

        <div class="px-2 py-2 ">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-3">
                <div class="flex flex-row items-center mb-2 space-x-4">
                    <div class="flex-shrink-0 w-1/6">
                        <label class="text-md font-bold text-gray-700 dark:text-white">Domain: </label>
                    </div>
                    <div class="w-2/6">
                        <span class="text-sm font-semibold dark:text-white"> {{ $group->domain }} </span>
                    </div>
                </div>

                <div class="flex flex-row items-center mb-2 space-x-4">
                    <div class="flex-shrink-0 w-1/6">
                        <label class="text-md font-bold text-gray-700 dark:text-white">Project Type: </label>
                    </div>
                    <div class="w-2/6">
                        <span class="text-sm font-semibold dark:text-white"> {{ $group->project_type }} </span>
                    </div>
                </div>

                <div class="flex flex-row items-center mb-2 space-x-4">
                    <div class="flex-shrink-0 w-1/6">
                        <label class="text-md font-bold text-gray-700 dark:text-white">Reason: </label>
                    </div>
                    <div class="w-2/6">
                        <span class="text-sm bg-blue-100 py-1 px-1 rounded-md font-semibold dark:text-white">
                            {{ $request->reason }} </span>
                    </div>
                </div>
                <div class="flex flex-row items-center mb-2 space-x-4">
                    <div class="flex-shrink-0 w-1/6">
                        <label class="text-md font-bold text-gray-700 dark:text-white">Description: </label>
                    </div>
                    <div class="w-2/6">
                        <span class="text-sm font-semibold dark:text-white"> {{ $request->note }} </span>
                    </div>
                </div>


            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-md">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Student ID</th>
                                <th class="px-3 py-3">Name</th>
                                <th class="px-3 py-3">Email</th>

                            </tr>
                        </thead>
                        <tbody id="groupMembersTableBody"
                            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($groupMembers as $groupMember)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">{{ $groupMember->student_id }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">
                                                {{ $groupMember->user->first_name . ' ' . $groupMember->user->last_name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">{{ $groupMember->user->email }}</p>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            @if (count($students) > 0)
                <div class="flex justify-start h-4 items-center bg-gray-200 dark:bg-gray-800 mt-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Available Students</h3>
                </div>
                <form action="{{ route('coordinator.requestedStudentAddToGroup') }}" method="POST">
                    @csrf
                    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-2">
                        <div class="w-full overflow-x-auto shadow-md">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-3 py-3">Sl</th>
                                        <th class="px-3 py-3">Student ID</th>
                                        <th class="px-3 py-3">Name</th>
                                        <th class="px-3 py-3">Project Type</th>
                                        <th class="px-3 py-3">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="groupMembersTableBody"
                                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($students as $student)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <p class="font-semibold">{{ $student->student_id }}</p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <p class="font-semibold">
                                                        {{ $student->user->first_name . ' ' . $student->user->last_name }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($student->project_type != null)
                                                    <div class="flex items-center text-sm">
                                                        <p class="font-semibold">{{ $student->project_type }}</p>
                                                    </div>
                                                @else
                                                    <div class="flex items-center text-sm">
                                                        <p class="font-semibold">N/A</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600"
                                                        value="{{ $student->user_id }}" name="user_id[]">
                                                </div>
                                            </td>
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <input type="hidden" name="request_id" value="{{ $request->id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-lg text-white font-bold mt-4 py-1 px-3 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            @else
                {{-- If no member is available then merge the group with suitable one --}}
                <div>
                    <p>No Members Available</p>
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-2 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.formedGroupsLists', $request->id) }}">Groups</a>
                    </button>
                </div>
            @endif
        </div>

    </div>

</x-frontend.coordinator.layouts.master>
