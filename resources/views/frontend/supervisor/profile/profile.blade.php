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
                    <a href="{{ route('supervisor.profile') }}" class="text-gray-900 dark:text-white">Supervisor Profile</a>
                </li>
            </ol>
        </div>

        {{-- Info --}}

        @if (session('message'))
            <div class="relative top-1/4  w-full bg-green-200 text-green-700 px-4 py-4 rounded-lg shadow"
                id="alert">
                {{ session('message') }}
                <button type="button"
                    class="absolute ml-2 right-6 text-green-700 hover:text-green-900 focus:outline-none"
                    onclick="dismissAlert()">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
        @endif
        <div class="px-2 py-2 mb-2">
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
                        <span class="col-span-2">{{ $user->supervisor->domain }}</span>

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
