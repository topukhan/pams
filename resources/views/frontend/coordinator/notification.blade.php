<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">
            @forelse (auth()->guard('coordinator')->user()->notifications as $notification)
                @if ($notification->type == 'App\Notifications\ProjectProposalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a
                            href="{{ route('coordinator.proposalDetails', ['group_id' => $notification->data['group_id'], 'proposal_id' => $notification->data['proposal_id']]) }}">
                            <h3 class="text-lg font-semibold dark:text-gray-300">Project Approval Request</h3>
                            <p class="text-gray-600 dark:text-gray-300">Topic: "{{ $notification->data['title'] }}"</p>
                            <p class="text-gray-600 dark:text-gray-300">Supervisor:
                                "{{ $notification->data['supervisor_name'] }}"</p>
                            <div class="flex justify-between">
                                <p class="text-gray-600 dark:text-gray-300"></p>
                                <span
                                    class="text-gray-500">{{ \Carbon\Carbon::parse($notification->created_at)->addHours(6)->format('d-M-Y h:i A') }}</span>
                            </div>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type == 'App\Notifications\GroupRequestToCoordinator')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a
                            href="{{ route('coordinator.requestGroupMembersDetails', ['group' => $notification->data['group_id'], 'request' => $notification->data['request_id']]) }}">

                            <h3 class="text-lg font-semibold dark:text-gray-300">A Group Requested To you</h3>
                            <div class="flex justify-between">
                                <p class="text-gray-600 dark:text-gray-300">View details</p>
                                <span class="text-gray-500">{{ $notification->created_at }}</span>
                            </div>


                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif ($notification->type == 'App\Notifications\IndividualRequestToCoordinator')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a
                            href="{{ route('coordinator.requestDetails', ['request' => $notification->data['request_id']]) }}">
                            <h3 class="text-lg font-semibold dark:text-gray-300">A Student Sent you a request</h3>
                            <p class="text-gray-600 dark:text-gray-300">reason: "Group Needed"</p>
                            <div class="flex justify-between">
                                <p class="text-gray-600 dark:text-gray-300">Student:
                                    {{ $notification->data['student_name'] }}"</p>
                                <span class="text-gray-500">{{ $notification->created_at }}</span>
                            </div>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @endif

            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>

</x-frontend.coordinator.layouts.master>
