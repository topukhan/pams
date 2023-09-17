<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Upcoming Events </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.upcomingEvents') }}" class="text-gray-900 dark:text-white"> Upcoming
                        Events</a>
                </li>
            </ol>
        </div>

        {{-- table --}}
        <div class="px-2 py-2 ">
            <div class="max-w-3xl mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Defense</h2>
                    <p class="text-gray-600 text-sm mt-2">Posted on September 14, 2023</p>
                    <hr class="my-4 border-gray-300 mt-2">
                    <p class="text-gray-700 mt-5">Aenean cursus dictum justo nec faucibus. Nullam laoreet elit nec
                        venenatis gravida. Fusce id diam a ipsum blandit feugiat a vitae ipsum.Aenean cursus dictum justo nec faucibus. Nullam laoreet elit nec
                        venenatis gravida. Fusce id diam a ipsum blandit feugiat a vitae ipsum.</p>

                    <hr class="my-4 mt-5 border-gray-300">
                    <p class="text-gray-600 flex justify-end text-sm mt-2">On: September 25, 2023</p>
                    <p class="text-gray-600 flex justify-end text-sm mt-2">At: 11 AM</p>
                </div>
            </div>
        </div>

    </div>





</x-frontend.student.layouts.master>
