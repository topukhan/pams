<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notice List</h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.noticeList') }}" class="text-gray-900 dark:text-white">Notices</a>
                </li>
            </ol>
        </div>

        <div class="px-2 py-2 ">

            @if (count($notices) > 0 or count($filtered_notices) > 0)
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xl">
                    <div class="w-full overflow-x-auto shadow-lg">
                        <table class="w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Notice</th>
                                    <th class="px-3 py-3">Details</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if ($filtered_notices->count() > 0)
                                    @php
                                        $filtered_notices = $filtered_notices->reverse(); // Reverse the order of the notices array
                                    @endphp
                                    @foreach ($filtered_notices as $notice)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <p class="font-semibold">
                                                        @php
                                                            echo $notice->title . ' <span class="text-xs text-gray-400">(Coordinator)</span>';
                                                        @endphp
                                                    </p>
                                                </div>
                                            </td>

                                            <td class="px-4 py-3 text-xs">
                                                <a class="my-2"
                                                    href="{{ route('student.notice', ['notice_id' => $notice->id]) }}">
                                                    <button
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                        View
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $loop_index = $loop->iteration;
                                        @endphp
                                    @endforeach
                                @endif

                                @foreach ($notices as $notice)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            @if (isset($loop_index))
                                                {{ ++$loop_index }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif

                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold">
                                                    @php
                                                        echo $notice->notice;
                                                    @endphp
                                                </p>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-xs">
                                            <a href="{{ route('student.notice', ['notice_id' => $notice->id]) }}">

                                                <button
                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                    view
                                                </button></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @else
                    <div class="flex justify-center h-screen ">
                        <div class="text-center">
                            <h3 class="my-6 text-gray-600">No Notice</h3>
                        </div>
                    </div>
                </div>
            @endif
</x-frontend.student.layouts.master>
