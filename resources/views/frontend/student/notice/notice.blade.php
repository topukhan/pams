<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            View Notice
        </h2>
        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}"
                        class="text-gray-900 dark:hover:text-gray-200 dark:text-gray-400">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:hover:text-gray-200 dark:text-gray-400">
                        Notice
                    </a>
                </li>
            </ol>
        </div>
        <div class="px-2 py-2">
            <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800 mt-8">
                <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                    From : <span>{{ $notice->user->first_name . ' ' . $notice->user->last_name }} </span>
                </label>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                        Notice:
                    </label>
                    <p class="text-gray-700 dark:text-gray-300"> {{ $notice->notice }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">Attached Files:</label>
                    <ul>
                        @foreach ($notice->files as $file)
                            <a href="{{ asset('storage/notices/' . $file->filename) }}"
                                class="text-blue-800 hover:underline" download>
                                <li class="px-4 py-2 bg-blue-200 rounded-md mb-2">
                                    {{ $file->filename }}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
</x-frontend.student.layouts.master>
