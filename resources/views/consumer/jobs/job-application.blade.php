
<!-- Apply Modal -->
<div id="applyModal-{{ $job->id }}" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative max-h-full w-full max-w-md">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Apply for {{ $job->title }}
                </h3>
                <button type="button" class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="applyModal-{{ $job->id }}">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('consumer.jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4 p-6">
                    <div>
                        <label for="cover_letter" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Cover Letter</label>
                        <textarea id="cover_letter" name="cover_letter" rows="4" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="resume" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Resume</label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400" required>
                    </div>
                </div>
                <div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                    <button type="button"
                    data-modal-target="applyModal-{{ $job->id }}"
                    data-modal-toggle="applyModal-{{ $job->id }}"
                    data-modal-hide="jobModal-{{ $job->id }}"
                    class="rounded-lg bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Apply Now
                </button>
                    <button type="button" data-modal-hide="applyModal-{{ $job->id }}" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
