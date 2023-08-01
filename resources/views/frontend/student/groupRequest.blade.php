<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            My Group </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.groupRequest') }}" class="text-gray-900 dark:text-white">Requests</a>
                </li>
            </ol>
        </div>
        
        
        
        




        {{-- table --}}
        <div class="px-2 py-2 ">
            <div class="bg-white rounded-lg shadow-md p-6 mb-3">
                <div class="flex flex-row items-center mb-4 space-x-4">
                    <div class="flex-shrink-0 w-1/3">
                        <label class="text-md font-bold text-gray-700">Group Name: </label>
                    </div>
                    <div class="w-2/3">
                        <span class="text-sm font-semibold">{{ $pending_group->name }}</span>
                    </div>
                </div>
            
                <div class="flex flex-row items-center mb-4 space-x-4">
                    <div class="flex-shrink-0 w-1/3">
                        <label class="text-md font-bold text-gray-700">Domain: </label>
                    </div>
                    <div class="w-2/3">
                        <span class="text-sm font-semibold">{{ $pending_group->domain }}</span>
                    </div>
                </div>
            
                <div class="flex flex-row items-center mb-4 space-x-4">
                    <div class="flex-shrink-0 w-1/3">
                        <label class="text-md font-bold text-gray-700">Project Type: </label>
                    </div>
                    <div class="w-2/3">
                        <span class="text-sm font-semibold">{{ $pending_group->project_type }}</span>
                    </div>
                </div>
            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Member</th>
                                <th class="px-3 py-3">Email</th>
                                <th class="px-3 py-3">Info</th>
                            </tr>
                        </thead>
                        {{-- @php
                           {{ $pending_group->members }}
                       @endphp --}}
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($users as $member)
                                <tr class="text-gray-700 dark:text-gray-400">
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

                                    <td class="px-4 py-3 text-xs">
                                        <a href="#">
                                            <button
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Details
                                            </button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</x-frontend.student.layouts.master>
