<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Request Details
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">Request
                        Details</a>
                </li>
            </ol>
        </div>

        {{-- Details --}}

        <h2
            class="p-3 leading-tight text-blue-700 bg-blue-100  dark:bg-blue-700 dark:text-blue-100 font-bold text-center ">
            Request For Group Members</h2>

        <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Student ID:</span>
                    <span class="col-span-2">{{ $request->user->student->student_id }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Preferred Type:</span>


                    @if ($request->user->student->project_type_status === 0)
                        <span class="col-span-2 text-blue-600">N/A</span>
                    @else
                        @php
                            $projectType = json_decode($request->user->student->project_type, true);
                            
                            foreach ($projectType as $key => $value) {
                                $projectType[$key] = ucfirst($value);
                            }
                        @endphp
                        <span class="col-span-2">
                            @foreach ($projectType as $type)
                                {{ $type }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Preferred Domain:</span>
                    @if ($request->user->student->domain === null)
                        <span class="col-span-2 text-blue-600">N/A</span>
                    @else
                        @php
                            $domain = json_decode($request->user->student->domain, true);
                        @endphp
                        <span class="col-span-2">
                            @foreach ($domain as $item)
                                {{ $item }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span>
                    @endif

                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1 ">Reason:</span>
                    <span class="col-span-2 font-bold  text-blue-700 dark:text-blue-100">{{ $request->reason }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Description:</span>
                    <span class="col-span-2">{{ $request->note }}</span>
                </div>

                <div class="flex justify-end space-x-2">
                    <button class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.formedGroupsLists', $request->id) }}">Groups</a>
                    </button>
                    <button class=" bg-violet-500 hover:bg-violet-600 text-white font-bold mt-8 py-2 px-4 rounded">
                        <a href="{{ route('coordinator.requests') }}">Cancel</a>
                    </button>
                </div>

            </div>

        </div>


    </div>

</x-frontend.coordinator.layouts.master>
