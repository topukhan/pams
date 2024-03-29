<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Project Reports </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href=" {{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Project Reports</a>
                </li>
            </ol>
        </div>


        {{-- table --}}
        <div class="px-2 py-2 overflow-x-auto">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    @if ($project_reports->count() != 0)


                        <table class="w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3">Sl</th>
                                    <th class="px-3 py-3">Project Title</th>
                                    <th class="px-3 py-3">Domain</th>
                                    <th class="px-3 py-3">Report Title</th>
                                    <th class="px-3 py-3">Action</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($projects as $project)
                                    @php
                                        $project_reports = $project_reports->reverse();
                                    @endphp
                                    @foreach ($project_reports as $report)
                                        @if ($project->id == $report->project_id)
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3 text-sm font-semibold">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm font-semibold">
                                                       
                                                        {{ strtoupper(substr($project->title, 0, 31)) }}...</p>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm font-semibold">
                                                        {{ strtoupper($project->domain) }}</p>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm font-semibold">
                                                        {{ strtoupper($report->title) }}</p>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <a
                                                        href="{{ route('supervisor.projectReportDetails', ['project_report' => $report->id]) }} ">
                                                        <button
                                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                            Details
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
            @if (count($project_reports) == 0)
                <div
                    class="mb-4 p-4  hover:bg-gray-100 bg-gray-50 rounded shadow-xl dark:bg-gray-700 dark:hover:bg-gray-800 transition duration-200 ease-in-out flex items-center justify-center">
                    <p class="text-xl p-2 font-medium text-gray-700 dark:text-gray-400 text-center ">
                        NO REPORTS AT THIS MOMENT</p>
                </div>
            @endif

        </div>
    </div>


</x-frontend.supervisor.layouts.master>
