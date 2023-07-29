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
                    <a href="{{ route('student.createGroup') }}" class="text-gray-900 dark:text-white">Create Group</a>
                </li>
            </ol>
        </div>

        <div class="px-2 py-4 mb-6 bg-slate-100 rounded-md">
            {{-- table --}}
            <div class="px-2 py-2 mb-6">
                <form id="createGroup">
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
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-sm border-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                                id="domain">
                                <option value="0" selected disabled>select domain</option>
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->name }}">
                                        {{ $domain->name }}
                                    </option>
                                @endforeach
                                {{-- Find specific supervisor with passed $id & auto select domain --}}
                                {{-- @php
                        $supervisor = \App\Models\Supervisor::find($id);
                    @endphp --}}
                                {{-- @if ($supervisor != null)
                    @endif --}}
                                {{-- if not passed from supervisor availability --}}
                                {{-- @if ($supervisor == null)
                        @foreach ($domains as $domain)
                            <option value="{{ $domain->name }}">
                                {{ $domain->name }}
                            </option>
                        @endforeach
                    @endif --}}

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
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    {{-- Member 1 --}}
                                    <tr class="text-gray-700 dark:text-gray-400 ">
                                        <td class="px-4 py-3 text-sm">
                                            01
                                        </td>

                                        <td class="px-3 py-3 ">
                                            <input type="email" name="email[]" placeholder="Enter email"
                                                value="{{ session('studentUser')->email }}" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <input type="text" name="name[]" placeholder="Enter name"
                                                    value="{{ session('studentUser')->first_name . ' ' . session('studentUser')->last_name }}"
                                                    disabled
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <input type="number" name="student_ID[]" placeholder="Enter ID"
                                                value="{{ session('studentData')->student_ID }}" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                        </td>

                                        <td class="px-3 py-3">
                                            <input type="text" name="batch[]" placeholder="Enter batch"
                                                value="{{ session('studentData')->batch }}" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>

                                    </tr>
                                    {{-- Member 2 --}}
                                    <tr class="text-gray-700 dark:text-gray-400 ">
                                        <td class="px-4 py-3 text-sm">
                                            02
                                        </td>
                                        <td class="px-3 py-3 ">
                                            <select type="email" name="email[]"
                                                class="w-full form-select focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                                <option value="0">select email</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->email }}"> {{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <input type="text" name="name[]" placeholder=" name" disabled
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <input type="number" name="student_ID[]" placeholder=" ID" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                        </td>

                                        <td class="px-3 py-3">
                                            <input type="text" name="batch[]" placeholder=" batch" disabled
                                                class="w-full  focus:bg-white bg-gray-100  border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>

                                    </tr>
                                    {{-- Member 3 --}}
                                    <tr class="text-gray-700 dark:text-gray-400 ">
                                        <td class="px-4 py-3 text-sm">
                                            03
                                        </td>
                                        <td class="px-3 py-3 ">
                                            <input type="email" name="email[]" placeholder="Enter email"
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <input type="text" name="name[]" placeholder=" name" disabled
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <input type="number" name="student_ID[]" placeholder=" ID" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                        </td>

                                        <td class="px-3 py-3">
                                            <input type="text" name="batch[]" placeholder=" batch" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>

                                    </tr>
                                    {{-- Member 4 --}}
                                    <tr class="text-gray-700 dark:text-gray-400 ">
                                        <td class="px-4 py-3 text-sm">
                                            04
                                        </td>
                                        <td class="px-3 py-3 ">
                                            <input type="email" name="email[]" placeholder="Enter email"
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <input type="text" name="name[]" placeholder=" name" disabled
                                                    class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded  dark:bg-gray-800 ">
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <input type="number" name="student_ID[]" placeholder=" ID" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height rounded dark:bg-gray-800 ">
                                        </td>

                                        <td class="px-3 py-3">
                                            <input type="text" name="batch[]" placeholder=" batch" disabled
                                                class="w-full  focus:bg-white bg-gray-100 border-gray-100 max-height  rounded dark:bg-gray-800 ">
                                        </td>

                                    </tr>


                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{-- end table  --}}
                    <div class="flex justify-center">
                        <input type="submit"
                            class="px-4 py-2 mt-3 font-bold bg-blue-500 cursor-pointer text-white rounded hover:bg-blue-700"
                            value="Submit">

                    </div>
                </form>
            </div>
            <script>
                $(document).ready(function() {
                    $("#createGroup").submit(function(e) {
                        e.preventDefault();
                        var _token = $("input[name='_token']").val();
                        var project_type = $(".project_type").val();
                        var domain = $("#domain").val();
                        console.log(domain)

                        // var emails = [];
                        // var names = [];
                        // var student_IDs = [];
                        // var batches = [];

                        // Iterate over each email input field
                        // $(".email").each(function() {
                        //     var email = $(this).val();
                        //     emails.push(email);
                        // });

                        // // Iterate over each name input field
                        // $(".input-name").each(function() {
                        //     var name = $(this).val();
                        //     names.push(name);
                        // });

                        // // Iterate over each student ID input field
                        // $(".input-studentID").each(function() {
                        //     var student_ID = $(this).val();
                        //     student_IDs.push(student_ID);
                        // });

                        // // Iterate over each batch input field
                        // $(".input-batch").each(function() {
                        //     var batch = $(this).val();
                        //     batches.push(batch);
                        // });

                        $.ajax({
                            url: "{{ route('student.storeGroup') }}",
                            type: "POST",
                            data: {
                                _token: _token,
                                project_type: project_type,
                                domain: domain,

                            },
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    });
                });
            </script>
        </div>


    </div>





</x-frontend.student.layouts.master>
