<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notifications
        </h2>
        <div class="px-2 py-2">
            @forelse (auth()->guard('student')->user()->notifications as $notification)
                {{-- Project Approval Notification --}}
                @if ($notification->type == 'App\Notifications\GroupCreateNotification')
                    @if ($notification->data['feedbacks'] == 1)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                            <a href="{{ route('student.groupRequest') }}">
                                <h3 class="text-lg font-semibold"><span
                                        class="mr-1 ml-1">{{ $notification->data['request_from'] }}</span> sent you a
                                    Group
                                    Request.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif ($notification->data['feedbacks'] > 1)
                        @if ($notification->data['status'] == 1)
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                                <a href="{{ route('student.groupRequest') }}">
                                    <h3 class="text-lg font-semibold"><span
                                            class="mr-1 ml-1">{{ $notification->data['request_from'] }}</span> Accepted
                                        Group
                                        Request.
                                    </h3>
                                </a>
                                {{ $notification->markAsRead() }}
                            </div>
                        @elseif ($notification->data['status'] == 2)
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                                <a href="{{ route('student.groupRequest') }}">
                                    <h3 class="text-lg font-semibold"><span
                                            class="mr-1 ml-1">{{ $notification->data['request_from'] }}</span> Rejected
                                        Group
                                        Request.
                                    </h3>
                                </a>
                                {{ $notification->markAsRead() }}
                            </div>
                        @endif
                    @endif
                    {{-- Project Approval Notification --}}
                @elseif ($notification->type == 'App\Notifications\ProjectApprovalNotification')
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                        <a href="">
                            <h3 class="text-lg font-semibold">Your <span
                                    class="mr-1 ml-1">"{{ $notification->data['title'] }}"</span> has been
                                Allocated.
                            </h3>
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                    {{-- Project Proposal Notification --}}
                @elseif ($notification->type == 'App\Notifications\ProjectProposalNotification')
                    @if ($notification->data['feedback'] === null)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-2 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold"><span>
                                        {{ $notification->data['proposed_by'] }}</span> has made a Project Proposal.
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300">On: "{{ $notification->data['title'] }}"
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">To:
                                    {{ $notification->data['supervisor_name'] }}</p>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif($notification->data['feedback'] == 'suggestion')
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        {{ $notification->data['supervisor_name'] }}</span> has sent a suggestion
                                    for
                                    your project.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif($notification->data['feedback'] == 'accepted')
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        "{{ $notification->data['supervisor_name'] }}"</span> has accepted your
                                    project
                                    proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                @elseif($notification->type == 'App\Notifications\ProposalFeedbackNotification')
                    @if ($notification->data['role'] == "supervisor")
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Supervisor: <span class="mr-1 ml-1">
                                        "{{ $notification->data['denied_by'] }}"</span> has denied your project
                                    proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif ($notification->data['role'] == "coordinator")
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.proposalStatus') }}">
                                <h3 class="text-lg font-semibold">Coordinator: <span class="mr-1 ml-1">
                                       "{{ $notification->data['denied_by'] }}"</span> has denied your project
                                    proposal.
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                    {{-- when individual request for a group to coordinator and added to a group --}}
                @elseif($notification->type == 'App\Notifications\RequestedStudentAddedToGroup')
                    @if (
                        $notification->data['requested_student_id'] ==
                            auth()->guard('student')->user()->id)
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.myGroup') }}">
                                <h3 class="text-lg font-semibold">You are added to a group</h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @elseif (
                        $notification->data['group_member_id'] ==
                        auth()->guard('student')->user()->id)
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.myGroup') }}">
                                <h3 class="text-lg font-semibold">A member Added to you group
                                </h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                @elseif($notification->type == 'App\Notifications\GroupUpdateNotification')
                    @if ($notification->data['added'] == true)
                    @if ($notification->data['receiver'] == false)
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.myGroup') }}">
                                <h3 class="text-lg font-semibold">You were placed in a group</h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @else
                        <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                            <a href="{{ route('student.myGroup') }}">
                                <h3 class="text-lg font-semibold">Coordinator Added member to your group</h3>
                            </a>
                            {{ $notification->markAsRead() }}
                        </div>
                    @endif
                    @elseif ($notification->data['merged'] == true)
                        @if ($notification->data['receiver'] == false)
                            <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                                <a href="{{ route('student.myGroup') }}">
                                    <h3 class="text-lg font-semibold {{isset($notification->read_at) ? 'text-gray-500' : ''}}">Your group was merged into another group</h3>
                                </a>
                                {{ $notification->markAsRead() }}
                            </div>
                        @else
                            <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                                <a href="{{ route('student.myGroup') }}">
                                    <h3 class="text-lg font-semibold">A group has been merged with your group</h3>
                                </a>
                                {{ $notification->markAsRead() }}
                            </div>
                        @endif
                    @endif
                @elseif($notification->type == 'App\Notifications\ProposalPermissionGrantedNotification')
                    <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                        <a href="{{ route('student.proposalForm') }}">
                            <h3 class="text-lg font-semibold {{isset($notification->read_at) ? 'text-gray-500' : ''}}">{{$notification->data['message']}}</h3> 
                        </a>
                        {{ $notification->markAsRead() }}
                    </div>
                @elseif($notification->type == 'App\Notifications\GroupRequestNotification')
                    <div class="bg-white dark:bg-gray-800 mb-2 rounded-lg p-4 shadow-md">
                        <a href="{{ route('student.proposalForm') }}">
                            <h3 class="text-lg font-semibold {{isset($notification->read_at) ? 'text-gray-500' : ''}}">
                                "{{$notification->data['name']}}" {{$notification->data['message']}} 
                            </h3> 
                            <span class="text-gray-600 ml-2">Reason: {{$notification->data['reason']}}</span>
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
