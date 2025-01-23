<div id="jobModal-{{ $job->id }}" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative max-h-full w-full max-w-2xl">

        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">

            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $job->title }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $job->farmOwner->farm_name }}
                    </p>
                </div>
                <button type="button" class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="jobModal-{{ $job->id }}">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="space-y-6 p-6">

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            {{ $job->job_type }}
                        </span>
                        <span class="text-sm text-gray-500">
                            Posted {{ $job->created_at->diffForHumans() }}
                        </span>
                    </div>


                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $job->location }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $job->employment_type }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ number_format($job->salary_from, 2) }} - {{ number_format($job->salary_to, 2) }} / {{ $job->salary_type }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $job->vacancies }} position(s) available
                        </div>
                    </div>


                    <div>
                        <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Description</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $job->description }}</p>
                    </div>


                    <div>
                        <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Requirements</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $job->requirements }}</p>
                    </div>


                    <div>
                        <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Responsibilities</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $job->responsibilities }}</p>
                    </div>


                    <div>
                        <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Required Skills</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->skills as $skill)
                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                    {{ $skill->skill_name }} ({{ $skill->skill_level }})
                                </span>
                            @endforeach
                        </div>
                    </div>


                    @if($job->benefits)
                    <div>
                        <h4 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Benefits</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $job->benefits }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                <button type="button" data-modal-target="applyModal-{{ $job->id }}" data-modal-toggle="applyModal-{{ $job->id }}"
                    class="rounded-lg bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Apply Now
                </button>
                <button type="button" data-modal-hide="jobModal-{{ $job->id }}"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
