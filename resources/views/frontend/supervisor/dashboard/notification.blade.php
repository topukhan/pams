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
                        <a href="{{route('supervisor.approvedGroups')}}">
                            <h3 class="text-lg font-semibold">"{{ $notification->data['title'] }}" has been allocated to you.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\ProposalFeedbackNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{route('supervisor.approvedGroups')}}">
                            <h3 class="text-lg font-semibold">{{ucfirst($notification->data['role']).': "' .$notification->data['denied_by'] }}" has denied A Project Proposal You were Accepted.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type === 'App\Notifications\ProposalSuggestionCanceledNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{route('supervisor.proposalList')}}">
                            <h3 class="text-lg font-semibold">Group:"{{ucfirst($notification->data['group_name']).'" ' .$notification->data['message'] }}.</h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @endif
            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>

</x-frontend.supervisor.layouts.master>
