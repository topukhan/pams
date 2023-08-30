<x-frontend.coordinator.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">
            @forelse (auth()->guard('coordinator')->user()->notifications as $notification)
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                    <a
                        href="{{ route('coordinator.proposalDetails', ['group_id' => $notification->data['group_id'], 'proposal_id' => $notification->data['proposal_id']]) }}">
                        <h3 class="text-lg font-semibold">Project Approval Request</h3>
                        <p class="text-gray-600 dark:text-gray-300">Topic: "{{ $notification->data['title'] }}"</p>
                        <p class="text-gray-600 dark:text-gray-300">Supervisor: "{{ $notification->data['supervisor_name'] }}"</p>
                    </a>
                    {{ $notification->markAsRead() }}
                </div>
            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>

</x-frontend.coordinator.layouts.master>
