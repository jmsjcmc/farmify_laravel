document.addEventListener('DOMContentLoaded', function () {
    function closeModal() {
        document.getElementById('createJobModal').classList.add('hidden');
    }

    function openModal() {
        document.getElementById('createJobModal').classList.remove('hidden');
    }

    window.closeModal = closeModal;
    window.openModal = openModal;
})
