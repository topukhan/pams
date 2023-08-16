<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Final Year Project Proposal Form </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.proposalForm') }}" class="text-gray-900 dark:text-white">Proposal Form</a>
                </li>
            </ol>
        </div>
        {{-- form --}}
        <div class="px-2 py-2">
            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div id="filterFormWrapper">
                    <form id="filterForm" action="{{ route('student.proposalForm') }}" method="POST">
                
                    @csrf


                    {{-- Domain --}}
                    <div class="md:flex mb-2">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-select">
                                Domain
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="domain"
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                                id="domain">
                                {{-- Find specific supervisor with passed $id & auto select domain --}}
                                @php
                                    $supervisor = \App\Models\Supervisor::find($id);
                                @endphp
                                <option value="0" selected disabled>select domain</option>
                                @if ($supervisor != null)
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->name }}"
                                            {{ $domain->name == $supervisor->domain ? 'selected' : '' }}>
                                            {{ $domain->name }}
                                        </option>
                                    @endforeach
                                @endif
                                {{-- if not passed from supervisor availability --}}
                                @if ($supervisor == null)
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->name }}">
                                            {{ $domain->name }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                        </div>
                    </div>
                  
                    {{-- Filter button --}}
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button id="filterButton" class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded" type="button">
                                Filter
                            </button>
                        </div>
                    </div>
                    {{-- Temporary Group select option, will change in next phase --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="group">
                                Group
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="" name="" type="text" value="" >
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="title">
                                Project/Thesis Title :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="title" name="title" type="text" value="" placeholder="Enter title">
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-select">
                                Supervisor
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="supervisor_id" class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300" id="supervisor">
                                <option value="Default" disabled selected>select</option>
                                @foreach ($filteredSupervisors as $supervisor) 
                                    <option value="{{ $supervisor->id }}"
                                        {{ $supervisor->id == $id ? 'selected' : '' }}>
                                        {{ $supervisor->user->first_name . ' ' . $supervisor->user->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    {{-- Co-Supervisor --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="cosupervisor">
                                Co-Supervisor
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                id="cosupervisor" type="text" name="cosupervisor" value=""
                                placeholder="Enter name">
                            <x-input-error :messages="$errors->get('cosupervisor')" class="mt-2" />

                        </div>
                    </div>
                    {{-- Type --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <span class="text-gray-700 font-semibold dark:text-gray-300">
                                Type :
                            </span>
                        </div>
                        <div class="md:w-3/4 pl-5">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="type" value="project" />
                                <span class="ml-2 ">Project</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="type" value="thesis" />
                                <span class="ml-2 ">Thesis</span>
                            </label>
                        </div>
                    </div>
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label
                                class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="description">
                                Description:
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <textarea
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                id="description" name="description"  row="2" value="" placeholder="Describe your project..."></textarea>
                        </div>
                    </div> 

                    
                </div>
                   
                    {{-- submit button --}}
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button
                                class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            $(document).ready(function () {
                // Get references to the relevant elements
                var domainSelect = $('#domain');
                var supervisorSelect = $('#supervisor');
    
                // Attach event listener to the filter button
                $('#filterButton').on('click', function () {
                    var selectedDomain = domainSelect.val();
    
                    // Make an AJAX request to fetch filtered supervisors
                    $.ajax({
                        url: '{{ route('student.proposalForm') }}',
                        type: 'GET',
                        data: { domain: selectedDomain },
                        success: function (response) {
                            console.log(response); // Add this line to see the response in the browser console
    
                            // Clear the previous options and add new options
                            supervisorSelect.empty();
                            supervisorSelect.append('<option value="" disabled selected>Select</option>');
    
                            // Populate the supervisors dropdown with the new options
                            $.each(response.supervisors, function (index, supervisor) {
                                supervisorSelect.append('<option value="' + supervisor.id + '">' + supervisor.full_name + '</option>');
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        
</x-frontend.student.layouts.master>
