document.addEventListener('DOMContentLoaded', function () {
    function approveFarmOwner(id) {
        fetch(`/admin/farm-owners/${id}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }

    function showTab(tabName) {
        document.getElementById('users-content').classList.add('hidden');
        document.getElementById('farm-owners-content').classList.add('hidden');

        document.getElementById(`${tabName}-content`).classList.remove('hidden');

        document.getElementById('users-tab').classList.remove('text-blue-600', 'border-blue-600', 'active');
        document.getElementById('farm-owners-tab').classList.remove('text-blue-600', 'border-blue-600', 'active');

        document.getElementById(`${tabName}-tab`).classList.add('text-blue-600', 'border-blue-600', 'active');
    }

    window.showTab = showTab;

    document.addEventListener('DOMContentLoaded', function () {

        const userModal = document.getElementById('userModal');
        const userForm = document.getElementById('userForm');
        const modalTitle = document.getElementById('modalTitle');


        showTab('users');
    });

    window.approveFarmOwner = approveFarmOwner;
})
