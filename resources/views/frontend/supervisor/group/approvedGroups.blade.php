<x-frontend.supervisor.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('supervisor.groupRequests') }}" class="text-gray-900 dark:text-white">Approved Groups</a>
                </li>
            </ol>
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible " role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Group Name</th>
                                <th class="px-3 py-3">Domain</th>
                                <th class="px-3 py-3">Info</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($approved_groups as $approved)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">
                                                 {{ $approved->group->name }}
                                                </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $approved->domain }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <a
                                            href="{{ route('supervisor.approvedGroupDetails', ['group_id' => $approved->group->id, 'approved_id' => $approved->id]) }}">
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


</x-frontend.supervisor.layouts.master>
