<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">
            @forelse (auth()->guard('student')->user()->notifications as $notification)
                @if ($notification->type === 'App\Notifications\ProjectApprovalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                        <a href="">
                            <h3 class="text-lg font-semibold">Your <span
                                    class="mr-1 ml-1">"{{ $notification->data['title'] }}"</span> has been Allocated.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\ProjectProposalNotification')
                    {{-- <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                        <a href="">
                            <h3 class="text-lg font-semibold">Supervisor: <span
                                    class="mr-1 ml-1"> "{{ $notification->data['supervisor_name'] }}"</span> has accepted your project proposal.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div> --}}

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                        <a href="">
                            <h3 class="text-lg font-semibold"><span
                                    class="mr-1 ml-1"> "{{ $notification->data['proposed_by'] }}"</span> has made a Project Proposal.
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">On: "{{ $notification->data['title'] }}"</p>
                        <p class="text-gray-600 dark:text-gray-300">To: "{{ $notification->data['supervisor_name'] }}"</p>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @endif
            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>
</x-frontend.student.layouts.master>
