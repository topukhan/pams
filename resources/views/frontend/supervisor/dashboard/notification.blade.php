<x-frontend.supervisor.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">

            @forelse (auth()->guard('supervisor')->user()->notifications as $notification)
                {{-- Project Proposal Notification --}}
                @if ($notification->type === 'App\Notifications\ProjectProposalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a
                            href="{{ route('supervisor.proposalDetails', ['group_id' => $notification->data['group_id'], 'proposal_id' => $notification->data['proposal_id']]) }}">
                            <h3 class="text-lg font-semibold">A Group Sent You A Project Proposal</h3>
                            <p class="text-gray-600 dark:text-gray-300">Topic: "{{ $notification->data['title'] }}"</p>
                        </a>
                        {{ $notification->markAsRead() }}

                    </div>
                    {{-- Project Approval Notification --}}
                @elseif ($notification->type === 'App\Notifications\ProjectApprovalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{ route('supervisor.approvedGroups') }}">
                            <h3 class="text-lg font-semibold">"{{ $notification->data['title'] }}" has been allocated to
                                you.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\ProposalFeedbackNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{ route('supervisor.approvedGroups') }}">
                            <h3 class="text-lg font-semibold">
                                {{ ucfirst($notification->data['role']) . ': "' . $notification->data['denied_by'] }}"
                                has
                                denied A Project Proposal You were Accepted.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\ProposalSuggestionCanceledNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{ route('supervisor.proposalList') }}">
                            <h3 class="text-lg font-semibold">
                                Group:"{{ ucfirst($notification->data['group_name']) . '" ' . $notification->data['message'] }}.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\SupervisorReallocationNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md cursor-pointer"
                        title="Click to view details" data-modal-toggle="example" data-modal-action="open">

                        <h3 class="text-lg font-semibold">A project is allocated to another supervisor .</h3>

                        {{ $notification->markAsRead() }}
                    </div>
                    {{-- modal for project reallocated to another supervisor --}}
                    <div data-modal="example"
                        class="invisible opacity-0 fixed inset-0 w-full h-full z-20 outline-none overflow-x-hidden overflow-y-auto transition-all"
                        style="transition-duration: 500ms;">
                        <div data-modal-toggle="example" data-modal-action="close"
                            class="fixed inset-0 w-full h-full bg-black bg-opacity-50"></div>
                        <div data-modal-main="example"
                            class="modal relative w-auto my-8 mx-4 pointer-events-none transition-all duration-300 transform -translate-y-full">
                            <div
                                class="relative shadow-lg rounded-md w-full pointer-events-auto bg-white text-gray-800 max-w-screen-sm mx-auto">
                                <header class="flex items-center justify-between p-4">
                                    <div><span class="font-semibold" id="exampleHeader">Header </span><span class="font-semibold">{{auth()->guard('supervisor')->user()->first_name}},</span></div>
                                    
                                    <button data-modal-toggle="example" data-modal-action="close"
                                        class="transition-colors hover:bg-gray-50 focus:ring focus:outline-none p-2 rounded-full">
                                        <svg class="fill-current" width="18" height="18" html
                                            viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                    </button>
                                </header>
                                <h2 class="px-4">Regarding project: "<span class="font-semibold">
                                       {{ $notification->data['title'] }}
                                </span>"</h2>
                                <main class="p-4 text-center" style="text-align: justify">
                                    <p>
                                        
                                        @php
                                            echo $notification->data['message'];
                                        @endphp
                                    </p>
                                </main>
                                <footer class="flex justify-end p-2">
                                    <button data-modal-toggle="example" data-modal-action="close"
                                        class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300">
                                        Ok
                                    </button>
                                </footer>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>


    <script>
        const modal = (el) => {
            const toggle = (wrapperEl, mainEl) => {
                document.querySelector('body').classList.toggle('overflow-y-hidden');
                wrapperEl.classList.toggle('opacity-100');
                wrapperEl.classList.toggle('opacity-0');
                wrapperEl.classList.toggle('visible');
                wrapperEl.classList.toggle('invisible');
                mainEl.classList.toggle('-translate-y-full');
                mainEl.classList.toggle('translate-y-0')
            };

            const extractElements = (target) => {
                const wrapper = document.querySelector(`[data-modal='${target}']`);
                const modal = wrapper.querySelector('[data-modal-main]');
                return {
                    wrapper,
                    modal
                };
            };

            const showEvent = new CustomEvent('show', {
                detail: {},
                bubbles: true,
                cancelable: true,
                composed: false,
            });

            const hideEvent = new CustomEvent('hide', {
                detail: {},
                bubbles: true,
                cancelable: true,
                composed: false,
            });

            if (!document.querySelector('[data-modal-toggle]')) {
                return;
            }

            if (!document.querySelector('[data-modal')) {
                return;
            }

            [...document.querySelectorAll('[data-modal-toggle]')].forEach((btn) =>
                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    const action = btn.getAttribute('data-modal-action');
                    const target = btn.getAttribute('data-modal-toggle');
                    const {
                        wrapper,
                        modal
                    } = extractElements(target);

                    if (action === 'open') {
                        modal.dispatchEvent(showEvent);
                    }
                    if (action === 'close') {
                        modal.dispatchEvent(hideEvent);
                    }
                    toggle(wrapper, modal);
                })
            );
        };

        // init
        modal();

        // Custom event listeners

        // This event fires immediately before the modal is start showing
        document.querySelector('[data-modal="example"]').addEventListener('show', (event) => {
            const sayHi = ['Hello '];
            const randomNum = Math.floor(Math.random() * sayHi.length);
            document.querySelector('#exampleHeader').innerText = sayHi[randomNum];
            console.log('show');
        });

        // This event is fired immediately before modal is start hidding
        document.querySelector('[data-modal="example"]').addEventListener('hide', (event) => {
            console.log('hide');
        });
    </script>
</x-frontend.supervisor.layouts.master>
