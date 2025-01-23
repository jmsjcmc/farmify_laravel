document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('[data-modal-target^="jobModal-"]');
    const applyButtons = document.querySelectorAll('[data-modal-target^="applyModal-"]');
    const closeButtons = document.querySelectorAll('[data-modal-hide]');
    const backdrop = document.getElementById('modal-backdrop');

    function showModal(modal) {
        backdrop.classList.remove('hidden');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function hideModal(modal) {
        backdrop.classList.add('hidden');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            showModal(modal);
        });
    });

    applyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            const jobModal = button.closest('[id^="jobModal-"]');
            if (jobModal) {
                hideModal(jobModal);
            }
            showModal(modal);
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-hide');
            const modal = document.getElementById(modalId);
            hideModal(modal);
        });
    });

    window.addEventListener('click', (event) => {
        const modals = document.querySelectorAll('[id^="jobModal-"], [id^="applyModal-"]');
        modals.forEach(modal => {
            if (event.target === modal || event.target === backdrop) {
                hideModal(modal);
            }
        });
    });
});

document.addEventListener('submit', function(e) {
    if (e.target.matches('[action^="/jobs/"][action$="/apply"]')) {
        const submitButton = e.target.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = 'Submitting...';
        }
    }
});
