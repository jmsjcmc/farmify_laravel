<div id="createJobModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Create New Farm Job</h3>
            <button onclick="closeModal()" class="text-gray-600 hover:text-gray-800">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('owner.jobs.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="title" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Type</label>
                    <select name="job_type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="Farm Manager">Farm Manager</option>
                        <option value="Laborer">Laborer</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Requirements</label>
                    <textarea name="requirements" rows="3" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Responsibilities</label>
                    <textarea name="responsibilities" rows="3" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary Range</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" name="salary_from" placeholder="From" step="0.01" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <input type="number" name="salary_to" placeholder="To" step="0.01" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary Type</label>
                    <select name="salary_type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="Per Hour">Per Hour</option>
                        <option value="Per Day">Per Day</option>
                        <option value="Per Month">Per Month</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                    <select name="employment_type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Number of Vacancies</label>
                    <input type="number" name="vacancies" min="1" value="1" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">End Date (Optional)</label>
                    <input type="date" name="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Benefits (Optional)</label>
                    <textarea name="benefits" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Create Job
                </button>
            </div>
        </form>
    </div>
</div>
