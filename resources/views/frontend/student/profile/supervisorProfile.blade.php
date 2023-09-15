<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Supervisor Profile
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">Supervisor
                        Profile</a>
                </li>
            </ol>
        </div>
        {{-- Info --}}
        <div class="px-2 py-2 mb-2">
            <div class="container overflow-hidden mx-auto p-4 bg-white shadow-md rounded-lg dark:bg-gray-800 dark:text-gray-400">
                <div class="grid grid-cols-3">
                    <div class="grid col-span-1 justify-center items-center ">
                        <div class="mb-2 ">
                            <img src="https://pyxis.nymag.com/v1/imgs/7be/898/c22698a83a66c5a268116b0f311af72592-22-rm-bts-2.rvertical.w330.jpg"
                                alt="Profile Image" class=" w-36 h-36 rounded-full shadow-md mb-2">
                            <div class="justify-center flex font-mono font-semibold text-gray-800  dark:text-gray-300">{{ $user->supervisor->designation }}</div>
                            <div class="justify-center flex font-mono font-semibold text-gray-800  dark:text-gray-300">{{ $user->department }}</div>
                        </div>
                    </div>
                    <div class="col-start-2 col-span-2 mt-1">
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700  dark:text-gray-300 font-bold mr-2">Faculty ID:</span>
                            <span>{{ $user->supervisor->faculty_id }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700   dark:text-gray-300 font-bold mr-2">Name:</span>
                            <span >{{ $user->first_name . ' ' . $user->last_name }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700  dark:text-gray-300 font-bold mr-2">Email:</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700  dark:text-gray-300 font-bold  mr-2">Contact:</span>
                            <span>{{ $user->phone_number }}</span>
                        </div>
                        <div class="gap-4 mb-2">
                            <span class="text-gray-700 dark:text-gray-300 font-bold  mr-2">Domain:</span>
                            @if ($domains->isEmpty())
                                <span class="text-green-600">Not set yet</span>
                            @else
                                <span>
                                    @foreach ($domains as $domain)
                                        {{ $domain->name }}
                                        @unless ($loop->last)
                                            |
                                        @endunless
                                    @endforeach
                                </span>
                            @endif
                        </div>
                        <div class=" gap-4 mb-2">
                            <span class="text-gray-700  dark:text-gray-300 font-bold  mr-2">Availability Status:</span>
                            <span>
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
            <div class="container overflow-hidden mx-auto p-4 mt-2 bg-white shadow-md rounded-lg  dark:text-gray-300 dark:bg-gray-800 ">
                <h1 class="text-2xl font-semibold mb-4">Publications/Research</h1>
                <div class="border-t border-gray-300 px-3 pt-6 space-y-8">
                    @foreach($citations as $citation)
                    <p class="font-semibold">{{ $citation->citation }}</p>
                    <hr class="my-4 border-gray-300">
                    @endforeach
                </div>
            </div>

        </div>
    </div>
 
</x-frontend.student.layouts.master>
