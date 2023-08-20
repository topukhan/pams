<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Final Year Project Re-Proposal Form </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.proposalChangeForm') }}" class="text-gray-900 dark:text-white">Proposal Form</a>
                </li>
            </ol>
        </div>

        {{-- form --}}
        <div class="px-2 py-2">
            <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="#">
                    {{-- New Title --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-textfield">
                                New Project/Thesis Title :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input text-gray-500"
                                id="my-textfield" type="text" value="" placeholder="Enter new title">
                        </div>
                    </div>

                    {{-- Old Title --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-textfield">
                                Old Project/Thesis Title :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input text-gray-500"
                                id="my-textfield" type="text" value="Old title" disabled>
                        </div>
                    </div> 

                    {{-- Course/Subject --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                for="course">
                                Course/Subject :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input text-gray-500"
                                id="course" type="text" value="Course from db" disabled>
                        </div>
                    </div>

                    {{-- Supervisor --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                                Supervisor :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name=""
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:text-gray-300 dark:bg-gray-700"
                                id="my-select">
                                <option value="Default" disabled selected>select</option>
                                <option value="">Rezwana</option>
                                <option value="">Karim</option>
                                <option value="">Rezuko</option>
                            </select>

                        </div>
                    </div>

                    {{-- Domain --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <label class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                                Domain :
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name=""
                                class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-500 dark:bg-gray-700 dark:text-gray-300"
                                id="my-select">
                                <option value="" selected disabled>select domain</option>
                                <option value="">Software Application</option>
                                <option value="">Networking</option>
                                <option value="">Research</option>
                                <option value="">Robotics</option>
                                <option value="">Electronics & Digital Logic</option>
                            </select>
                        </div>
                    </div>

                    {{-- Type --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/4">
                            <span class="text-gray-700 dark:text-gray-300 font-semibold ">
                                Type :
                            </span>
                        </div>
                        <div class="md:w-3/4 pl-5">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="type" value="" />
                                <span class="ml-2 ">Project</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio"
                                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                    name="type" value="" />
                                <span class="ml-2 ">Thesis</span>
                            </label>
                        </div>
                    </div>
                    
                    {{-- submit button --}}
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/4"></div>
                        <div class="md:w-3/4">
                            <button
                                class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                type="button">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>





        </div>
        </form>
    </div>



</x-frontend.student.layouts.master>
