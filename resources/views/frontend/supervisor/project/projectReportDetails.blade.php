<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Report Details
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('supervisor.dashboard') }}"
                        class="text-gray-900 dark:hover:text-gray-200 dark:text-gray-400">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:hover:text-gray-200 dark:text-gray-400">
                        Report Details
                    </a>
                </li>
            </ol>
        </div>

        <div class="px-2 py-2">
            <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800 mt-8">

                <div class="mb-3">
                    @if ($project_report->title)
                        <label class=" text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Title:
                        </label>
                        <span class="text-gray-700 dark:text-gray-300">{{ $project_report->title }}</span>
                    @endif
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                        Description:
                    </label>

                    <p class="text-gray-700 dark:text-gray-300"> {{ $project_report->description }}</p>

                </div>

                @if ($project_report->files->count() > 0)
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">Attached
                            Files:</label>
                        <ul>
                            @foreach ($project_report->files as $file)
                                <a href="{{ asset('storage/projectReports/' . $file->filename) }}"
                                    class="text-blue-800 hover:underline" download>
                                    <li class="px-4 py-2 bg-blue-200 rounded-md mb-2">
                                        {{ $file->filename }}
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="max-w-3xl  space-x-4 bg-transparent">
                    <div>
                        <div class="relative">
                            <form action="#" >
                                <textarea class="rounded-md w-full h-fit border-gray-400 pl-4 pr-12 py-2" type="text" name="feedback" id="feedback"
                                    placeholder="Write a feedback..."></textarea>
                                <button type="submit"
                                    class="px-4 py-2 mt-4 text-md font-semibold  text-white bg-purple-600 hover:bg-purple-800 shadow-xl rounded-xl">
                                    Give Feedback
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


</x-frontend.supervisor.layouts.master>
