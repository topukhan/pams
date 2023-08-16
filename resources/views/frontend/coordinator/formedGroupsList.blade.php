<x-frontend.coordinator.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Formed
                        Groups</a>
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
                                <th class="px-3 py-3">Domain</th>
                                <th class="px-3 py-3">Type</th>
                                <th class="px-3 py-3">No. of members</th>
                                <th class="px-3 py-3">Info</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($groups as $group)
                                @continue($group->id == $requestedGroupId)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">{{ $serialOffset + $loop->index + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">{{ $group->domain }} </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $group->project_type }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $group->groupMembers->count() }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        @if ($requestedGroupId !== null)
                                            <a href="#">
                                                <form action="{{ route('coordinator.transferGroupMembers') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="request_id" value="{{ $request_id }}">
                                                    <input type="hidden" name="requested_group_id"
                                                        value="{{ $requestedGroupId }}">
                                                    <input type="hidden" name="receiver_group_id"
                                                        value="{{ $group->id }}">
                                                    <button type="submit"
                                                        onclick="return confirm('Please Check For Domain and Project Type')"
                                                        class="py-2 px-3 font-bold text-md align-middle leading-tight text-violet-700 bg-violet-100  dark:bg-violet-700 dark:text-violet-100 rounded-md">
                                                        Merge
                                                    </button>
                                                </form>
                                            </a>
                                        @elseif ($id !== null)
                                            <a href="#">
                                                <form action="{{ route('coordinator.requestedStudentAddToGroup') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="request_id" value="{{ $request_id }}">
                                                    <input type="hidden" name="user_id" value="{{ $id }}">
                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="py-2 px-3 font-bold text-xl align-middle leading-tight text-violet-700 bg-violet-100  dark:bg-violet-700 dark:text-violet-100">
                                                        +
                                                    </button>
                                                </form>
                                            </a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-frontend.coordinator.layouts.master>
