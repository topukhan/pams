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
                    <a href="{{ route('student.supervisor.availability') }}"
                        class="text-gray-900 dark:text-white">Supervisor Availabilty</a>
                </li>
            </ol>
        </div>

        <div class="md:flex mb-2">
            <div class="md:w-1/4">
                <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                    for="domain">
                    Domain
                </label>
            </div>
            <div class="md:w-3/4">
                <select name="domain" id="domain"
                    class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <option value="0" selected disabled>Select domain</option>
                    @foreach ($domains as $domain)
                        <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('domain')" class="mt-2" />
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4"></div>
            <div class="md:w-3/4">
                <button id="filterButton"
                    class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                    type="button">
                    Filter
                </button>
            </div>
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
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="supervisorTableBody">

                            {{-- Supervisors  --}}

                            @foreach ($supervisors->sortByDesc('availability') as $supervisor)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">
                                        {{ $supervisor->user->first_name . ' ' . $supervisor->user->last_name }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">{{ $supervisor->user->email }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $supervisor->user->phone_number }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">{{ $supervisor->domain }}</td>
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
    {{-- <script>
        $(document).ready(function() {
           
            $('#domain').on('change', function() {
                var domain = $(this).val();
                $.ajax({
                    url: '{{ route('student.supervisor.availability') }}',
                    type: 'GET',
                    data: {'domain': domain},
                    success: function(data) {
                        console.log(data);
                    }   
                       
                });
            });
        });
    </script> --}}

  
<script>
        $(document).ready(function() {
            var domainSelect = $('#domain');
            var supervisorTableBody = $('#supervisorTableBody');

            $('#filterButton').on('click', function() {
                var selectedDomain = domainSelect.val();
        

                $.ajax({
                    url: '{{ route('student.supervisor.availability') }}',
                    type: 'GET',
                    data: {domain : selectedDomain},
                    success: function(data) {
                        console.log(data);

                        var supervisors = data.supervisors;
                        var html = '';

                        if (supervisors.length > 0) {
                            supervisors.forEach(function(supervisor, index) {
                                html += `
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">${index + 1}</td>
                                        <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.first_name} ${supervisor.user.last_name}</td>
                                        <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.email}</td>
                                        <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.phone_number}</td>
                                        <td class="px-4 py-3 font-semibold text-sm">${supervisor.domain}</td>
                                        <td class="px-4 py-3 font-semibold text-sm">${supervisor.availability ? 'Yes' : 'No'}</td>
                                        <td class="px-4 py-3 text-xs">
                            ${supervisor.availability === 1
                                ? '<a href="' + '{{ route("student.proposalForm", ["id" => "' + supervisor.id + '"]) }}' + '">' +
                                    '<button class="px-2 py-1 font-semibold leading-tight text-green-800 bg-green-200 rounded-full dark:bg-green-700 dark:text-green-200">Request</button>' +
                                '</a>'
                                : '<a href="' + '{{ route("student.proposalForm", ["id" => "' + supervisor.id + '"]) }}' + '">' +
                                    '<button disabled class="px-4 py-1 font-semibold leading-tight text-green-800 bg-red-200 rounded-full dark:bg-red-700 dark:text-green-200">N/A</button>' +
                                '</a>'}
                        </td>
                    `;
                            });

                            supervisorTableBody.html(html);
                        } else {
                            supervisorTableBody.html(
                                '<tr><td colspan="7" class="px-4 py-3 text-center">No supervisors found.</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        supervisorTableBody.html(
                            '<tr><td colspan="7" class="px-4 py-3 text-center">Error loading data.</td></tr>'
                        );
                    }
                });
            });
        });
     </script> 
 


    {{-- <script>
        $(document).ready(function() {
            var domainSelect = $('#domain');
            var supervisorTableBody = $('#supervisorTableBody');

            $('#filterButton').on('click', function() {
                var selectedDomain = domainSelect.val();

                $.ajax({
                    url: '{{ route('student.supervisor.availability') }}',
                    type: 'GET',
                    data: {
                        domain: selectedDomain
                    },
                    success: function(data) {
                        supervisorTableBody.empty();

                        if (data.length === 0) {
                            var noSupervisorRow = `
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center font-semibold">No supervisors available for the selected domain.</td>
                        </tr>`;
                            supervisorTableBody.append(noSupervisorRow);
                        } else {
                            var tableHtml = '';

                            data.forEach(function(supervisor, index) {
                                var availabilityText = supervisor.availability === 1 ?
                                    'Yes' : 'No';
                                var proposalButtonHtml = supervisor.availability === 1 ?
                                    `
                                <a href="{{ route('student.proposalForm', ['id' => ':id']) }}">
                                    <button class="px-2 py-1 font-semibold leading-tight text-green-800 bg-green-200 rounded-full dark:bg-green-700 dark:text-green-200">
                                        Request
                                    </button>
                                </a>` :
                                    `
                                <a href="{{ route('student.proposalForm', ['id' => ':id']) }}">
                                    <button disabled class="px-4 py-1 font-semibold leading-tight text-green-800 bg-red-200 rounded-full dark:bg-red-700 dark:text-green-200">
                                        N/A
                                    </button>
                                </a>`;

                                proposalButtonHtml = proposalButtonHtml.replace(':id',
                                    supervisor.id);

                                tableHtml += `
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">${index + 1}</td>
                                <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.first_name} ${supervisor.user.last_name}</td>
                                <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.email}</td>
                                <td class="px-4 py-3 font-semibold text-sm">${supervisor.user.phone_number}</td>
                                <td class="px-4 py-3 font-semibold text-sm">${supervisor.domain}</td>
                                <td class="px-4 py-3 font-semibold text-sm">${availabilityText}</td>
                                <td class="px-4 py-3 text-xs">${proposalButtonHtml}</td>
                            </tr>`;


                            });

                            supervisorTableBody.html(tableHtml);
                        }
                    }
                });
            });
        });
    </script> --}}



</x-frontend.student.layouts.master>
