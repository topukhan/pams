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


                <form action="{{ route('supervisor.noticeStore') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Project Title:
                        </label>
                        <div class="relative ">
                            <select required name="title" id="title"
                                class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:bg-white focus:border-blue-500">
                                <option value="" hidden>select</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->group_id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
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
                    </div>
                    <div class="mb-3">
                        <label for="notice" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Notice:
                        </label>
                        {{-- <textarea id="notice" name="notice" rows="3" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea> --}}

                        <textarea id="myTextarea" name="notice" class="w-full h-40 border rounded-lg p-2 focus:ring-2 focus:ring-blue-500"></textarea>
                        <x-input-error :messages="$errors->get('notice')" class="mt-2 " />
                    </div>
                    <div class="mb-4 flex flex-wrap">
                        <div id="fileInputs" class="w-full md:w-1/2 mb-2 md:mb-0">
                            <input type="file" name="file[]" multiple class="mb-2 p-2 bg-gray-100 rounded-md block">
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
    </script>

    <!-- Include TinyMCE script -->
    <script src="https://cdn.tiny.cloud/1/hhnq7hg36iftaksh53bhmn6a7hme5klpc3bhi3it61fnae4q/tinymce/5/tinymce.min.js">
    </script>


    <!-- Initialize TinyMCE -->
    <script>
        tinymce.init({
            selector: '#myTextarea',
            plugins: 'autolink lists link image charmap print preview',
            formats: {
                customLink: {
                    inline: 'a',
                    styles: {
                        'color': 'blue'
                    }
                },
            },
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            skin: 'oxide',
        });
    </script>



</x-frontend.supervisor.layouts.master>
