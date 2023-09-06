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
        {{-- phase1 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm cursor-pointer"
                    id="phase1Section">
                    <span class="px-2 text-lg font-bold ">PHASE I</span>
                </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs" id="phase1Table">
                <form action="{{ route('supervisor.evaluationStore') }}" method="post" id="phase1">
                    @csrf
                    {{-- project ID pass --}}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="bg-lime-200 rounded-md text-center shadow-sm">
                        <div class="shadow-xs overflow-x-auto w-[160vh]">
                            <table class="whitespace-no-wrap table-auto">
                                <thead>
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
                                        <th class="px-3 py-3 whitespace-normal text-center">Report Preparation (20)</th>
                                        <th class="px-3 py-3 whitespace-normal text-center">Total (100)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($members as $index => $member)
                                        <tr class="text-gray-700 dark:text-gray-400 text-center">
                                            <td class="px-4 py-3 text-sm text-center font-semibold">
                                                {{ $member->student->student_id }}</td>
                                            <td class="px-4 py-3 text-sm font-semibold text-center">
                                                {{ $member->first_name . ' ' . $member->last_name }}</td>
                                            <td class="px-4 py-3 text-sm font-semibold text-center">{{ $member->email }}
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
                                                <input name="examiner_1_mark[]"
                                                    class=" bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="50">
                                                {{-- <x-input-error :messages="$errors->get('examiner_1_mark')" class="mt-2"/> --}}
                                            </td>
                                            @error('examiner_1_mark.*')
                                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                            @enderror
                                            <td>
                                                <input name="examiner_2_mark[]"
                                                    class="bg-gray-100 py-2 m-1  examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="">
                                            </td>
                                            <td>
                                                <input name="examiner_3_mark[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="">
                                            </td>
                                            <td>
                                                <input name="examiner_average[]"
                                                    class="bg-gray-100 py-2 m-1 examiner-average border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="" readonly>
                                            </td>
                                            <td>
                                                <input name="attendance[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="">
                                            </td>
                                            <td>
                                                <input name="project_development[]"
                                                    class="bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="">
                                            </td>
                                            <td>
                                                <input name="report_preparation[]"
                                                    class=" bg-gray-100 py-2 m-1 border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" value="">
                                            </td>
                                            <td>
                                                <input name="total[]"
                                                    class="bg-gray-100 py-2 m-1 total-input border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                    type="number" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <button type="submit"
                            class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-2 px-2 mt-2 rounded-md text-sm ml-2">
                            Grade
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- phase2 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm cursor-pointer "
                    id="phase2Section">
                    <span class="px-2 text-lg font-bold">PHASE II</span>
                </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs " id="phase2Table" style="display: none;">
                <div class="bg-lime-200 rounded-md text-center shadow-sm">
                    <div class="shadow-xs overflow-x-auto w-[159vh]">
                        <table class="whitespace-no-wrap table-auto">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3 whitespace-normal  text-center">Student ID</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Name</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Email</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Project Title</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Supervisor</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 1 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 2 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 3 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner Average</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Attendance</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Project Development</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Report Preparation</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y  dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($members as $index => $member)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm text-center font-semibold">
                                            {{ $member->student->student_id }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold text-center">
                                            {{ $member->first_name . '' . $member->last_name }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold text-center">
                                            {{ $member->email }}
                                        </td>
                                        @if ($index === 0)
                                            <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                rowspan="4">{{ $project->title }}</td>
                                            <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                rowspan="4">
                                                {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                            </td>
                                        @endif
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="40"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="10"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="20"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="30"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="flex justify-end mb-4">
                    <button
                        class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-2 px-2 mt-2 rounded-md text-sm ml-2">
                        Grade
                    </button>
                </div>
            </div>
        </div>
        {{-- phase3 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs  mb-6">
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm cursor-pointer"
                    id="phase3Section">
                    <span class="px-2 text-lg font-bold">PHASE III</span>
                </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs " id="phase3Table" style="display: none;">
                <div class="bg-lime-200 rounded-md text-center shadow-sm">
                    <div class="shadow-xs overflow-x-auto w-[159vh]">
                        <table class="whitespace-no-wrap table-auto">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3 whitespace-normal  text-center">Student ID</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Name</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Email</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Project Title</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Supervisor</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 1 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 2 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 3 Mark</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner Average</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Attendance</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Project Development</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Report Preparation</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y  dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($members as $index => $member)
                                    <tr class="text-gray-700 dark:text-gray-400">

                                        <td class="px-4 py-3 text-sm text-center font-semibold">
                                            {{ $member->student->student_id }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold text-center">
                                            {{ $member->first_name . '' . $member->last_name }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold text-center">{{ $member->email }}
                                        </td>
                                        @if ($index === 0)
                                            <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold "
                                                rowspan="4">{{ $project->title }}</td>
                                            <td class="px-4 py-3 text-sm whitespace-normal text-center font-semibold"
                                                rowspan="4">
                                                {{ $supervisor->first_name . ' ' . $supervisor->last_name }}
                                            </td>
                                        @endif
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="40"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="10"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="20"></td>
                                        <td><input
                                                class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="30"></td>
                                        <td><input
                                                class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="flex justify-end mb-4">
                    <button
                        class="bg-lime-300 hover:bg-lime-400 text-gray-800 font-bold py-2 px-2 mt-2 rounded-md text-sm ml-2">
                        Grade
                    </button>
                </div>
            </div>
        </div>

        {{-- Toggle phases table --}}
        {{-- <script>
            // phase1
            const phase1Section = document.getElementById('phase1Section');
            const phase1Table = document.getElementById('phase1Table');

            phase1Section.addEventListener('click', () => {
                if (phase1Table.style.display === 'none') {
                    phase1Table.style.display = 'block';
                } else {
                    phase1Table.style.display = 'none';
                }
            });

            // phase2
            const phase2Section = document.getElementById('phase2Section');
            const phase2Table = document.getElementById('phase2Table');

            phase2Section.addEventListener('click', () => {
                if (phase2Table.style.display === 'none') {
                    phase2Table.style.display = 'block';
                } else {
                    phase2Table.style.display = 'none';
                }
            });

            // phase3
            const phase3Section = document.getElementById('phase3Section');
            const phase3Table = document.getElementById('phase3Table');

            phase3Section.addEventListener('click', () => {
                if (phase3Table.style.display === 'none') {
                    phase3Table.style.display = 'block';
                } else {
                    phase3Table.style.display = 'none';
                }
            });
        </script> --}}


        {{-- Calculate marks --}}
        <script>
            $(document).ready(function() {
                // Select all rows
                var rows = $("tbody tr");

                // Add event listeners to Examiner input fields
                rows.find(".examiner-input").on("input", function() {
                    calculateAverage(this);
                });

                // Add event listeners to all input fields (including attendance, development, and report preparation)
                rows.find("input").on("input", function() {
                    calculateTotal();
                });

                // Function to calculate and update the Examiner Average for a specific row
                function calculateAverage(inputField) {
                    var row = $(inputField).closest("tr");
                    var examiner1 = parseFloat(row.find(".examiner-input:eq(0)").val()) || 0;
                    var examiner2 = parseFloat(row.find(".examiner-input:eq(1)").val()) || 0;
                    var examiner3 = parseFloat(row.find(".examiner-input:eq(2)").val()) || 0;
                    var average = (examiner1 + examiner2 + examiner3) / 300 * 40;
                    row.find(".examiner-average").val(average.toFixed(2));
                }

                // Function to calculate and update the Total for all rows
                function calculateTotal() {
                    rows.each(function(index, row) {
                        var examiner1 = parseFloat($(row).find(".examiner-input:eq(0)").val()) || 0;
                        var examiner2 = parseFloat($(row).find(".examiner-input:eq(1)").val()) || 0;
                        var examiner3 = parseFloat($(row).find(".examiner-input:eq(2)").val()) || 0;
                        var average = (examiner1 + examiner2 + examiner3) / 300 * 40;

                        var attendance = parseFloat($(row).find("input[name='attendance[]']").val()) || 0;
                        var development = parseFloat($(row).find("input[name='project_development[]']")
                            .val()) || 0;
                        var reportPreparation = parseFloat($(row).find("input[name='report_preparation[]']")
                            .val()) || 0;

                        // Calculate Total
                        var total = average + attendance + development + reportPreparation;
                        $(row).find(".total-input").val(total.toFixed(2));
                    });
                }
            });
        </script>

        {{-- Prevent form submission on enter click  --}}
        <script>
            $(document).ready(function() {
                // Select your form by its ID or any other suitable selector
                var form = $("#phase1");

                // Add an event listener for the form's keydown event
                form.on("keydown", function(e) {
                    // Check if the key pressed is Enter (key code 13)
                    if (e.keyCode == 13) {
                        // Prevent the default behavior (form submission)
                        e.preventDefault();
                    }
                });
            });
        </script>


</x-frontend.supervisor.layouts.master>
