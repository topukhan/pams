<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Group Details</h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3"><a href="{{ route('student.myGroup') }}" class="hover:text-gray-900">My Group</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.myGroupDetails') }}" class="text-gray-900 dark:text-white">Group
                        Details</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
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
                            @foreach ($group_members as $group_member)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $group_member->name }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $group_member->student_id }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $group_member->batch }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <label for=""></label>
        </div>
        <h1 class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Topic:</h1>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ $group_member->group->topic }}
            </p>
        </div>

    </div>


</x-frontend.student.layouts.master>
