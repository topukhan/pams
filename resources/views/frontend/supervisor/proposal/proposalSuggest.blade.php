<x-frontend.supervisor.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Suggest New Proposal
        </h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/</li>
                <li>
                    <a href="" class="text-gray-900 dark:text-white">
                        Suggest New Proposal
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
            <div class="max-w-3xl mx-auto mt-4 p-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <form action="{{ route('supervisor.proposalResponse')}}" method="POST">
                    @csrf
                    <input type="hidden" name="group_id" value="{{ $group_id}}">
                    <input type="hidden" name="proposal_id" value="{{ $proposal_id}}">
                    <div class="mb-6">
                        <label for="suggest" class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">
                            Suggest:
                        </label>
                        <textarea id="suggest" name="suggest" rows="2" value="{{ old('suggest') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                        {{-- <x-input-error :messages="$errors->get('suggest')" class="mt-2"/> --}}
                        {{-- <x-input-error :messages="$errors->get('suggest')" class="mt-2"/> --}}
                        </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Send
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

   
</x-frontend.supervisor.layouts.master>
