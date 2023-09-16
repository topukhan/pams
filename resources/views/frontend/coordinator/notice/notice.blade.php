<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Post a Notice
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('coordinator.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">
                        Notice
                    </a>
                </li>
            </ol>
        </div>
        <div class="px-2 py-2">
            @if (session('message'))
                <div
                    class="max-w-3xl mx-auto bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            {{ session('message') }}
                        </div>
                        <button type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            data-dismiss="alert" aria-label="Close"
                            onclick="this.parentElement.parentElement.style.display='none'">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div
                    class="max-w-3xl mx-auto bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            {{ session('error') }}
                        </div>
                        <button type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            data-dismiss="alert" aria-label="Close"
                            onclick="this.parentElement.parentElement.style.display='none'">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <div class="max-w-3xl mx-auto  p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <form action="{{ route('coordinator.noticeStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-8 flex justify-center space-x-4 items-center align-middle">
                        <label for="phase" class="block text-gray-700 text-md font-bold dark:text-gray-300">
                            Choose Phases: <span class="text-red-500">*</span>
                        </label>
                        <div class="relative space-x-4 flex items-center">
                            <!-- Phase 1 Checkbox -->
                            <input name="phase[]" id="phase1" value="1" type="checkbox">
                            <label for="phase1"
                                class="inline-block text-lg text-gray-700 mr-1 font-semibold font-mono dark:text-gray-300">Phase
                                I</label>
                            <!-- Phase 2 Checkbox -->
                            <input name="phase[]" id="phase2" value="2" type="checkbox">
                            <label for="phase2"
                                class="inline-block text-lg text-gray-700 mr-1 font-semibold font-mono dark:text-gray-300">Phase
                                II</label>
                            <!-- Phase 3 Checkbox -->
                            <input name="phase[]" id="phase3" value="3" type="checkbox">
                            <label for="phase3"
                                class="inline-block text-lg text-gray-700 mr-1 font-semibold font-mono dark:text-gray-300">Phase
                                III</label>

                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 "></path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('phase')" class="mt-2 text-red-400" />
                        </div>
                    </div>
                    <div class="flex justify-center space-x-2 ">

                        <div class="flex space-x-3 items-center align-middle mr-6">
                            <label for="presentation-date"
                                class="block text-gray-700 text-md font-bold mb-2 dark:text-gray-300">
                                Choose Date
                            </label>
                            <input name="date" type="date" id="presentation-date" min="<?php echo date('Y-m-d'); ?>"
                                class="border px-2 py-1 rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            <input name="formatted_date" type="hidden" id="hidden-presentation-date"
                                name="hidden-presentation-date">
                            <x-input-error :messages="$errors->get('date')" class="mt-2 text-red-400" />
                        </div>
                        <div class=" flex space-x-3  items-center align-middle  ml-6">
                            <label for="presentation-time"
                                class="block text-gray-700 text-md font-bold mb-2 dark:text-gray-300">
                                Choose Time
                            </label>
                            <input name="time" type="time" id="presentation-time"
                                class="border px-2 py-1 rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            <input type="hidden" id="hidden-presentation-time" name="formatted_time">
                            <x-input-error :messages="$errors->get('time')" class="mt-2 text-red-400" />
                        </div>
                    </div>

                    <div class="mb-3 mt-6">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Notice Title: <span class="text-red-500">*</span>
                        </label>

                        <input name="title" id="title"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-400" />
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 "></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="notice" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Notice: <span class="text-red-500">*</span>
                        </label>
                        <textarea id="notice" name="notice" rows="3"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                        <x-input-error :messages="$errors->get('notice')" class="mt-2 " />
                    </div>
                    <div class="mb-4 flex flex-wrap">
                        <div id="fileInputs" class="w-full md:w-1/2 mb-2 md:mb-0">
                            <input type="file" name="file[]" multiple
                                class="mb-2 p-2 bg-gray-100 rounded-md block">
                        </div>
                        @error('file.*')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                        <div class="w-full md:w-1/2">
                            <button type="button" id="addFileInputBtn"
                                class="mb-2 flex items-center px-3 py-2 rounded-md border dark:border-gray-600 dark:text-gray-200 bg-gray-500 hover:bg-gray-600 text-white focus:outline-none focus:ring focus:border-blue-600">
                                <i class='bx bx-plus-circle text-2xl mr-2'></i>
                                <span>Add More</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const fileInputsContainer = document.getElementById('fileInputs');
        const addFileInputBtn = document.getElementById('addFileInputBtn');

        addFileInputBtn.addEventListener('click', function() {
            const fileInputWrapper = document.createElement('div');
            fileInputWrapper.classList.add('mb-2', 'flex', 'items-center', 'space-x-2');

            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'file[]';
            newFileInput.classList.add('mb-2', 'p-2', 'bg-gray-100', 'rounded-md', 'block');
            newFileInput.setAttribute('multiple', 'multiple');

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = '✖';
            removeButton.classList.add('px-3', 'py-2', 'text-lg', 'font-bold', 'text-red-600');
            removeButton.addEventListener('click', function() {
                fileInputWrapper.remove();
            });

            fileInputWrapper.appendChild(newFileInput);
            fileInputWrapper.appendChild(removeButton);
            fileInputsContainer.appendChild(fileInputWrapper);
        });

        // Get a reference to the input element and the span where you want to display the formatted date
        const inputDate = document.getElementById("presentation-date");
        const formattedDateSpan = document.getElementById("formatted-date");

        // Add an event listener to the input element to update the formatted date when the value changes
        inputDate.addEventListener("change", function() {
            const selectedDate = new Date(this.value);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = selectedDate.toLocaleDateString(undefined, options);
            formattedDateSpan.textContent = formattedDate;
        });

        function updateHiddenDate() {
            // Get the value from the presentation-date input
            const presentationDateInput = document.getElementById('presentation-date');
            const selectedDate = new Date(presentationDateInput.value);

            // Format the date as "23 September, 2023"
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = selectedDate.toLocaleDateString(undefined, options);

            // Set the formatted date in the hidden-presentation-date input
            const hiddenPresentationDateInput = document.getElementById('hidden-presentation-date');
            hiddenPresentationDateInput.value = formattedDate;
        }

        // Add an event listener to the presentation-date input
        const presentationDateInput = document.getElementById('presentation-date');
        presentationDateInput.addEventListener('input', updateHiddenDate);

        const presentationTimeInput = document.getElementById('presentation-time');
        const hiddenPresentationTimeInput = document.getElementById('hidden-presentation-time');

        // Add an input event listener to the time input
        presentationTimeInput.addEventListener('input', () => {
            const enteredTime = presentationTimeInput.value;
            if (enteredTime) {
                const formattedTime = formatTimeWithAMPM(enteredTime);
                hiddenPresentationTimeInput.value = formattedTime;
            }
        });

        // Function to format time with AM/PM
        function formatTimeWithAMPM(time) {
            const [hour, minute] = time.split(':');
            const parsedHour = parseInt(hour, 10);
            const ampm = parsedHour >= 12 ? 'PM' : 'AM';
            const formattedHour = parsedHour % 12 === 0 ? '12' : (parsedHour % 12).toString();
            return `${formattedHour}:${minute} ${ampm}`;
        }
    </script>

</x-frontend.coordinator.layouts.master>
