<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Evaluation </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">Evaluation</a>
                </li>
            </ol>
        </div>
        @if (session('message'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        {{ strtoupper(session('message')) }}
                    </div>
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        data-dismiss="alert" aria-label="Close"
                        onclick="this.parentElement.parentElement.style.display='none'">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                        {{ strtoupper(session('error')) }}
                    </div>
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        data-dismiss="alert" aria-label="Close"
                        onclick="this.parentElement.parentElement.style.display='none'">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- validation error messages  --}}
        <div class="p-2 mx-2">
            @if ($errors->any())
                <ul class="text-red-600 text mt-2">
                    <span class="text-red-600 text-2xl">Please, Enter Valid Marks.</span>
                    @php
                        $index = 1; // Initialize the index variable with 1
                        $currentAttribute = ''; // Initialize the current attribute
                        $errorMessages = []; // Initialize an array to store error messages for the same attribute
                    @endphp
                    @foreach ($errors->all() as $error)
                        @php
                            // Extract the attribute name and index from the error message
                            preg_match('/^(.*?)\.(.*?)\s(.*?)$/', $error, $matches);
                            if (count($matches) === 4) {
                                $attribute = $matches[1];
                                $indexMessage = $matches[2] + 1; // Add 1 to the index
                                $errorMessage = $matches[3]; // Use the original error message
                            } else {
                                // If not, display the error as it is
                                $attribute = '';
                                $indexMessage = '';
                                $errorMessage = $error; // Use the original error message
                            }
                            // Check if the current attribute matches the new one
                            if ($attribute === $currentAttribute) {
                                // If they match, add the error message to the array
                                $errorMessages[] = " $attribute - $indexMessage $errorMessage";
                            } else {
                                if (!empty($errorMessages)) {
                                    echo '<li class="bg-gray-100 mx-1 my-1 p-1 rounded-sm">' . implode(' || ', $errorMessages) . '</li>';
                                    $errorMessages = [];
                                }
                                // Set the new current attribute and add the error message to the array
                                $currentAttribute = $attribute;
                                $errorMessages[] = " $attribute - $indexMessage $errorMessage";
                            }
                        @endphp
                    @endforeach
                    {{-- Display any remaining error messages if they exist --}}
                    @if (!empty($errorMessages))
                        <li class="bg-gray-100 mx-1 my-1 p-1 rounded-sm">{{ implode(' || ', $errorMessages) }}</li>
                    @endif
                </ul>
            @endif
        </div>

        {{-- Toggle buttons --}}
        <div class="flex space-x-4">
            {{-- PHASE I --}}
            <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
                <div class="bg-lime-200 hover:bg-lime-300 rounded-md text-center py-2 text-gray-800 shadow-sm cursor-pointer"
                    id="phase1Section">
                    <span class="px-2 text-lg font-bold font-mono">PHASE-I</span>
                </div>
            </div>
            {{-- PHASE II --}}
            <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
                <div class="bg-lime-200 hover:bg-lime-300 rounded-md text-center py-2 text-gray-800 shadow-sm cursor-pointer "
                    id="phase2Section">
                    <span class="px-2 text-lg font-bold font-mono">PHASE-II</span>
                </div>
            </div>
            {{-- PHASE III --}}
            <div class="w-full overflow-hidden rounded-lg shadow-xs  mb-6">
                <div class="bg-lime-200 hover:bg-lime-300 rounded-md text-center py-2 text-gray-800 shadow-sm cursor-pointer"
                    id="phase3Section">
                    <span class="px-2 text-lg font-bold font-mono">PHASE-III</span>
                </div>
            </div>
        </div>

        {{-- phase1 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs" id="phase1Table" style="display: none;">
                <form action="{{ route('supervisor.phase1Store') }}" method="post" id="phase1">
                    @csrf
                    {{-- project ID pass --}}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="bg-gray-100 rounded-md text-center shadow-sm">
                        <div class="shadow-xs overflow-x-auto w-[159vh]">
                            <table class="whitespace-no-wrap table-auto">
                                <thead> <span class="text-xl font-semibold font-mono">Phase-I Marks</span>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-3 py-3 whitespace-normal text-center">Student ID</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Name</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Email</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Title</th>
                                        {{-- <th class="px-3 py-3 whitespace-normal text-center">Supervisor</th> --}}
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 1 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 2 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 3 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner Average (40)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Attendance (10)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Development (30)
                                        </th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Report Preparation (20)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Total (100)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($members as $index => $member)
                                        <input type="hidden" name="user_id[]" value="{{ $member->id }}">
                                        <tr class="text-gray-700 dark:text-gray-400 text-center">
                                            <td class="px-4 py-3 text-sm text-center font-semibold">
                                                {{ $member->student->student_id }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->first_name . ' ' . $member->last_name }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->email }}
                                            </td>

                                            @if ($index === 0)
                                                <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                    rowspan="{{ count($members) }}">{{ $project->title }}</td>
                                                {{-- <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                            rowspan="{{ count($members) }}">
                                            {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                        </td> --}}
                                            @endif
                                            <td>
                                                @php
                                                    // Find the corresponding phase1 data for the current member by user_id
                                                    $phase1Data = $phase1_marks->firstWhere('user_id', $member->id);
                                                @endphp
                                                <input name="examiner_1_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->examiner_1_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>

                                            <td>
                                                <input name="examiner_2_mark[]"
                                                    class="bg-gray-100 py-2 m-1  examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->examiner_2_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_3_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->examiner_3_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_average[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-average border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->examiner_average, 2)) : '' }}"
                                                    readonly>
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="attendance[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->attendance, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="project_development[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->project_development, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="report_preparation[]"
                                                    class=" bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->report_preparation, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="total[]"
                                                    class="bg-gray-100 py-2 m-1 total-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" readonly step="any"
                                                    value="{{ $phase1Data ? preg_replace('/\.?0*$/', '', number_format($phase1Data->total, 2)) : '' }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div
                        class="flex justify-end mb-4 {{ count($members) == count($phase1_marks) && !$phase3_marks->isEmpty() ? 'hidden' : '' }}">
                        <button type="submit"
                            class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-3 px-6 mt-4 rounded-md text-sm mx-12">
                            Grade
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- phase2 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs " id="phase2Table" style="display: none;">
                <form action="{{ route('supervisor.phase2Store') }}" method="post" id="phase2">
                    @csrf
                    {{-- project ID pass --}}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="bg-gray-100 rounded-md text-center shadow-sm">
                        <div class="shadow-xs overflow-x-auto w-[159vh]">
                            <table class="whitespace-no-wrap table-auto">
                                <thead> <span class="text-xl font-semibold font-mono">Phase-II Marks</span>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-3 py-3 whitespace-normal text-center">Student ID</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Name</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Email</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Title</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Supervisor</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 1 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 2 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 3 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner Average (40)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Attendance (10)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Development (30)
                                        </th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Report Preparation (20)
                                        </th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Total (100)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($members as $index => $member)
                                        <input type="hidden" name="user_id[]" value="{{ $member->id }}">
                                        <tr class="text-gray-700 dark:text-gray-400 text-center">
                                            <td class="px-4 py-3 text-sm text-center font-semibold">
                                                {{ $member->student->student_id }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->first_name . ' ' . $member->last_name }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->email }}
                                            </td>

                                            @if ($index === 0)
                                                <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                    rowspan="{{ count($members) }}">{{ $project->title }}</td>
                                                <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                    rowspan="{{ count($members) }}">
                                                    {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                                </td>
                                            @endif
                                            <td>
                                                @php
                                                    // Find the corresponding phase1 data for the current member by user_id
                                                    $phase2Data = $phase2_marks->firstWhere('user_id', $member->id);
                                                @endphp
                                                <input name="examiner_1_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->examiner_1_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>

                                            <td>
                                                <input name="examiner_2_mark[]"
                                                    class="bg-gray-100 py-2 m-1  examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->examiner_2_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_3_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->examiner_3_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_average[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-average border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->examiner_average, 2)) : '' }}"
                                                    readonly>
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="attendance[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->attendance, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="project_development[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->project_development, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="report_preparation[]"
                                                    class=" bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->report_preparation, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="total[]"
                                                    class="bg-gray-100 py-2 m-1 total-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" readonly step="any"
                                                    value="{{ $phase2Data ? preg_replace('/\.?0*$/', '', number_format($phase2Data->total, 2)) : '' }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div
                        class="flex justify-end mb-4 {{ count($members) == count($phase2_marks) && !$phase3_marks->isEmpty() ? 'hidden' : '' }}">
                        <button type="submit"
                            class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-3 px-6 mt-4 rounded-md text-sm mx-12">
                            Grade
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- phase3 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs " id="phase3Table" style="display: none;">
                <form action="{{ route('supervisor.phase3Store') }}" method="post" id="phase3">
                    @csrf
                    {{-- project ID pass --}}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="bg-gray-100 rounded-md text-center shadow-sm">
                        <div class="shadow-xs overflow-x-auto w-[159vh]">
                            <table class="whitespace-no-wrap table-auto">
                                <thead> <span class="text-xl font-semibold font-mono">Phase-III Marks</span>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-3 py-3 whitespace-normal text-center">Student ID</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Name</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Email</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Title</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Supervisor</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 1 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 2 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner 3 Mark (100)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Examiner Average (40)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Attendance (10)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Project Development (30)
                                        </th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Report Preparation (20)
                                        </th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Total (100)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($members as $index => $member)
                                        <input type="hidden" name="user_id[]" value="{{ $member->id }}">
                                        <tr class="text-gray-700 dark:text-gray-400 text-center">
                                            <td class="px-4 py-3 text-sm text-center font-semibold">
                                                {{ $member->student->student_id }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->first_name . ' ' . $member->last_name }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->email }}
                                            </td>

                                            @if ($index === 0)
                                                <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                    rowspan="{{ count($members) }}">{{ $project->title }}</td>
                                                <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                    rowspan="{{ count($members) }}">
                                                    {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                                </td>
                                            @endif
                                            <td>
                                                @php
                                                    // Find the corresponding phase1 data for the current member by user_id
                                                    $phase3Data = $phase3_marks->firstWhere('user_id', $member->id);
                                                @endphp
                                                <input name="examiner_1_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->examiner_1_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>

                                            <td>
                                                <input name="examiner_2_mark[]"
                                                    class="bg-gray-100 py-2 m-1  examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->examiner_2_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_3_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->examiner_3_mark, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="examiner_average[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-average border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->examiner_average, 2)) : '' }}"
                                                    readonly>
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="attendance[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->attendance, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="project_development[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->project_development, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="report_preparation[]"
                                                    class=" bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->report_preparation, 2)) : '' }}"
                                                    data-tippy-content="" data-tippy-trigger="manual">
                                                <p class="text-red-600 text-sm mt-2 error-message hidden"></p>
                                            </td>
                                            <td>
                                                <input name="total[]"
                                                    class="bg-gray-100 py-2 m-1 total-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" readonly step="any"
                                                    value="{{ $phase3Data ? preg_replace('/\.?0*$/', '', number_format($phase3Data->total, 2)) : '' }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="flex justify-end mb-4 {{ count($members) == count($phase3_marks) ? 'hidden' : '' }}">
                        <button type="submit"
                            class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-3 px-6 mt-4 rounded-md text-sm mx-12">
                            Grade
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- View results toggle buttons --}}
        @if (!$phase3_marks->isEmpty())
            <div class="">
                <span class="text-2xl dark:text-gray-300 font-semibold text-gray-700 ">View Results Here</span>
                {{-- toggle buttons --}}
                <div class="flex space-x-4 my-4">
                    {{-- Project I toggle --}}
                    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
                        <div class="bg-lime-200 hover:bg-lime-300 rounded-md text-center py-2 text-gray-800 shadow-sm cursor-pointer"
                            id="project1Section">
                            <span class="px-2 text-lg font-bold font-mono">PROJECT-I</span>
                        </div>
                    </div>
                    {{-- Project II toggle --}}
                    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
                        <div class="bg-lime-200 hover:bg-lime-300 rounded-md text-center py-2 text-gray-800 shadow-sm cursor-pointer "
                            id="project2Section">
                            <span class="px-2 text-lg font-bold font-mono">PROJECT-II</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center space-x-4 my-4">
                    {{-- project 1 --}}
                    <div class="my-3">
                        <div class="w-full overflow-hidden rounded-lg shadow-xs " id="project1Table"
                            style="display: none;">
                            <div class="bg-gray-100 rounded-md text-center shadow-sm pb-3">
                                <div class="shadow-xs  w-full">
                                    <table class=" table-auto">
                                        <thead> <span class="text-xl font-semibold font-mono">PROJECT-I Results</span>
                                            <tr
                                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-3 py-3 whitespace-normal text-center">Student ID</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Name</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Email</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Project Title</th>
                                                {{-- <th class="px-3 py-3 whitespace-normal text-center">Supervisor</th> --}}

                                                <th class="px-3 py-3 whitespace-normal text-center">Marks (100)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            @foreach ($members as $index => $member)
                                                <input type="hidden" name="user_id[]" value="{{ $member->id }}">
                                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                                    <td class="px-4 py-3 text-sm text-center font-semibold">
                                                        {{ $member->student->student_id }}
                                                    </td>

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ $member->first_name . ' ' . $member->last_name }}
                                                    </td>

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ $member->email }}
                                                    </td>

                                                    @if ($index === 0)
                                                        <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                            rowspan="{{ count($members) }}">{{ $project->title }}
                                                        </td>
                                                        {{-- <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                    rowspan="{{ count($members) }}">
                                                    {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                                </td> --}}
                                                    @endif

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ array_key_exists($member->id, $project1_marks) ? preg_replace('/\.?0*$/', '', number_format($project1_marks[$member->id], 2)) : 'No result found' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- project 2 --}}
                    <div class="my-3">
                        <div class="w-full overflow-hidden rounded-lg shadow-xs " id="project2Table"
                            style="display: none;">
                            <div class="bg-gray-100 rounded-md text-center shadow-sm pb-3">
                                <div class="shadow-xs  w-full">
                                    <table class=" table-auto">
                                        <thead> <span class="text-xl font-semibold font-mono">PROJECT-II Results</span>
                                            <tr
                                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-3 py-3 whitespace-normal text-center">Student ID</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Name</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Email</th>
                                                <th class="px-3 py-3 whitespace-normal text-center">Project Title</th>
                                                {{-- <th class="px-3 py-3 whitespace-normal text-center">Supervisor</th> --}}

                                                <th class="px-3 py-3 whitespace-normal text-center">Marks (100)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            @foreach ($members as $index => $member)
                                                <input type="hidden" name="user_id[]" value="{{ $member->id }}">
                                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                                    <td class="px-4 py-3 text-sm text-center font-semibold">
                                                        {{ $member->student->student_id }}
                                                    </td>

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ $member->first_name . ' ' . $member->last_name }}
                                                    </td>

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ $member->email }}
                                                    </td>

                                                    @if ($index === 0)
                                                        <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                            rowspan="{{ count($members) }}">{{ $project->title }}
                                                        </td>
                                                        {{-- <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                    rowspan="{{ count($members) }}">
                                                    {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                                </td> --}}
                                                    @endif
                                                    @php
                                                        // Find the corresponding project2 data for the current member by user_id
                                                        $project2Data = $phase3_marks->firstWhere('user_id', $member->id);
                                                    @endphp

                                                    <td class="px-4 py-3 text-sm font-semibold text-center">
                                                        {{ $project2Data ? preg_replace('/\.?0*$/', '', number_format($project2Data->total, 2)) : 'No result found' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    
    <script src="{{ asset('ui/frontend/js/evaluation/evaluation.js') }}"></script>

</x-frontend.supervisor.layouts.master>
