<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add Publications and Research Work
        </h3>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">
                        Research Work
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
            <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <form action="{{route('supervisor.citationStore')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="citation" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Publications:
                        </label>
                        <div class="flex mb-1">
                            <label for="citation" class="form-input rounded-md bg-gray-200 border-none text-black text-sm font-bold mr-2 dark:text-gray-300">
                                1.
                            </label>
                            <input name="citation[]" type="text" placeholder="Enter Your Citation Here"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                                
                                    <button type="button" class="ml-2 p-2 text-white text-2xl font-bold rounded-md " onclick="removeCitationRow(this)"> &minus;
                                </button>
                        </div>
                    </div>
                    <div id="additionalCitations"></div>
                    <div class="mb-6 flex justify-end space-x-2">
                    <button type="button" id="addCitationButton"
                        class="px-4 py-2 bg-blue-400 text-white font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        +
                    </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Post
                        </button>
                    </div>
                </form>
            </div>
            <script>
                const additionalCitationsContainer = document.getElementById('additionalCitations');
                const addCitationButton = document.getElementById('addCitationButton');
                let citationIndex = 1;
        
                addCitationButton.addEventListener('click', () => {
                    const newCitationRow = document.createElement('div');
                    newCitationRow.className = 'mb-3';
                    
                    const rowContent = `
                        <div class="flex mb-1">
                            <label for="citation" class="form-input rounded-md bg-gray-200 border-none text-black text-sm font-bold mr-2 dark:text-gray-300">
                                ${citationIndex + additionalCitationsContainer.children.length + 1}.
                            </label>
                            <input name="citation[]" type="text" placeholder="Enter Your Citation Here"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <button type="button" class="ml-2 p-2 text-red-500 text-2xl font-bold rounded-md"
                                    onclick="removeCitationRow(this)">
                                &minus;
                            </button>
                        </div>
                    `;
                    
                    newCitationRow.innerHTML = rowContent;
                    additionalCitationsContainer.appendChild(newCitationRow);
                });
        
                function removeCitationRow(button) {
                    const rowToRemove = button.parentNode;
                    additionalCitationsContainer.removeChild(rowToRemove.parentNode);
                    // Update the numbering
                    const rows = additionalCitationsContainer.querySelectorAll('.flex.mb-1');
                    rows.forEach((row, index) => {
                        row.querySelector('label').textContent = `${index + 2}.`;
                    });
                }
            </script>
</x-frontend.supervisor.layouts.master>
