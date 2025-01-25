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
        const modal = document.getElementById('applicationModal');
        modal.classList.remove('hidden');
    }

    function closeApplicationModal() {
        const modal = document.getElementById('applicationModal');
        modal.classList.add('hidden');
    }

    function updateApplicationStatus(applicationId, status) {

        if (confirm(`Are you sure you want to ${status.toLowerCase()} this application?`)) {

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

            const modal = document.getElementById('applicationModal');
            modal.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load application details. Please try again.');
        });
    }

    function viewResume(applicationId) {

        window.open(`/owner/applications/resume/${applicationId}`, '_blank');
    }


    switchApplicantView('card');

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
