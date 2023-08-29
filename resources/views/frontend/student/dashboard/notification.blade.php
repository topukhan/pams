<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">
            @forelse (auth()->guard('student')->user()->notifications as $notification)
                {{-- Project Approval Notification --}}
                @if ($notification->type === 'App\Notifications\ProjectApprovalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="">
                            <h3 class="text-lg font-semibold">Your <span
                                    class="mr-1 ml-1">"{{ $notification->data['title'] }}"</span> has been Allocated.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                    <div
                        class="notification {{ $notification->unread() ? 'unread' : 'read' }} bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="{{ $notification->data['link'] }}">
                            <h3 class="text-lg font-semibold">
                                @if ($notification->unread())
                                    <span class="mr-1 ml-1 bg-blue-500 text-white rounded-full px-2 py-1">New</span>
                                @endif
                                {{ $notification->data['title'] }}
                            </h3>
                        </a>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        <div class="actions mt-2">
                            @if ($notification->unread())
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-500 hover:underline">Mark as
                                        Read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    {{-- Project Proposal Notification --}}
                @elseif ($notification->type === 'App\Notifications\ProjectProposalNotification')
                    @if ($notification->data['feedback'] === null)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold"><span class="mr-1 ml-1">
                                        {{ $notification->data['proposed_by'] }}</span> has made a Project Proposal.
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300">On: "{{ $notification->data['title'] }}"</p>
                                <p class="text-gray-600 dark:text-gray-300">To:
                                    {{ $notification->data['supervisor_name'] }}</p>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif($notification->data['feedback'] === 'suggestion')
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        {{ $notification->data['supervisor_name'] }}</span> has sent a suggestion for
                                    your project.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif($notification->data['feedback'] === 'accepted')
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        {{ $notification->data['supervisor_name'] }}</span> has accepted your project
                                    proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                @elseif($notification->type === 'App\Notifications\ProposalFeedbackNotification')
                    @if (
                        $notification->data['user_id'] ===
                            auth()->guard('supervisor')->user()->id)
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        {{ $notification->data['denied_by'] }}</span> has denied your project proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif (
                        $notification->data['user_id'] ===
                            auth()->guard('coordinator')->user()->id)
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Coordinator: <span class="mr-1 ml-1">
                                        {{ $notification->data['denied_by'] }}</span> has denied your project proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                @endif
            @empty
                <p class="text-gray-700 text-center">No notifications to display at this time.</p>
            @endforelse
        </div>
    </div>


</x-frontend.student.layouts.master>
