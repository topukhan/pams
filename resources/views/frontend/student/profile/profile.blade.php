<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Student Profile
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="{{ route('student.profile') }}" class="text-gray-900 dark:text-white">Student Profile</a>
                </li>
            </ol>
        </div>

        {{-- Info --}}

        <div class="px-2 py-2 mb-2">
            <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
                @if (session('message'))
                    <div class="relative top-1/4  w-full bg-green-200 text-green-700 px-4 py-4 rounded-lg shadow"
                        id="alert">
                        {{ session('message') }}
                        <button type="button"
                            class="absolute ml-2 right-6 text-green-700 hover:text-green-900 focus:outline-none"
                            onclick="dismissAlert()">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div><br>
                @endif

                <div class="flex justify-end">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('student.profileEdit') }}">Edit</a>
                    </button>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Student ID:</span>
                    <span class="col-span-2">{{ $user->student->student_id }}</span>
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
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Batch:</span>
                    <span class="col-span-2">{{ $user->student->batch }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Section:</span>
                    <span class="col-span-2">{{ $user->student->section }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Shift:</span>
                    <span class="col-span-2">{{ $user->student->shift }}</span>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Project Types:</span>
                    @if ($user->student->project_type_status === 0)
                        <span class="col-span-2 text-red-600">Set your project type</span>
                    @else
                        <span class="col-span-2">
                            @foreach ($projectTypes as $projectType)
                                {{ ucfirst($projectType->name) }}

                                @unless ($loop->last)
                                    ,
                                @endunless
                            @endforeach
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Domains:</span>
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







            </div>
        </div>

    </div>

    <script>
        function dismissAlert() {
            var alert = document.getElementById('alert');
            alert.style.display = 'none';
        }
    </script>
</x-frontend.student.layouts.master>
