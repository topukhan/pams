<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Final Year Project Proposal Form </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.proposalForm') }}" class="text-gray-900 dark:text-white">Proposal Form</a>
                </li>
            </ol>
        </div>
        @if ($proposalSubmitted)
            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow" id="alert">
                Proposal already submitted for your group!
                <button type="button" class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                    onclick="this.parentElement.style.display ='none'">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
        @endif
        @if ($in_project)
            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow" id="alert">
                Project already Allocated for your group!
                <button type="button" class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                    onclick="this.parentElement.style.display ='none'">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
        @endif


        @if ($group)
            @if ($group->can_propose == 0)
                <div
                    class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md my-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-4 bg-yellow-500 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            {{ strtoupper("Your Group doesn't Have Enough Members to Propose!") }}
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
            {{-- form --}}
            <div class="px-2 py-2">
                <div class="p-8 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <form action="{{ route('student.store.proposalForm') }}" method="POST">
                        @csrf
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="group">
                                    Group
                                </label>
                            </div>
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <div class="md:w-3/4">

                                <input disabled
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                    id="group_id" name="group_id" type="text" value="{{ $group->name }}">

                            </div>
                        </div>
                        {{-- Title --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="title">
                                    Project/Thesis Title :
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input "
                                    id="title" name="title" type="text" value=""
                                    placeholder="Enter title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>
                        {{-- Course/Subject --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="course">
                                    Course/Subject :
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                    id="course" name="course" type="text" value=""
                                    placeholder="e.g., PROJECT-1">
                                <x-input-error :messages="$errors->get('course')" class="mt-2" />
                            </div>
                        </div>
                        {{-- Supervisor --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="my-select">
                                    Supervisor
                                </label>

                            </div>
                            <div class="md:w-3/4">
                                <select name="supervisor_id"
                                    class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                                    id="supervisor">
                                    <option value="Default" disabled selected>select</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->user->id }}"
                                            @isset($selected_supervisor)
                                            {{ $supervisor->user->id == $selected_supervisor->id ? 'selected' : '' }}
                                            @endisset>
                                            {{ $supervisor->user->first_name . ' ' . $supervisor->user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('supervisor')" class="mt-2" />
                            </div>
                        </div>
                        
                        {{-- Domain --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="my-select">
                                    Domain
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <select name="domain"
                                    class="form-select block w-full focus:bg-white bg-gray-100 rounded-md border-none text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                                    id="domain">

                                    <option value="0" selected disabled>select domain</option>
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->name }}"
                                            {{ $sup_dom_name == $domain->name ? 'selected' : '' }}>
                                            {{ $domain->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                            </div>
                        </div>
                        {{-- Project Type --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <span class="text-gray-700 font-semibold dark:text-gray-300">
                                    Project Type :
                                </span>
                            </div>
                            <div class="md:w-3/4 pl-5">
                                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                        name="project_type" value="project" />
                                    <span class="ml-2 ">Project</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray dark:bg-gray-700 border-separate"
                                        name="project_type" value="thesis" />
                                    <span class="ml-2 ">Thesis</span>
                                </label>
                                <x-input-error :messages="$errors->get('project_type')" class="mt-2" />
                            </div>
                        </div>
                        {{-- Description --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/4">
                                <label
                                    class="block text-gray-600 dark:text-gray-300 font-semibold md:text-left mb-3 md:mb-0 pr-4"
                                    for="description">
                                    Description
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <textarea
                                    class="w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray focus:bg-white bg-gray-100 rounded-md border-none form-input"
                                    id="description" name="description" placeholder="Enter Project Details"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                        {{-- submit button --}}
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/4"></div>
                            <div class="md:w-3/4">
                                <button
                                    class="shadow bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                    type="submit"{{ $proposalSubmitted ? 'disabled' : '' }}
                                    {{ $group->can_propose == 0 ? 'disabled' : '' }}
                                    {{ $in_project ? 'disabled' : '' }}>
                                    Submit
                                </button>
                                @if (false)
                                    <a class="md:ml-5 shadow bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                                        href=" {{ route('student.proposalChangeForm') }}">
                                        Change topic
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="relative top-1/4  w-full bg-yellow-200 text-red-700 px-4 py-4 rounded-lg shadow"
                id="alert">
                {{ strtoupper("You Don't Have a Group, Create a Group") }}!
                <button type="button"
                    class="absolute ml-2 right-6 text-red-700 hover:text-red-900 focus:outline-none"
                    onclick="this.parentElement.style.display ='none'">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div><br>
            <div class="md:w-1/4 mt-4">
                <a class="md:ml-5 shadow bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline-purple text-white font-semibold py-2 px-4 mt-4 rounded"
                    href=" {{ route('student.createGroup') }}">
                    Create Group
                </a>
            </div>

        @endif
    </div>
</x-frontend.student.layouts.master>
