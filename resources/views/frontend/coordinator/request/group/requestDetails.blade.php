<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Request Details
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Request
                        Details</a>
                </li>
            </ol>
        </div>
        {{-- Details --}}

        <h2 class="p-3 leading-tight text-blue-700 bg-blue-100 dark:bg-blue-700 dark:text-blue-500 font-bold text-center">
            Individual Request</h2>
        
        <div class="container mx-auto mt-4 p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 dark:text-gray-300">Student ID:</span>
                    <span class="col-span-2 dark:text-gray-100">{{ $request->user->student->student_id }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 dark:text-gray-300">Project Type:</span>
                
                    @if (count($request->user->projectTypes) == 0)
                        <span class="col-span-2 text-blue-600 dark:text-blue-400">N/A</span>
                    @else
                        @php
                            $projectTypes = $request->user->projectTypes;
                        @endphp
                
                        <span class="col-span-2 dark:text-gray-100">
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
                    <span class="text-gray-700 font-bold mb-2 col-span-1 dark:text-gray-300">Preferred Domain:</span>
                    @if (count($request->user->domains) == 0)
                        <span class="col-span-2 text-blue-600 dark:text-blue-400">N/A</span>
                    @else
                        @php
                            $domains = $request->user->domains;
                        @endphp
                        <span class="col-span-2 dark:text-gray-100">
                            @foreach ($domains as $domain)
                                {{ $domain->name }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span>
                    @endif
                </div>
                
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 dark:text-gray-300">Reason:</span>
                    <span class="col-span-2 font-bold text-blue-700 dark:text-blue-100 ">{{ $request->reason }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 dark:text-gray-300">Description:</span>
                    <span class="col-span-2 dark:text-gray-100">{{ $request->note }}</span>
                </div>
        
                <div class="flex justify-end space-x-2">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.formedGroupsLists', $request->id) }}">Groups</a>
                    </button>
                    <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.requests') }}">Cancel</a>
                    </button>
                </div>
            </div>
        </div>
        


    </div>

</x-frontend.coordinator.layouts.master>
