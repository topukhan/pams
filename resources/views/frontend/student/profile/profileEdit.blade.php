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
                    <a href="{{ route('student.profileEdit') }}" class="text-gray-900 dark:text-white">Student Profile
                        Edit</a>
                </li>
            </ol>
        </div>

        <div class="px-2 py-2 mb-6">
            <div class="container mx-auto mt-2 p-4 bg-white shadow-md rounded-lg">
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @if (session('message'))
                    <div class="relative top-1/4  w-full bg-red-200 text-red-700 px-4 py-4 rounded-lg shadow"
                        id="alert">
                        {{ session('message') }}
                        <button type="button"
                            class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                            onclick="dismissAlert()">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div><br>
                @endif
                @if (session('message'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif
                <h2 class="text-gray-700 bg-gray-50 font-semibold mb-4 text-center py-3">Edit Information</h2>


                {{-- profile Edit form  --}}
                <form action="{{ route('student.profileUpdate', ['id' => session('studentUser')->id]) }}"
                    method="post">
                    @csrf
                    @method('patch')
                    <div class="grid grid-cols-3 gap-4 mb-7">
                        <label for="projectType" class="text-gray-700 font-bold mb-2 col-span-1 self-center">
                            Preferred Project Type:
                        </label>
                        <div class="col-span-2 space-y-2 space-x-4">
                            @foreach ($projectTypes as $type)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="project_type[]" value="{{ $type->id }}" class="form-checkbox"
                                        @if (in_array($type->name, $selectedProjectTypes->toArray())) checked @endif>
                                    <span class="ml-2">{{ ucfirst($type->name) }}</span>
                                </label>
                            @endforeach
                            <x-input-error :messages="$errors->get('project_type')" class="mt-2" />
                        </div>
                    </div>
                    
                    
                    


                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <label class="text-gray-700 font-bold mb-2 col-span-1 self-center">Domain:</label>
                        <div class="col-span-2">
                            @foreach ($domains as $domain)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="domain[]" value="{{ $domain->id }}" class="form-checkbox domain-checkbox"
                                        @if (in_array($domain->name, $selectedDomains->toArray())) checked @endif>
                                    <span class="ml-2 @if (in_array($domain->name, $selectedDomains->toArray())) font-semibold @else opacity-70 @endif">{{ $domain->name }}</span>
                                </label>
                                <br>
                            @endforeach
                            <div class="text-sm mb-4 text-red-600 " style="display: none" id="maxDomainMessage">You can select up
                                to 3 domains.</div>
                            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="flex justify-center space-x-4">
                        <button type="submit"
                            class="bg-purple-500 hover:bg-purple-600 text-white font-bold mt-4 py-2 px-4 rounded">Update
                        </button>
                        <a href="{{ route('student.profile') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold mt-4 py-2 px-4 rounded">Cancel</a>
                    </div>
                </form>

            </div>
        </div>


        <div class="px-2 py-2 mb-2">
            <div class="container mx-auto mt-4 p-4 bg-white shadow-lg rounded-lg">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Student ID:</span>
                    <span class="col-span-2">{{ session('studentData')->student_id }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">First Name:</span>
                    <span class="col-span-2">{{ session('studentUser')->first_name }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Last Name:</span>
                    <span class="col-span-2">{{ session('studentUser')->last_name }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Email:</span>
                    <span class="col-span-2">{{ session('studentUser')->email }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Phone Number:</span>
                    <span class="col-span-2">{{ session('studentUser')->phone_number }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Department:</span>
                    <span class="col-span-2">{{ session('studentUser')->department }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Batch:</span>
                    <span class="col-span-2">{{ session('studentData')->batch }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Section:</span>
                    <span class="col-span-2">{{ session('studentData')->section }}</span>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <span class="text-gray-700 font-bold mb-2 col-span-1">Shift:</span>
                    <span class="col-span-2">{{ session('studentData')->shift }}</span>
                </div>
            </div>
        </div>

        <script>
            const checkboxes = document.querySelectorAll('.domain-checkbox');
            const maxSelection = 3;
            const maxDomainMessage = document.getElementById('maxDomainMessage');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const checkedCount = document.querySelectorAll('.domain-checkbox:checked').length;
                    checkboxes.forEach(cb => {
                        if (!cb.checked) {
                            cb.disabled = checkedCount >= maxSelection;
                        }
                    });
                    updateLabelStyles();

                    // Show or hide the message based on the number of selected domains
                    if (checkedCount >= maxSelection) {
                        maxDomainMessage.style.display = 'block';
                    } else {
                        maxDomainMessage.style.display = 'none';
                    }
                });
            });

            function updateLabelStyles() {
                checkboxes.forEach(checkbox => {
                    const label = checkbox.nextElementSibling;
                    label.classList.remove('font-semibold', 'opacity-70');
                    if (checkbox.checked) {
                        label.classList.add('font-semibold');
                    } else if (checkbox.disabled) {
                        label.classList.add('opacity-70');
                    }
                });
            }

            // Call the function initially to update styles and message on page load
            updateLabelStyles();
        </script>

        <script>
            function dismissAlert() {
                var alert = document.getElementById('alert');
                alert.style.display = 'none';
            }
        </script>





</x-frontend.student.layouts.master>
