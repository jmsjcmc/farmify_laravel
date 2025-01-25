<x-owner-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Starter</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best option for personal use & for
                        your next project.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$29</span>
                        <span class="text-gray-500 dark:text-gray-400">/month</span>
                    </div>
                    <a href="#"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get
                        started</a>
                </div>
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Company</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Relevant for multiple users,
                        extended & premium support.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$99</span>
                        <span class="text-gray-500 dark:text-gray-400">/month</span>
                    </div>
                    <a href="#"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get
                        started</a>
                </div>
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Enterprise</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best for large scale uses and
                        extended redistribution rights.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$499</span>
                        <span class="text-gray-500 dark:text-gray-400">/month</span>
                    </div>

                    <a href="#"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get
                        started</a>
                </div>
            </div>
        </div>
    </section>
    <div class="flex h-screen">
        <div class="w-64 bg-gray-100 border-r">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Menu</h2>
                <ul class="space-y-2">
                    <li class="p-2 hover:bg-gray-200 rounded" onclick="switchSection('jobs')">Job Dashboard</li>
                    <li class="p-2 hover:bg-gray-200 rounded" onclick="switchSection('applicants')">Applicants</li>
                    <li class="p-2 hover:bg-gray-200 rounded">Job Management</li>
                </ul>
            </div>
        </div>

        <div class="flex-1 p-8" id="jobsSection">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Job Management</h1>
                <button onclick="openModal()"
                    class="bg-green-500 rounded-lg hover:bg-neutral-50 border text-white hover:text-green-500 px-4 py-2">
                    Create Job
                </button>
            </div>


            <div class="bg-white rounded-lg shadow">

                <div class="p-4">
                    <div class="mb-4 flex justify-end space-x-2">
                        <button onclick="switchView('table')" id="tableBtn" class="px-3 py-1 rounded border">
                            Table View
                        </button>
                        <button onclick="switchView('card')" id="cardBtn" class="px-3 py-1 rounded border bg-green-500 text-white">
                            Card View
                        </button>
                    </div>

                    <div id="tableView" class="overflow-x-auto hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Salary</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jobs as $job)
                                <tr>
                                    <td class="px-6 py-4">{{ $job->title }}</td>
                                    <td class="px-6 py-4">{{ $job->job_type }}</td>
                                    <td class="px-6 py-4">₱{{ number_format($job->salary_from) }} - ₱{{ number_format($job->salary_to) }} / {{ $job->salary_type }}</td>
                                    <td class="px-6 py-4">{{ $job->location }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($job->status === 'Active') bg-green-100 text-green-800
                                            @elseif($job->status === 'Closed') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $job->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                        @if($job->status === 'Draft')
                                            <button onclick="updateJobStatus({{ $job->id }}, 'Active')"
                                                class="text-green-600 hover:text-green-900">Activate</button>
                                        @elseif($job->status === 'Active')
                                            <button onclick="updateJobStatus({{ $job->id }}, 'Closed')"
                                                class="text-red-600 hover:text-red-900">Close</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div id="cardView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($jobs as $job)
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                                <span class="px-2 py-1 rounded text-sm
                                    @if($job->status === 'Active') bg-green-100 text-green-800
                                    @elseif($job->status === 'Closed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $job->status }}
                                </span>
                            </div>
                            <div class="text-gray-600 mb-4">
                                <p><span class="font-medium">Type:</span> {{ $job->job_type }}</p>
                                <p><span class="font-medium">Salary:</span> ₱{{ number_format($job->salary_from) }} - ₱{{ number_format($job->salary_to) }} / {{ $job->salary_type }}</p>
                                <p><span class="font-medium">Location:</span> {{ $job->location }}</p>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                @if($job->status === 'Draft')
                                    <button onclick="updateJobStatus({{ $job->id }}, 'Active')"
                                        class="text-green-600 hover:text-green-900">Activate</button>
                                @elseif($job->status === 'Active')
                                    <button onclick="updateJobStatus({{ $job->id }}, 'Closed')"
                                        class="text-red-600 hover:text-red-900">Close</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="applicantsSection" class="hidden">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Job Applicants</h1>
            <div class="flex space-x-2">
                <button onclick="switchApplicantView('table')" id="applicantTableBtn" class="px-3 py-1 rounded border">
                    Table View
                </button>
                <button onclick="switchApplicantView('card')" id="applicantCardBtn" class="px-3 py-1 rounded border bg-green-500 text-white">
                    Card View
                </button>
            </div>
        </div>

        <!-- Table View -->
        <div id="applicantTableView" class="hidden bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicant Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Job Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applied Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4">{{ $application->applicant->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $application->job->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $application->created_at ? $application->created_at->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-sm
                                    @if($application->status === 'PENDING') bg-yellow-100 text-yellow-800
                                    @elseif($application->status === 'APPROVED') bg-green-100 text-green-800
                                    @elseif($application->status === 'REJECTED') bg-red-100 text-red-800
                                    @endif">
                                    {{ $application->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <button onclick="viewApplication({{ $application->id }})"
                                    class="text-blue-600 hover:text-blue-900">View</button>
                                @if($application->status === 'PENDING')
                                    <button onclick="updateApplicationStatus({{ $application->id }}, 'APPROVED')"
                                        class="text-green-600 hover:text-green-900">Approve</button>
                                    <button onclick="updateApplicationStatus({{ $application->id }}, 'REJECTED')"
                                        class="text-red-600 hover:text-red-900">Reject</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card View -->
        <div id="applicantCardView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($applications as $application)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $application->applicant->name ?? 'N/A' }}</h3>
                        <p class="text-sm text-gray-500">{{ $application->job->title ?? 'N/A' }}</p>
                    </div>
                    <span class="px-2 py-1 rounded text-sm
                        @if($application->status === 'PENDING') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'APPROVED') bg-green-100 text-green-800
                        @elseif($application->status === 'REJECTED') bg-red-100 text-red-800
                        @endif">
                        {{ $application->status }}
                    </span>
                </div>

                <div class="space-y-2 mb-4">
                    <p class="text-sm"><span class="font-medium">Applied:</span> {{ $application->created_at->format('M d, Y') }}</p>
                    <p class="text-sm"><span class="font-medium">Resume:</span>
                        <a href="{{ Storage::url($application->resume_path) }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800">View Resume</a>
                    </p>
                </div>

                <div class="flex justify-end space-x-2">
                    <button onclick="viewApplication({{ $application->id }})"
                        class="text-blue-600 hover:text-blue-900">View Details</button>
                    @if($application->status === 'PENDING')
                        <button onclick="updateApplicationStatus({{ $application->id }}, 'APPROVED')"
                            class="text-green-600 hover:text-green-900">Approve</button>
                        <button onclick="updateApplicationStatus({{ $application->id }}, 'REJECTED')"
                            class="text-red-600 hover:text-red-900">Reject</button>
                    @endif
                </div>
            </div>

@endforeach
        </div>
    </div>
    @include('owner.job-management.view-applicant')
    @include('owner.job-management.add-job')
    @vite(['resources/js/owner.js'])
</x-owner-layout>
