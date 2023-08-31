<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Post a Notice
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="" class="hover:text-gray-900">Dashboard</a>
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
                <form action="{{route('supervisor.noticeStore')}}" method="POST" enctype="multipart/form-data">
                    
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Project:
                        </label>
                        <div class="relative ">
                            <select name="title" id="title"
                                class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:bg-white focus:border-blue-500">
                                <option value="Default" disabled selected>select</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->group_id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 "></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="notice" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Notice:
                        </label>
                        <textarea id="notice" name="notice" rows="2" value="{{ old('notice') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                    </div>
                    <div class="mb-4">
                        <input type="file" id="file" name="file[]" multiple="multiple" class="hidden">
                        <button type="button" id="chooseFilesBtn"
                            class=" mb-2 flex items-center px-3 py-1 rounded-md border dark:border-gray-600 dark:text-gray-200 bg-gray-500 hover:bg-gray-600 text-white focus:outline-none focus:ring focus:border-blue-600">
                            <i class='bx bx-cloud-upload text-2xl mr-2'></i>
                            <span>Attach Files</span>
                        </button>
                        <div id="fileList" class="mb-2 space-y-2"></div>
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
        const fileListContainer = document.getElementById('fileList');
        const filesInput = document.getElementById('file');
        const chooseFilesBtn = document.getElementById('chooseFilesBtn');
        const addedFiles = new Set();

        chooseFilesBtn.addEventListener('click', function() {
            filesInput.click();
        });

        filesInput.addEventListener('change', function() {
            for (const file of filesInput.files) {
                if (!addedFiles.has(file.name)) {
                    addedFiles.add(file.name);

                    const fileItem = document.createElement('div');
                    fileItem.classList.add('flex', 'bg-blue-200', 'rounded-md', 'items-center', 'justify-between',
                        'mb-2', 'px-2');

                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;

                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'X';
                    removeButton.classList.add('ml-2', 'px-2', 'py-1', 'text-lg', 'text-black');
                    removeButton.addEventListener('click', function() {
                        fileItem.remove();
                        addedFiles.delete(file.name);
                    });

                    fileItem.appendChild(fileName);
                    fileItem.appendChild(removeButton);

                    fileListContainer.appendChild(fileItem);
                }
            }

            updateFileInput();
        });

        function updateFileInput() {
            filesInput.value = '';
        }
    </script>
</x-frontend.supervisor.layouts.master>
