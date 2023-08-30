<x-frontend.supervisor.layouts.master>

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Approved Group Details</h2>

        {{-- breadcrumb --}}
        <div class="px-4 mb-4">
            <ol class="flex text-sm justify-end text-gray-500">
                <li class="flex mr-3">
                    <a href=" {{ route('supervisor.dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                </li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3">Groups</li>
                <li class="mr-3">/ </li>
                <li class="flex mr-3"><a href="{{ route('supervisor.groupRequests') }}"
                        class="text-gray-900 dark:text-white">Approved Groups</a></li>
                <li class="mr-3">/ </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white"> Group
                        Details</a>
                </li>
            </ol>
        </div>
        <div class="flex md:w-full space-x-4">
            <div class="md:w-2/4">
                <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Group Name:</label>
                <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <p class="text-md text-gray-600 dark:text-gray-400">
                        {{ $group->name }}

                    </p>
                </div>
            </div>
            <div class="md:w-2/4">
                <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Domain:</label>
                <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <p class="text-md text-gray-600 dark:text-gray-400">
                        {{ $group->domain }}
                    </p>
                </div>
            </div>

        </div>

        <div class="md:w-full">
            <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Topic:</label>
            <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <p class="text-md text-gray-600 dark:text-gray-400">
                    {{ $group->project->title }}
                </p>
            </div>
        </div>

        <div class="md:w-full">
            <label class="ml-4 mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Description:</label>
            <div class=" px-4 py-2 mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <p class="text-md text-gray-600 dark:text-gray-400">
                    {{ $group->project->description }}
                </p>
            </div>
        </div>
        {{-- table --}}
        <div class="px-2 py-2">
            <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto shadow-lg">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-3 py-3">Sl</th>
                                <th class="px-3 py-3">Members</th>
                                <th class="px-3 py-3">ID</th>
                                <th class="px-3 py-3">Batch</th>
                                <th class="px-3 py-3">Mail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($group->groupMembers as $groupMember)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-semibold text-sm ">
                                        {{ $groupMember->user->first_name . ' ' . $groupMember->user->last_name }}
                                        @if ($groupMember->user->id == $group->leader)
                                            <span class="bg-blue-400 px-2 text-white rounded-full">Leader</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-sm ">
                                        {{ $groupMember->user->student->student_id }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">
                                        {{ $groupMember->user->student->batch }}</td>
                                    <td class="px-4 py-3 font-semibold  text-sm ">
                                        <button onclick="openModal('{{ $groupMember->user->email }}')"
                                            class="bg-blue-400 px-3  text-white rounded-md py-1">
                                            mail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="main-modal fixed w-full h-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster overflow-y-auto"
        style="background: rgba(0,0,0,.3);">
        <div class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded z-50">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="my-5 text-white">Send Email to the selected student about any project related issues</p>

                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->

                <h2 class="text-lg font-semibold mb-4">Compose Email</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">To:</label>
                    <input id="recipientEmail" type="email" class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        placeholder="Recipient's email" value="">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                    <input type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        placeholder="Enter subject">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message:</label>
                    <textarea class="w-full rounded-lg border border-gray-300 px-3 py-2" rows="4" placeholder="Email message"></textarea>
                </div>
                <!--Footer-->
                <div class="space-x-2 flex justify-end">
                    <button id="closeModal"
                        class=" focus:outline-none modal-close bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Cancel</button>
                    <button id="sendEmail"
                        class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 100);
        }

        const openModal = (recipientEmail) => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';

            const recipientInput = document.getElementById('recipientEmail');
            recipientInput.value = recipientEmail;
        }

        for (let i = 0; i < closeButton.length; i++) {

            const elements = closeButton[i];

            elements.onclick = (e) => modalClose();

            modal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            }
        }
    </script>

</x-frontend.supervisor.layouts.master>
