<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create Group </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.createGroup') }}" class="text-gray-900 dark:text-white">Create
                        Group</a>
                </li>
            </ol>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            $memberCount = count($students);
        @endphp
        @if ($memberCount < 4)
            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow" id="alert">
                {{strtoupper('Sufficient members are not available!')}}
                <button type="button" class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                    onclick="this.parentElement.style.display ='none'">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
        @endif
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
        <div class="px-2 py-4 mb-6 bg-slate-100 dark:bg-gray-900  border border-gray-800 rounded-md">
            <div class="px-2 py-2 mb-6">
                <form action="{{ route('student.storeGroup') }}" method="POST">
                    @csrf
                    {{-- project type --}}
                    <div class="md:flex mb-4 px-4">
                        <div class="md:w-2/12 mb-2">
                            <span class="text-gray-700 font-semibold dark:text-gray-300 ">
                                Type :
                            </span>
                        </div>
                        <div class="md:w-3/12 sm:mt-2 md:mt-0">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="project_type text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="project_type" value="project" />
                                <span class="ml-2 ">Project</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="project_type text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="project_type" value="thesis" />
                                <span class="ml-2 ">Thesis</span>
                            </label>
                            <x-input-error :messages="$errors->get('project_type')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Domain --}}
                    <div class="md:flex mb-4 px-4">
                        <div class="md:w-2/12">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mt-2 pr-4"
                                for="my-select">
                                Domain:
                            </label>
                        </div>
                        <div class="md:w-3/12">
                            <select name="domain" id="domain"
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-sm border-gray-300 text-gray-700 dark:bg-gray-700 focus:dark:bg-gray-800 dark:text-gray-300"
                                id="domain">
                                <option value="0" selected disabled>select domain</option>
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->name }}">
                                        {{ $domain->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Group Name --}}
                    <div class="md:flex mb-6 px-4">
                        <div class="md:w-2/12">
                            <label for="group_name"
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mt-2 pr-4">
                                Group Name:
                            </label>
                        </div>
                        <div class="md:w-3/12">
                            <input id="group_name" type="text" name="group_name"
                                class=" block w-full focus:bg-white bg-gray-100 rounded-md border-sm border-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                                placeholder="(optional)">
                        </div>
                    </div>

                    {{-- table --}}
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-md">
                        <div class="w-full overflow-x-auto shadow-lg">
                            <table class="w-full whitespace-no-wrap ">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-3 py-3">Sl</th>
                                        <th class="px-3 py-3">Email</th>
                                        <th class="px-3 py-3">Name</th>
                                        <th class="px-3 py-3">ID</th>
                                        <th class="px-3 py-3">Batch</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 ">
                                    {{-- Member 1 --}}
                                    <tr class="text-gray-700 dark:text-gray-400 ">
                                        <td class="px-4 py-3 text-sm">
                                            01
                                        </td>

                                        <td class="px-3 py-3 ">
                                            <input type="hidden" name="creator_id" value="{{ $loggedInStudent->id }}">
                                            <input type="hidden" name="ids[]" value="{{ $loggedInStudent->id }}">
                                            <input type="email" name="email[]" placeholder="Enter email"
                                                value="{{ $loggedInStudent->email }}" readonly
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <input type="text" name="name[]" placeholder="Enter name"
                                                    value="{{ $loggedInStudent->first_name . ' ' . $loggedInStudent->last_name }}"
                                                    readonly
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <input type="number" name="student_id[]" placeholder="Enter ID"
                                                value="{{ $loggedInStudent->student->student_id }}" readonly
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                        </td>

                                        <td class="px-3 py-3">
                                            <input type="text" name="batch[]" placeholder="Enter batch"
                                                value="{{ $loggedInStudent->student->batch }}" readonly
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>

                                    </tr>

                                    {{-- Additional Members --}}

                                    @for ($i = 2; $i <= 4; $i++)
                                        <tr class="text-gray-700 dark:text-gray-400 ">
                                            <td class="px-4 py-3 text-sm">
                                                0{{ $i }}
                                            </td>
                                            <td class="px-3 py-3 ">
                                                <select type="email" name="email[]"
                                                    class="email-select w-full form-select focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                                    <option value="0">select email</option>

                                                    @foreach ($students as $student)
                                                        @continue ($student->user->email === $loggedInStudent->email)
                                                        <option value="{{ $student->user->email }}">
                                                            {{ $student->user->email }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </td>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            <td class="px-4 py-3">
                                                <div>
                                                    <input type="hidden" name="ids[]">
                                                    <input type="text" name="name[]" placeholder=" name" readonly
                                                        class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                                </div>
                                            </td>
                                            <td class="px-3 py-3">
                                                <input type="number" name="student_id[]" placeholder=" ID" readonly
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                            </td>

                                            <td class="px-3 py-3">
                                                <input type="text" name="batch[]" placeholder=" batch" readonly
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- end table  --}}
                    <div class="flex justify-center space-x-4">
                        @if ($memberCount <= 3)
                            <a href="{{ route('student.groupMemberRequest') }}"
                                class="px-4 py-2 mt-3 font-bold bg-blue-500 cursor-pointer text-white rounded hover:bg-blue-700">
                                <span>Request Members</span></a>
                        @else
                            <input type="submit"
                                class="px-4 py-2 mt-3 font-bold bg-blue-500 cursor-pointer text-white rounded hover:bg-blue-700"
                                value="Submit">
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- auto fill & reduce options after each select  --}}
        <script>
            $(document).ready(function() {
                $('.email-select').change(function() {
                    var selectedEmail = $(this).val();
                    var selectedElement = $(this);

                    var prevValue = selectedElement.data('prev-value');

                    // Show the previously selected email option in other select elements
                    if (prevValue && prevValue !== selectedEmail) {
                        $('.email-select').not(this).find('option[value="' + prevValue + '"]').show();
                    }

                    var selectedStudent = <?php echo json_encode($students); ?>.find(function(student) {
                        return student.user.email === selectedEmail;
                    });
                    console.log(selectedStudent);

                    if (selectedStudent) {
                        // Combine first_name and last_name
                        var fullName = selectedStudent.user.first_name + ' ' + selectedStudent.user.last_name;

                        // Set the full name value in the input field
                        $('input[name="name[]"]', selectedElement.closest('tr')).val(fullName);

                        if (selectedStudent) {
                            $('input[name="student_id[]"]', selectedElement.closest('tr')).val(selectedStudent
                                .student_id);
                            $('input[name="batch[]"]', selectedElement.closest('tr')).val(selectedStudent
                                .batch);
                            // Set the selected user's id in the hidden input field named "ids"
                            $('input[name="ids[]"]', selectedElement.closest('tr')).val(selectedStudent.user
                                .id);
                        } else {
                            // Clear the student_id and batch inputs if no student data is available
                            $('input[name="student_id[]"]', selectedElement.closest('tr')).val('');
                            $('input[name="batch[]"]', selectedElement.closest('tr')).val('');
                        }

                        // Hide the selected option in other select elements
                        $('.email-select').not(this).find('option[value="' + selectedEmail + '"]').hide();

                        // Store the current value as the previous value
                        selectedElement.data('prev-value', selectedEmail);
                    }
                });
            });
        </script>
    @endpush

</x-frontend.student.layouts.master>
