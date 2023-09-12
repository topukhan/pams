<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>
        @if (session('message'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-green-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        {{ strtoupper(session('message')) }}
                    </div>
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        data-dismiss="alert" aria-label="Close"
                        onclick="this.parentElement.parentElement.style.display='none'">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        @if (session('studentData') && session('studentData')->project_type_status == 0)
            <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-4 bg-red-500 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1">
                        {{ strtoupper('Add Project Type in Your Profile') }}
                    </div>
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        data-dismiss="alert" aria-label="Close"
                        onclick="this.parentElement.parentElement.style.display='none'">
                        <svg class="w-6 h-6  fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        <div class=" grid gap-10 md:grid-cols-2 xl:grid-cols-3">
            <!-- Cards -->
            <div class="grid gap-6 mb-8 xl:col-span-2  text-center md:grid-cols-1 xl:grid-cols-2">
                {{-- If not in a project --}}
                @if ($project ==  null )
                    <!--Create Group Card -->
                    <div
                        class="p-4 hover:bg-orange-50 bg-white rounded-lg shadow-xl transition  duration-200 ease-in-out dark:bg-gray-800">
                        <div
                            class="p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div class="">
                            <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                Create Your Group
                            </p>
                            <a href="{{ route('student.createGroup') }}"><button
                                    class="px-2 py-1 bg-orange-300 hover:bg-orange-500 hover:text-white transition-all rounded shadow-xl  text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-orange-500">
                                    Create
                                </button></a>
                        </div>
                    </div>
                    <!-- Genre and Supervisor Availability card -->
                    <div
                        class="p-4 hover:bg-green-50 bg-white rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                        <div
                            class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <i class='bx bxs-file text-2xl'></i>
                        </div>
                        <div>
                            <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                Genre and Supervisor Availability
                            </p>
                            <a href="{{ route('student.supervisor.availability') }}"
                                class="px-4 py-1 bg-green-300 rounded hover:bg-green-500 hover:text-white transition-all shadow-xl text-md font-semibold text-gray-700 dark:text-gray-200 dark:bg-green-500">
                                Info
                            </a>
                        </div>
                    </div>
                    <!-- Card -->
                    <div
                        class="p-4 hover:bg-blue-50 bg-white rounded-lg shadow-xl  dark:bg-gray-800 transition duration-200 ease-in-out">
                        <div
                            class="p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                            <i class='bx bxs-folder-open text-2xl'></i>
                        </div>

                        <div>
                            <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                Previous works
                            </p>
                            <a href="{{ route('student.previousProjects') }}"
                                class="px-4 py-1  bg-blue-300 hover:bg-blue-500 hover:text-white transition-all rounded shadow-xl text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-blue-500">
                                Info
                            </a>
                        </div>
                    </div>
                    <!--Proposal form  -->
                    <div
                        class="p-4 hover:bg-teal-50 bg-white rounded-lg shadow-xl  dark:bg-gray-800 transition duration-200 ease-in-out">
                        <div
                            class="p-3 mb-4 w-12 mx-auto text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                            <i class="bx bx-news text-2xl"></i>

                        </div>

                        <div>
                            <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                Proposal Form
                            </p>
                            <a href="{{ route('student.proposalForm') }}"><button
                                    class="px-3 py-1  bg-teal-200 hover:bg-teal-500 hover:text-white transition-all rounded shadow-xl text-md font-semibold text-gray-700 dark:text-gray-200  dark:bg-teal-500">
                                    View
                                </button></a>
                        </div>
                    </div>
                @endif
                {{-- Already have a project --}}
                @if ($project != null)
                    <div class="grid gap-6 mb-8 xl:col-span-2  text-center md:grid-cols-1 xl:grid-cols-2">
                        <!-- Project Overview Card -->
                        <div class="p-4 bg-white hover:bg-blue-100 cursor-pointer rounded-lg shadow-xl transition duration-200 ease-in-out dark:bg-gray-800">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-200 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <i class="bx bx-comment-detail text-2xl"></i>
                            </div>                            
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    My Project
                                </p>
                                <a href="{{route('student.myProject')}}"
                                    class="px-4 py-1 bg-blue-300 rounded shadow-lg hover:bg-blue-500 hover:text-white transition-all  text-md font-semibold text-gray-700 dark:text-gray-500 dark:bg-blue-500">
                                    View
                                </a>
                            </div>
                        </div>
                        <!-- Change Proposal Card -->
                        <div class="p-4 bg-white hover:bg-green-100  rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-200 rounded-full dark:text-green-100  dark:bg-green-500">
                                <i class="bx bxs-file text-2xl "></i>
                            </div>
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    Change Proposal
                                </p>
                                <a href="{{ route('student.proposalChangeForm', $project) }}">
                                    <button class="bg-green-400 hover:bg-green-600 shadow-lg transition duration-200 ease-in-out text-white px-4 py-1 text-md font-semibold dark:text-gray-600 rounded">Form</button>
                                </a>
                            </div>
                        </div>
                        <!-- Communication Hub Card (Chat) -->
                        <div
                            class="p-4 bg-white hover:bg-purple-100 rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-purple-500 bg-purple-200 rounded-full dark:text-purple-100 dark:bg-purple-500">
                                <i class="bx bxs-chat text-2xl"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    Communication Hub (Chat)
                                </p>
                                <!-- Add a chat interface for project communication -->
                                <a href="#"
                                    class="px-4 py-1 bg-purple-300 rounded hover:bg-purple-500 shadow-lg hover:text-white transition-all shadow text-md font-semibold text-gray-700 dark:text-gray-500 dark:bg-purple-500">
                                    Open Chat
                                </a>
                            </div>
                        </div>
                        <!-- Meetings and Calendar Card -->
                        <div
                            class="p-4 bg-white hover:bg-orange-100 cursor-pointer rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-orange-500 bg-orange-200 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <i class="bx bxs-calendar text-2xl"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    Meetings and Calendar
                                </p>
                                <!-- Display upcoming meetings and events -->
                                <ul class="text-md text-gray-700 dark:text-gray-200">
                                    <li>Meeting with Supervisor - Aug 25, 2023</li>
                                    <li>Project Presentation - Sept 10, 2023</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Project Resources Card -->
                        <div
                            class="p-4 bg-white hover:bg-green-100 cursor-pointer rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-green-500 bg-green-200 rounded-full dark:text-green-100 dark:bg-green-500">
                                <i class="bx bxs-book-open text-2xl"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    Project Resources
                                </p>
                                <!-- Display links to project-related resources -->
                                <ul class="text-md text-gray-700 dark:text-gray-200">
                                    <li><a href="#">Research Paper</a></li>
                                    <li><a href="#">Tutorial Videos</a></li>
                                    <li><a href="#">Coding Guidelines</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Project Journal/Blog Card -->
                        <div
                            class="p-4 bg-white hover:bg-blue-100  rounded-lg shadow-xl dark:bg-gray-800 transition duration-200 ease-in-out">
                            <div
                                class="flex items-center justify-center p-3 mb-4 w-12 mx-auto text-blue-500 bg-blue-200 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <i class="bx bx-library text-2xl"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                                    Project Journal/Blog
                                </p>
                                <!-- Add a section for students to write and document their project journey -->
                                <a href="#"
                                    class="px-4 py-1 bg-blue-300 rounded hover:bg-blue-500 hover:text-white transition-all shadow text-md font-semibold text-gray-700 dark:text-gray-200 dark:bg-blue-500">
                                    Write Journal
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
          {{-- Notice --}}
            <div class="mb-8 py-4 px-6 h-[60vh] overflow-y-auto bg-white rounded shadow float-right dark:bg-gray-800">
                <h2 class="mb-2 font-medium text-gray-700 dark:text-gray-400">
                    Notice
                </h2>
                {{-- Notice Card --}}
                @foreach ($notices as $notice)
                <div
                    class="mb-4 p-4 hover:bg-gray-100 bg-gray-50 rounded shadow-xl dark:bg-gray-700 dark:hover:bg-gray-800 transition duration-200 ease-in-out">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{$notice->notice}}
                        </p>
                        <button
                            class="px-2 py-1 text-sm bg-blue-200 rounded shadow-lg text-md font-semibold text-gray-700 dark:text-gray-200 dark:bg-blue-500 flex ">
                            View
                        </button>
                    </div>
                </div>
                @endforeach
              
            </div>
        </div>
    </div>
    <script>
        function dismissAlert() {
            var alert = document.getElementById('alert');
            alert.style.display = 'none';
        }
    </script>
</x-frontend.student.layouts.master>
