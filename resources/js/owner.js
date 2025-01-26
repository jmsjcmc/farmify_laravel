document.addEventListener('DOMContentLoaded', function () {
    function closeModal() {
        document.getElementById('createJobModal').classList.add('hidden');
    }

    function openModal() {
        document.getElementById('createJobModal').classList.remove('hidden');
    }

    function switchView(viewType) {
        const tableView = document.getElementById('tableView');
        const cardView = document.getElementById('cardView');
        const tableBtn = document.getElementById('tableBtn');
        const cardBtn = document.getElementById('cardBtn');

        if (viewType === 'table') {
            tableView.classList.remove('hidden');
            cardView.classList.add('hidden');
            tableBtn.classList.add('bg-green-500', 'text-white');
            cardBtn.classList.remove('bg-green-500', 'text-white');
        } else {
            cardView.classList.remove('hidden');
            tableView.classList.add('hidden');
            cardBtn.classList.add('bg-green-500', 'text-white');
            tableBtn.classList.remove('bg-green-500', 'text-white');
        }
    }

    function updateJobStatus(jobId, newStatus) {
        if (!confirm(`Are you sure you want to change the job status to ${newStatus}?`)) {
            return;
        }

        fetch(`/owner/jobs/${jobId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: newStatus })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update job status. Please try again.');
            });
    }

    // function switchSection(section) {
    //     const jobsSection = document.getElementById('jobsSection');
    //     const applicantsSection = document.getElementById('applicantsSection');

    //     if (section === 'jobs') {
    //         jobsSection.classList.remove('hidden');
    //         applicantsSection.classList.add('hidden');
    //     } else {
    //         jobsSection.classList.add('hidden');
    //         applicantsSection.classList.remove('hidden');
    //     }
    // }

    function switchSection(section) {
        const jobsSection = document.getElementById('jobsSection');
        const applicantsSection = document.getElementById('applicantsSection');

        if (section === 'jobs') {
            jobsSection.classList.remove('hidden');
            applicantsSection.classList.add('hidden');
        } else {
            jobsSection.classList.add('hidden');
            applicantsSection.classList.remove('hidden');
        }
    }

    function switchApplicantView(view) {
        const tableView = document.getElementById('applicantTableView');
        const cardView = document.getElementById('applicantCardView');
        const tableBtn = document.getElementById('applicantTableBtn');
        const cardBtn = document.getElementById('applicantCardBtn');

        if (view === 'table') {
            tableView.classList.remove('hidden');
            cardView.classList.add('hidden');
            tableBtn.classList.add('bg-green-500', 'text-white');
            cardBtn.classList.remove('bg-green-500', 'text-white');
        } else {
            cardView.classList.remove('hidden');
            tableView.classList.add('hidden');
            cardBtn.classList.add('bg-green-500', 'text-white');
            tableBtn.classList.remove('bg-green-500', 'text-white');
        }
    }

    function viewApplication(applicationId) {
        fetch(`/owner/applications/${applicationId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const application = data.application;
                const detailsHtml = `
            <div class="space-y-4">
                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold">Applicant Information</h4>
                    <p><span class="font-medium">Name:</span> ${application.applicant.name}</p>
                    <p><span class="font-medium">Email:</span> ${application.applicant.email}</p>
                    <p><span class="font-medium">Applied Date:</span> ${new Date(application.created_at).toLocaleDateString()}</p>
                </div>

                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold">Job Details</h4>
                    <p><span class="font-medium">Position:</span> ${application.job.title}</p>
                    <p><span class="font-medium">Type:</span> ${application.job.job_type}</p>
                    <p><span class="font-medium">Status:</span>
                        <span class="px-2 py-1 rounded text-sm ${getStatusClass(application.status)}">
                            ${application.status}
                        </span>
                    </p>
                </div>

                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold">Application Details</h4>
                    <p><span class="font-medium">Cover Letter:</span></p>
                    <p class="mt-2">${application.cover_letter || 'No cover letter provided'}</p>
                </div>

                <div class="border-b pb-4">
                    <h4 class="text-lg font-semibold">Interview Schedule</h4>
                    ${application.interview_date ?
                        `<p>Scheduled for: ${new Date(application.interview_date).toLocaleString()}</p>` :
                        `<div class="flex items-center space-x-2">
                            <input type="datetime-local" id="interviewDate" class="rounded border p-2">
                            <button onclick="scheduleInterview(${application.id})"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Schedule Interview
                            </button>
                        </div>`
                    }
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button onclick="viewResume('${application.id}')"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        View Resume
                    </button>
                    ${application.status === 'Pending' ? `
                        <button onclick="updateApplicationStatus(${application.id}, 'Shortlisted')"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Shortlist
                        </button>
                        <button onclick="updateApplicationStatus(${application.id}, 'Rejected')"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Reject
                        </button>
                    ` : ''}
                </div>
            </div>
        `;
        document.getElementById('applicationDetails').innerHTML = detailsHtml;
        document.getElementById('applicationModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load application details. Please try again.');
            });
    }


    function getStatusClass(status) {
        switch(status) {
            case 'PENDING': return 'bg-yellow-500';
            case 'SHORTLISTED': return 'bg-blue-500';
            case 'INTERVIEWED': return 'bg-green-500';
            case 'OFFERED': return 'bg-purple-500';
            case 'HIRED': return 'bg-green-500';
            case 'REJECTED': return 'bg-red-500';
        }
    }

    function updateApplicationStatus(applicationId, newStatus) {
        if (!confirm(`Are you sure you want to ${newStatus.toLowerCase()} this application?`)) {
            return;
        }

        fetch(`/owner/applications/${applicationId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update application status. Please try again.');
        });
    }

function scheduleInterview(applicationId) {
    const interviewDate = document.getElementById('interviewDate').value;
    if (!interviewDate) {
        alert('Please select an interview date');
        return;
    }

    fetch(`/owner/applications/${applicationId}/schedule`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ interview_date: interviewDate })
    })
    .then(response => response.json())
    .then(data => {
        alert('Interview scheduled successfully');
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to schedule interview. Please try again.');
    });
}

    function closeApplicationModal() {
        document.getElementById('applicationModal').classList.add('hidden');
    }

    function viewResume(applicationId) {

        window.open(`/owner/applications/resume/${applicationId}`, '_blank');
    }


    switchApplicantView('card');

    window.scheduleInterview = scheduleInterview;
    window.viewResume = viewResume;
    window.switchApplicantView = switchApplicantView;
    window.updateApplicationStatus = updateApplicationStatus;
    window.viewApplication = viewApplication;
    window.closeApplicationModal = closeApplicationModal;
    window.switchSection = switchSection;
    window.updateJobStatus = updateJobStatus;
    window.switchView = switchView;
    window.closeModal = closeModal;
    window.openModal = openModal;
})
