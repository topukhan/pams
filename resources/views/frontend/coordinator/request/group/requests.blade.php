<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('coordinator.requests') }}" class="text-gray-900 dark:text-white">Requests</a>
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
        @if (count($requests) != 0)
            <div class="px-2 py-2">
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto shadow-lg">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Type</th>
                                    <th class="px-3 py-3">Request For</th>
                                    <th class="px-3 py-3">Description</th>
                                    <th class="px-3 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($requests as $request)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">{{ $serialOffset + $loop->index + 1 }}</td>
                                        @if ($request->group_id != null)
                                            <td class="px-4 py-3">
                                                <span
                                                    class="px-2 py-1 text-sm font-semibold leading-tight text-violet-600 bg-violet-100 rounded-sm dark:bg-violet-700 dark:text-violet-100">
                                                    Group Request
                                                </span>
                                            </td>
                                        @elseif ($request->user_id != null)
                                            <td class="px-4 py-3">
                                                <span
                                                    class="px-2 py-1 text-sm font-semibold leading-tight text-yellow-600 bg-yellow-100 rounded-sm dark:bg-yellow-700 dark:text-yellow-100">
                                                    Individual Request
                                                </span>
                                            </td>
                                        @else
                                        @endif
                                        <td class="px-4 py-3">
                                            <span
                                                class="px-2 py-1 text-sm font-semibold leading-tight text-sky-700 bg-sky-100 rounded-full dark:bg-sky-700 dark:text-sky-200">
                                                {{ $request->reason }}
                                            </span>

                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ ucfirst($request->shortNote) }}
                                        </td>

                                        <td class="px-4 py-3 text-xs ">
                                            @if ($request->user_id != null)
                                                <a href="{{ route('coordinator.requestDetails', $request->id) }}">
                                                    <button
                                                        class="px-2 py-1 font-semibold text-base align-middle leading-tight text-yellow-600 bg-yellow-100 rounded-md dark:bg-yellow-700 dark:text-yellow-100 hover:bg-yellow-200">
                                                        details
                                                    </button>
                                                </a>
                                            @endif
                                            @if ($request->group_id != null)
                                                <a
                                                    href="{{ route('coordinator.requestGroupMembersDetails', ['group' => $request->group_id, 'request' => $request->id]) }}">
                                                    <button
                                                        class="px-2 py-1 font-semibold text-base align-middle leading-tight text-violet-600 bg-violet-100 rounded-md dark:bg-violet-700 dark:text-violet-100 hover:bg-violet-200">
                                                        details
                                                    </button>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mx-4 my-2">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>

            </div>
        @else
            <h1 style='text-align:center'>No Requests Yet!</h1>
        @endif
    </div>
</x-frontend.coordinator.layouts.master>
