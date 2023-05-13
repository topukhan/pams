<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Genre and Supervisor Availabilty</h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="#" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.supervisor.availability') }}" class="text-gray-900 dark:text-white">Supervisor Availabilty</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Faculty Names</th>
                                <th class="px-3 py-3">Email</th>
                                <th class="px-3 py-3">Phone</th>
                                <th class="px-3 py-3">Interest/Genre</th>
                                <th class="px-3 py-3">Availability</th>
                                <th class="px-3 py-3">Proposal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            {{-- Supervisors  --}}

                            @foreach ($supervisors->sortByDesc('availability') as $supervisor)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">
                                        {{ $supervisor->user->first_name . ' ' . $supervisor->user->last_name }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $supervisor->user->email }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $supervisor->user->phone_number }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $supervisor->expertise_area }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">
                                        @php
                                            $yes = 'Yes';
                                            $no = 'No';
                                            if ($supervisor->availability == 1) {
                                                echo $yes;
                                            } else {
                                                echo $no;
                                            }
                                            
                                        @endphp
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        @if ($supervisor->availability == 1)
                                            <a href="{{ route('student.proposalForm', ['id' => $supervisor->id]) }}">
                                                <button
                                                    class="px-2 py-1 font-semibold leading-tight text-green-800 bg-green-200 rounded-full dark:bg-green-700 dark:text-green-200">
                                                    Request
                                                </button>
                                            </a>
                                        @endif
                                        @if ($supervisor->availability == 0)
                                            <a href="{{ route('student.proposalForm', ['id' => $supervisor->id]) }}">
                                                <button disabled
                                                    class="px-4 py-1 font-semibold leading-tight text-green-800 bg-red-200 rounded-full dark:bg-red-700 dark:text-green-200">
                                                    N/A
                                                </button>
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

        </table>
    </div>
    </div>

    </div>
    </div>


</x-frontend.student.layouts.master>
