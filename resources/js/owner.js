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

    window.switchView = switchView;
    window.closeModal = closeModal;
    window.openModal = openModal;
})
