<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            View Notice
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
            <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800 mt-8">
                <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                    From : <span>{{$notice->user->first_name.' '.$notice->user->last_name}} </span>
                </label>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                        Notice:
                    </label>
                    <p > {{$notice->notice}}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">Attached Files:</label>
                    <ul class="pl-2">
                        @foreach ($notice->files as $file )
                        <li class="px-4 py-2 bg-blue-200 rounded-md mb-2">  <a href="{{ asset('storage/files/' . $file->filename) }}" class="text-blue-800 hover:underline">
                            {{ $file->filename }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
</x-frontend.student.layouts.master>
