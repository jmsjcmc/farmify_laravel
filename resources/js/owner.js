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

    window.updateJobStatus = updateJobStatus;
    window.switchView = switchView;
    window.closeModal = closeModal;
    window.openModal = openModal;
})
