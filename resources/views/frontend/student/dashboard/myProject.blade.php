<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            My Project </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.myProject') }}" class="text-gray-900 dark:text-white">My Project</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        @if ($members && $group)
            <div class="px-2 py-2 ">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 mb-5">
                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Project Title: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $project->title }}</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Description: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $project->description }}</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Domain: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $group->domain }}</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Project Type: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $group->project_type }}</span>
                        </div>
                    </div>
                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Supervisor: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white mr-2">{{ $supervisor->first_name.' '. $supervisor->last_name }}</span>
                            <a href="{{route('student.supervisorProfile', ['id' => $supervisor->id])}}">
                                <button
                                class="px-2 py-1 text-xs font-semibold leading-tight text-white bg-purple-400 shadow-lg rounded-full">
                                View Profile
                            </button></a>
                        </div>
                    </div>
                    <div class="flex flex-row items-center mb-2 space-x-4"> 
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Group Name: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $group->name }}</span>
                        </div>
                    </div>
                </div>


                <div class="w-full overflow-hidden rounded-lg shadow-xl mb-4">
                    <div class="w-full overflow-x-auto shadow-md">
                        <table class="w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Member</th>
                                    <th class="px-3 py-3">Email</th>
                                    <th class="px-3 py-3">Role</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y shadow dark:divide-gray-700 mb-3 dark:bg-gray-800">
                                @foreach ($members as $member)
                                    <tr class="text-gray-700 even:bg-gray-50 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    {{ $member->first_name . ' ' . $member->last_name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">{{ $member->email }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">dudbhat</p>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        @else
            <div class="flex justify-center h-screen ">
                <div class="text-center">
                    <h3 class="my-6">You don't have a group</h3>
                </div>
            </div>

        @endif
    </div>


</x-frontend.student.layouts.master>
