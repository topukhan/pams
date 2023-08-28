<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Request for Member
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white">
                        Group Member Request
                    </a>
                </li>
            </ol>
        </div>
        <div class="px-2 py-2">
            @if (!$can_request)
                <div
                    class="max-w-3xl mx-auto bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-yellow-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            {{ strtoupper('Request already sent for this group!') }}
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
            <div class="max-w-3xl mx-auto mt-4 p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <form action="{{ route('student.requestToCoordinator')}}" method="post">
                    @csrf

                    <input type="hidden" name="group_id" value="{{$group_id}}">
                    <div class="mb-6">
                        <label for="reason" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Reason:
                        </label>
                        <input id="reason" type="text" name="reason"
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                            placeholder="Click to select the reason..." onclick="toggleReason()" />
                        <div id="selectedReasonsContainer" class="flex flex-wrap mt-2"></div>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="note" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Note:
                        </label>
                        <textarea id="note" name="note" rows="2"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                    </div>
                    <div class="mb-6">
                        <button type="submit" {{ $can_request ? '' : 'disabled' }}
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const reason = document.getElementById('reason');
        const selectedReasonsContainer = document.getElementById('selectedReasonsContainer');
        let selectedReason = null;

        const availableOptions = [
            'Need more members',
            'Want to propose for project'
        ];
        function toggleReason() {
            selectedReasonsContainer.innerHTML = selectedReasonsContainer.innerHTML ? '' : availableOptions.map(option => `
                <div class="bg-blue-500 text-white px-2 py-1 rounded mr-2 mb-2 flex items-center cursor-pointer ${option === selectedReason ? 'bg-purple-600' : ''}"
                onclick="selectReason('${option}')">${option}</div>
                `).join('');
        }
        function selectReason(reason) {
            if (selectedReason === reason) {
                return;
            }
            selectedReason = reason;
            updatedSelectedReason();
            updateReason();
        }
        function updatedSelectedReason() {
            selectedReasonsContainer.innerHTML = availableOptions.map(option => `
            <div class="bg-blue-500 text-white px-2 py-1 rounded mr-2 mb-2 flex items-center cursor-pointer ${option === selectedReason ? 'bg-purple-600' : ''}"
                onclick="selectReason('${option}')">${option}</div>
        `).join('');
        }
        function updateReason() {
            reason.value = selectedReason;
        }
    </script>
</x-frontend.student.layouts.master>
