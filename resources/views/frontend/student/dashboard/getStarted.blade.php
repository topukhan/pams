<x-frontend.student.layouts.master>
    <div class="container px-6 mx-auto my-4 grid">
        <div class="px-2 py-2">
            <div class="container bg-gray-200 font-mono  shadow-xl mx-auto w-full h-full">
                <div class="relative wrap overflow-hidden p-10 h-full">
                    <h1 class="text-3xl font-semibold text-center mb-6 "> Final Year Project Life Cycle </h1>
                    <div class="border-2-2 absolute border-opacity-20 border-gray-700 h-full border" style="left: 50%">
                    </div>
                    <!-- right timeline -->
                    {{-- profile setup --}}
                    <div class="mb-8 flex justify-between items-center  w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto font-semibold text-lg text-white">1</h1>
                        </div>
                        <div class="relative order-1 bg-gray-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <div class="tooltip-container">
                                <h3 class="mb-3 font-bold text-gray-800 text-xl">Profile Setup</h3>
                                <p class="text-md leading-snug tracking-wide text-gray-900 text-opacity-100">
                                    Log in to the system, update your profile, and set your project preferences.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- left timeline -->
                    {{-- group formation --}}
                    <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto text-white font-semibold text-lg">2</h1>
                        </div>
                        <div class="order-1 bg-red-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-white text-xl">Group Formation</h3>
                            <ul>
                                <li
                                    class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100 mb-3">
                                    <h2 class="text-lg text-center font-semibold bg-red-300 px-2 rounded-md mb-4">
                                        Visit the 'Create Group' page.
                                    </h2>
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Scenario I:</span>
                                            <span class="font-semibold">Send Group Request</span>
                                        </div>
                                        <div class="px-3 text-justify">
                                            Select a domain and project type. Choose four
                                            group members. Send a request to form the group. Accepting/Rejecting Group
                                            Requests.
                                        </div>
                                    </div>
                                </li>

                                <li class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Scenario II:</span>
                                            <span class="font-semibold">Group Request Received</span>
                                        </div>

                                        <div class="px-3 text-justify">
                                            If you receive a group request, decide to:
                                            Accept and form the group.
                                            Reject if you don't want to be part of that group.
                                        </div>
                                    </div>
                                </li>
                                <li class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Scenario III:</span>
                                            <span class="font-semibold  ">Requesting Coordinator's Assistance</span>
                                        </div>

                                        <div class="px-3 text-justify">
                                            If the required number of group members is not available: Request the
                                            coordinator to allocate you in a group.
                                        </div>
                                    </div>

                                </li>
                            </ul>

                        </div>
                    </div>
                    <!-- right timeline -->
                    {{-- supervisor searching tool --}}
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto font-semibold text-lg text-white">3</h1>
                        </div>
                        <div class="order-1 bg-gray-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-gray-800 text-xl">Supervisor Searhing Tool</h3>
                            <p class="text-md leading-snug tracking-wide text-gray-900 text-opacity-100">Visit the
                                Supervisor Availability page, select the desired project domain using the provided
                                filter, and explore available supervisors who specialize in that domain for potential
                                project guidance.</p>
                        </div>
                    </div>
                    <!-- left timeline -->
                    {{-- Propose For Project --}}
                    <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto text-white font-semibold text-lg">4</h1>
                        </div>
                        <div class="order-1 bg-red-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-white text-xl">Propose For Project</h3>
                            <p class="text-sm font-medium leading-snug tracking-wide text-white text-opacity-100">
                            <ul>
                                <li
                                    class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100 mb-3">

                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Project Proposal
                                                Submission:</span>

                                        </div>
                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                                <li>One student from the group submits a project proposal.
                                                </li>
                                                <li>
                                                    The supervisor reviews the proposal and can either deny it, accept
                                                    it, or provide
                                                    suggestions.</li>

                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Supervisor's
                                                Response:</span>
                                        </div>

                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                                <li>
                                                    If accepted,the proposal is forwarded to the coordinator.</li>
                                                <li>
                                                    If denied, the group must create a new proposal.</li>
                                                <li>
                                                    If the supervisor suggests changes, the student can accept and
                                                    proceed or deny and create a new proposal.
                                                </li>

                                        </div>
                                    </div>
                                </li>
                                <li class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-red-300 rounded-sm px-1">Coordinator
                                                Review:</span>

                                        </div>
                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                                <li>
                                                    The coordinator reviews the accepted proposal.</li>
                                                <li>
                                                    If denied, the group must create a new proposal.</li>
                                                <li>
                                                    If approved, the project is allocated to the group.
                                                </li>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                            </p>
                        </div>
                    </div>
                    <!-- Project Allocated -->
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-44 h-44 rounded-full">
                            <h1 class="mx-auto font-semibold text-lg text-white">Project Allocated</h1>
                        </div>
                        <div class="order-1   w-5/12 px-6 py-4"> 
                        </div>
                    </div>
<!-- right timeline -->
{{-- Collaboration and Communication Tools --}}
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto font-semibold text-lg text-white">5</h1>
                        </div>
                        <div class="order-1 bg-gray-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-gray-800 text-xl">Collaboration and Communication Tools</h3>
                            <p class="text-md leading-snug tracking-wide text-gray-900 text-opacity-100"><ul>
                                <li
                                    class="text-md font-medium leading-snug tracking-wide text-gray-900 text-opacity-100 mb-3">

                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-gray-300 rounded-sm px-1">Group Chat:

                                            </span>

                                        </div>
                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                                <li>Facilitates real-time discussions for project planning and coordination.
                                                </li>
                                        
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="text-md font-medium leading-snug tracking-wide text-gray-900 text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-gray-300 rounded-sm px-1">Notices and Updates:</span>
                                        </div>

                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                               
                                                <li>
                                                    Stay informed about project-related announcements and deadlines from the supervisor and coordinator.</li>


                                        </div>
                                    </div>
                                </li>
                                <li class="text-md font-medium leading-snug tracking-wide text-gray-900 text-opacity-100">
                                    <div class="mb-2">
                                        <div>
                                            <span class="font-bold bg-gray-300 rounded-sm px-1">Document Sharing:</span>

                                        </div>
                                        <div class="px-3 text-justify">
                                            <ul style="list-style-type: disc;">
                                                <li>
                                                    Upload project documents for review and feedback from the supervisor.
</li>
                                                <li>
                                                    Streamlines the process of sharing and revising project materials.</li>
                                                
                                        </div>
                                    </div>

                                </li>
                            </ul></p>
                        </div>
                    </div>
                    <!-- left timeline -->
                    {{-- evaluation --}}
                    <div class="mb-8 flex justify-between flex-row-reverse items-center w-full  left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-8 h-8 rounded-full">
                            <h1 class="mx-auto text-white font-semibold text-lg">6</h1>
                        </div>
                        <div class="order-1 bg-red-400 rounded-lg shadow-2xl w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-white text-xl">Result</h3>
                            <p class="text-md font-medium leading-snug tracking-wide text-white text-opacity-100">After each phase students are evaluated, finally result is published after the last phase.</p>
                        </div>
                    </div>

                    <!-- right timeline -->
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="z-20 flex items-center order-1 bg-gray-800 shadow-2xl w-12 h-12 rounded-full">
                            <h1 class="mx-auto font-semibold text-lg text-white">End</h1>
                        </div>
                        <div class="order-1 w-5/12 "></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-frontend.student.layouts.master>
