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
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm" id="phase1Section">
                    <span class="px-2 text-lg font-bold">PHASE I</span>
                </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs" id="phase1Table" style="display: none;">
                <div class="bg-lime-200 rounded-md text-center shadow-sm">
                    <div class="shadow-xs overflow-x-auto w-[159vh]">
                        <table class="whitespace-no-wrap table-auto">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-3 py-3 whitespace-normal  text-center">Student ID</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Name</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Email</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Project Tilte</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Supervisor</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 1</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 2</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 3</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner</th>
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
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="100"></td>
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="40"></td>
                                        <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="10"></td>
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="20"></td>
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                                type="number" value="30"></td>
                                        <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
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

        {{-- phase2 --}}
        <div class="mt-3">
            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm " id="phase2Section">
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
                                    <th class="px-3 py-3 whitespace-normal  text-center">Project Tilte</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Supervisor</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 1</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 2</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 3</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner</th>
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
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="40"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="10"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="20"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="30"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
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
            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
                <div class="bg-lime-200 rounded-md text-center text-gray-800 shadow-sm " id="phase3Section">
                    <span class="px-2 text-lg font-bold">PHASE II</span>
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
                                    <th class="px-3 py-3 whitespace-normal  text-center">Project Tilte</th>
                                    <th class="px-3 py-3 whitespace-normal  text-center">Supervisor</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 1</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 2</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner 3</th>
                                    <th class="px-3 py-3 whitespace-normal text-center">Examiner</th>
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
                                        <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="100"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="40"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="10"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="20"></td>
                                    <td><input class="border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
                                            type="number" value="30"></td>
                                    <td><input class=" border-none w-28 text-sm dark:bg-gray-800 font-semibold text-center"
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

        <script>
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
        </script>
</x-frontend.supervisor.layouts.master>
