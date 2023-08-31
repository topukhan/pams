<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Genre and Supervisor Availabilty</h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
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
        <div class="px-2 md:flex ">
            <div class=" px-4 md:w-1/4">
                <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                    for="domain">
                    Domain:
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
        <div class="p-2 md:flex md:items-center mb-2">
            <div class="md:w-1/4"></div>
            <div class="md:w-3/4">
                <button id="filterButton"
                    class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                    type="button">
                    Filter
                </button>
                <a href="{{ route('student.supervisor.availability') }}"
                    class="shadow bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                    type="button">
                    Reset
                </a>
            </div>
        </div>
        {{-- table --}}
        <div class="px-2 py-2">
            <div id="supervisorCardContainer" class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mb-3">
                {{-- Supervisor Cards --}}
                @foreach ($supervisors->sortByDesc('availability') as $supervisor)
                    <div class=" rounded-lg shadow-md shadow-slate-500 p-4 bg-white dark:bg-gray-800">
                        <div class="justify-between flex mb-2">
                            <div>
                                <img src="https://pyxis.nymag.com/v1/imgs/7be/898/c22698a83a66c5a268116b0f311af72592-22-rm-bts-2.rvertical.w330.jpg"
                                    alt="Profile Image"class="w-24 h-24 rounded-full">
                            </div>
                            <div>
                                <a href="{{route('student.supervisorProfile', ['id' => $supervisor->user->id])}}">
                                    <button
                                    class="px-2 py-1 text-xs font-semibold leading-tight text-white bg-gray-400 rounded-full">
                                    View Profile
                                </button></a>
                                <span class="text-xs ">
                                    @if ($supervisor->availability == 1)
                                        <a href="{{ route('student.proposalForm', ['id' => $supervisor->user->id]) }}">
                                            <button
                                                class="px-2 py-1 font-semibold leading-tight text-white bg-green-500 rounded-full">
                                                Request
                                            </button>
                                        </a>
                                    @endif
                                    @if ($supervisor->availability == 0)
                                        <button disabled
                                            class="px-2 py-1 font-semibold leading-tight text-white bg-red-500 rounded-full">
                                            Unavailable
                                        </button>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="font-semibold  dark:text-gray-300 text-lg ">
                            {{ $supervisor->user->first_name . ' ' . $supervisor->user->last_name }}</div>
                        <div class="text-gray-700  dark:text-gray-400 text-sm mb-1">{{ $supervisor->designation }}</div>
                        <div class="text-gray-700  dark:text-gray-400 text-sm mb-1 ">{{ $supervisor->user->email }}</div>
                        <div class="text-gray-700 dark:text-gray-400 text-sm mb-2 ">{{ $supervisor->user->phone_number }}
                        </div>
                        <div class="mb-2 text-sm  dark:text-gray-200  text-semibold">
                            @if (count($supervisor->user->domains) == 0)
                                <span>N/A</span>
                            @else
                                <span>
                                    @foreach ($supervisor->user->domains as $domain)
                                        {{ $domain->name }}
                                        @unless ($loop->last)
                                            |
                                        @endunless
                                    @endforeach
                                </span>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            var domainSelect = $('#domain');
            var supervisorCardContainer = $('#supervisorCardContainer');
            var filterButton = $('#filterButton');

            filterButton.on('click', function() {
                var selectedDomain = domainSelect.val();

                $.ajax({
                    url: '{{ route('student.supervisor.availability') }}',
                    type: 'GET',
                    data: {
                        domain: selectedDomain
                    },
                    success: function(data) {
                        var supervisors = data.supervisors;
                        var domainName = data.domainName;

                        var html = '';

                        if (Array.isArray(supervisors) && supervisors.length > 0) {
                            supervisors.forEach(function(supervisor) {
                                var supervisor_id = supervisor.user.id;
                                var availabilityClass = supervisor.availability ?
                                    'green' : 'red';
                                var buttonLabel = supervisor.availability ? 'Request' :
                                    'Unvailable';

                                html += `
    <div class="border rounded-lg shadow-lg p-4 bg-white dark:bg-gray-800">
        <div class="justify-between flex mb-2">
            <div>
                <img src="https://pyxis.nymag.com/v1/imgs/7be/898/c22698a83a66c5a268116b0f311af72592-22-rm-bts-2.rvertical.w330.jpg"
                    alt="Profile Image" class="w-24 h-24 rounded-full">
            </div>
            <div>
                <a href="{{route('student.supervisorProfile', ['id' =>''])}}${supervisor.user.id}">
                <button class="px-2 py-1 text-xs font-semibold leading-tight text-white bg-gray-400 rounded-full">
                    View Profile
                </button></a>
                <span class="text-xs">
                    <a href="{{ route('student.proposalForm', ['id' => '']) }}${supervisor_id}&domain_name=${encodeURIComponent(domainName)}">
                        <button ${supervisor.availability ? '' : 'disabled '}
                            class="px-2 py-1 font-semibold leading-tight text-white bg-${availabilityClass}-500 rounded-full">
                            ${buttonLabel}
                        </button>
                    </a>
                </span>
            </div>
        </div>
        <div class="font-semibold text-lg ">
            ${supervisor.user.first_name + ' ' + supervisor.user.last_name}
        </div>
        <div class="text-gray-700 text-sm mb-1">${supervisor.designation}</div>
        <div class="text-gray-700 text-sm mb-1">${supervisor.user.email}</div>
        <div class="text-gray-700 text-sm mb-2">${supervisor.user.phone_number}</div>
        <div class="mb-2 text-sm text-semibold">${ domainName }</div>
    </div>`;
                            });

                            supervisorCardContainer.html(html);
                        } else {
                            supervisorCardContainer.html(
                                '<div class="text-center text-gray-700 dark:text-gray-400 py-8">No supervisors found.</div>'
                            );
                        }
                    },

                    error: function() {
                        supervisorCardContainer.html(
                            '<div class="text-center text-gray-700 dark:text-gray-400 py-8">Error loading data.</div>'
                        );
                    }
                });
            });
        });
    </script>


</x-frontend.student.layouts.master>
