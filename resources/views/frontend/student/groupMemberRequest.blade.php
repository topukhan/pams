<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Request for Member </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.groupMemberRequest') }}" class="text-gray-900 dark:text-white"> Group
                        Member Request </a>
                </li>
            </ol>
        </div>


        <div class="px-2 py-2">
            <div class="max-w-3xl mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg">
                <form action="#" method="">
                    <div class="mb-6">
                        <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Reason:</label>
                        <input id="reason" type="text"
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:border-blue-500"
                            placeholder="Click to select the reason..." onclick="toggleReason()" />
                        <div id="selectedReasonsContainer" class="flex flex-wrap mt-2"></div>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Note:</label>
                        <textarea id="message" name="message" rows="2"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600"></textarea>
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg">Submit</button>
                    </div>
                </form>


                <script>
                    const reason = document.getElementById('reason');
                    const selectedReasonsContainer = document.getElementById('selectedReasonsContainer');
                    let selectedReason = null;

                    const availableOptions = [
                        'No members available',
                        'A few members short',
                        
                      
                    ];

                    function toggleReason() {
                        if (selectedReasonsContainer.innerHTML === '') {
                            availableOptions.forEach(reason => {
                                const reasonBadge = document.createElement('div');
                                reasonBadge.textContent = reason;
                                reasonBadge.className =
                                    'bg-blue-500 text-white px-2 py-1 rounded mr-2 mb-2 flex items-center cursor-pointer';
                                reasonBadge.addEventListener('click', () => selectReason(reason));
                                selectedReasonsContainer.appendChild(reasonBadge);
                            });
                        } else {
                            selectedReasonsContainer.innerHTML = '';
                        }
                    }

                    function selectReason(reason) {
                        if (selectedReason === reason) {
                            return; // Prevent selecting the same reason again
                        }

                        selectedReason = reason;
                        updatedSelectedReason();
                        updateReason();
                    }

                    function updatedSelectedReason() {
                        selectedReasonsContainer.innerHTML = '';
                        availableOptions.forEach(reason => {
                            const reasonBadge = document.createElement('div');
                            reasonBadge.textContent = reason;
                            reasonBadge.className =
                                'bg-blue-500 text-white px-2 py-1 rounded mr-2 mb-2 flex items-center cursor-pointer';
                            reasonBadge.addEventListener('click', () => selectReason(reason));

                            if (reason === selectedReason) {
                                reasonBadge.classList.add('bg-purple-600');
                            }

                            selectedReasonsContainer.appendChild(reasonBadge);
                        });
                    }

                    function updateReason() {
                        reason.value = selectedReason;
                    }
                </script>







            </div>
        </div>





    </div>







</x-frontend.student.layouts.master>
