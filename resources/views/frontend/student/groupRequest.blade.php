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

        @if (session('message'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        {{ session('message') }}
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
        @if (session('error'))
            <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-red-500 rounded-full flex-shrink-0"></div>
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
        {{-- table --}}
        @if ($pending_group && $users && $invitation)
            <div class="px-2 py-2 ">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-3">
                    <div class="flex flex-row items-center mb-2 space-x-4"> <!-- Adjusted the mb-4 to mb-2 -->
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Group Name: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $pending_group->name }}</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> <!-- Adjusted the mb-4 to mb-2 -->
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Domain: </label>
                        </div>
                        <div class="w-2/6">
                            <span class="text-sm font-semibold dark:text-white">{{ $pending_group->domain }}</span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center mb-2 space-x-4"> <!-- Adjusted the mb-4 to mb-2 -->
                        <div class="flex-shrink-0 w-1/6">
                            <label class="text-md font-bold text-gray-700 dark:text-white">Project Type: </label>
                        </div>
                        <div class="w-2/6">
                            <span
                                class="text-sm font-semibold dark:text-white">{{ $pending_group->project_type }}</span>
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

                                            @if ($member->groupInvitation->status == 0 && $loggedInStudent->id != $member->id)
                                                <a href="#">
                                                    <button
                                                        class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                                        Pending
                                                    </button>
                                                </a>
                                            @elseif ($member->groupInvitation->status == 1 && $loggedInStudent->id != $member->id)
                                                <a href="#">
                                                    <button
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                        Accepted
                                                    </button>
                                                </a>
                                            @elseif ($member->groupInvitation->status == 2 && $loggedInStudent->id != $member->id)
                                                <a href="#">
                                                    <button
                                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                        Rejected
                                                    </button>
                                                </a>
                                            @elseif ($loggedInStudent->id === $member->id)
                                                @if ($member->groupInvitation->status == 1)
                                                    <a href="#">
                                                        <button
                                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                            Accepted
                                                        </button>
                                                    </a>
                                                @elseif ($member->groupInvitation->status == 2)
                                                    <a href="#">
                                                        <button
                                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                            Rejected
                                                        </button>
                                                    </a>
                                                @elseif ($member->groupInvitation->status == 0)
                                                    <form
                                                        action="{{ route('student.groupRequestResponse', ['invitation' => $member->groupInvitation]) }}"
                                                        method="POST">
                                                        @csrf
                                                        {{-- <input type="hidden" name="user_id"
                                                            value="{{ $member->id }}"> --}}
                                                        <input type="hidden" name="pending_group_id"
                                                            value="{{ $pending_group->id }}">
                                                        <a href="#">
                                                            <button type="submit" name="response" value="1"
                                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                                Accept
                                                            </button>
                                                        </a>
                                                        <a href="#">
                                                            <button type="submit" name="response" value="2"
                                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                                Reject
                                                            </button>
                                                        </a>
                                                    </form>
                                                
                                                @endif
                                            @endif
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
                    <h3 class="my-6">No Requests</h3>
                </div>
            </div>

        @endif
    </div>

</x-frontend.student.layouts.master>
