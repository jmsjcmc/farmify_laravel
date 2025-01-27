document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('[data-modal-target^="jobModal-"]');
    const applyButtons = document.querySelectorAll('[data-modal-target^="applyModal-"]');
    const closeButtons = document.querySelectorAll('[data-modal-hide]');
    const backdrop = document.getElementById('modal-backdrop');
    const applicationForms = document.querySelectorAll('form[action*="/consumer/jobs/"][action$="/apply"]');
    const dropdown = document.getElementById('notificationDropdown');
    const button = document.getElementById('notificationButton');
    const badge = button.querySelector('.bg-red-500');

    let isNotificationOpen = false;

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

    function toggleNotifications() {
       if (!dropdown || !button) return;

       isNotificationOpen = !isNotificationOpen;

       if (isNotificationOpen) {
        dropdown.classList.remove('hidden');
        fetch('/notifications/mark-as-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (badge) {
                    badge.remove();
                }
            }
        }).catch(error => console.error('Error', error));
       } else {
        dropdown.classList.add('hidden');
       }
    }

    if (button) {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleNotifications();
        } );
    }

    document.addEventListener('click', function(event) {
      if (dropdown && button && isNotificationOpen) {
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            isNotificationOpen = false;
            dropdown.classList.add('hidden');
        }
      }
    });

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

    applicationForms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Submitting...';
            }

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Application submission failed');
                }
            } catch (error) {
                console.error('Error:', error);
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Apply Now';
                }
                alert('Failed to submit application. Please try again.');
            }
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

    window.toggleNotifications = toggleNotifications;
});
