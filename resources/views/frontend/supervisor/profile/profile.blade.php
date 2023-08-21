<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Supervisor Profile
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="{{ route('supervisor.profile') }}" class="text-gray-900 dark:text-white">Supervisor
                        Profile</a>
                </li>
            </ol>
        </div>

        {{-- Info --}}

        <div class="px-2 py-2 mb-2">
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
            <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
                <div class="flex justify-end">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('supervisor.profileEdit') }}">Edit</a>
                    </button>
                </div>

                <div class="px-5">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Faculty ID:</span>
                        <span class="col-span-2">{{ $user->supervisor->faculty_id }}</span>

                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">First Name:</span>
                        <span class="col-span-2">{{ $user->first_name }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Last Name:</span>
                        <span class="col-span-2">{{ $user->last_name }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Email:</span>
                        <span class="col-span-2">{{ $user->email }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Phone Number:</span>
                        <span class="col-span-2">{{ $user->phone_number }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Department:</span>
                        <span class="col-span-2">{{ $user->department }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Designation:</span>
                        <span class="col-span-2">{{ $user->supervisor->designation }}</span>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Domain:</span>
                        @if (count($domains) == 0)
                            <span class="col-span-2 text-green-600">Not set yet</span>
                        @else
                            <span class="col-span-2">
                                @foreach ($domains as $domain)
                                    {{ $domain->name }}
                                    @unless ($loop->last)
                                        ,
                                    @endunless
                                @endforeach
                            </span>
                        @endif

                    </div>


                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <span class="text-gray-700 font-bold mb-2 col-span-1">Availability Status:</span>
                        <span class="col-span-2">
                            @if ($user->supervisor->availability == 1)
                                Yes
                            @elseif ($user->supervisor->availability == 0)
                                No
                            @endif
                        </span>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        function dismissAlert() {
            var alert = document.getElementById('alert');
            alert.style.display = 'none';
        }
    </script>
</x-frontend.supervisor.layouts.master>
