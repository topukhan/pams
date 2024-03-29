<x-frontend.student.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Assistance </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('student.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="{{ route('student.assistance') }}" class="text-gray-900 dark:text-white"> Assistance </a>
                </li>
            </ol>
        </div>


        <div class="px-2 py-2 ">
            <div class="max-w-4xl mx-auto mt-3 px-8 py-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
                <form action="#" method="">
                    <div class="mb-6">
                        <label for="subject"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Subject:</label>
                        <input type="text" id="subject" name="subject"
                            class="w-full px-4 py-2 border-gray-300 dark:border-gray-500 dark:bg-gray-700 rounded-lg shadow-lg focus:outline-none focus:ring focus:border-blue-600"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="message"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Message:</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full px-4 py-2 border-gray-300 dark:border-gray-500 dark:bg-gray-700 rounded-lg shadow-lg focus:outline-none focus:ring focus:border-blue-600"
                            required></textarea>
                    </div>
                    <div class="mb-2">
                        <button type="submit"
                            class="px-8 py-2 bg-blue-500 text-white font-semibold rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-frontend.student.layouts.master>
