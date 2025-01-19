document.addEventListener('DOMContentLoaded', function () {
    const userModal = document.getElementById('userModal');
    const userForm = document.getElementById('userForm');
    const modalTitle = document.getElementById('modalTitle');


    function removeMethodInput() {
        const existingMethodInput = userForm.querySelector('input[name="_method"]');
        if (existingMethodInput) {
            existingMethodInput.remove();
        }
    }

    document.querySelectorAll('[data-modal-target="userModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const action = this.dataset.modalAction;
            const userId = this.dataset.userId;


            userForm.reset();
            removeMethodInput();

            if (action === 'add') {
                modalTitle.textContent = 'Add User';
                userForm.action = '/admin/users';
                userForm.method = 'POST';
                document.getElementById('password').required = true;
            } else {
                modalTitle.textContent = 'Edit User';
                userForm.action = `/admin/users/${userId}`;
                userForm.method = 'POST';


                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                userForm.appendChild(methodInput);


                document.getElementById('password').required = false;


                fetch(`/admin/users/${userId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('first_name').value = data.first_name;
                        document.getElementById('last_name').value = data.last_name;
                        document.getElementById('username').value = data.username;
                        document.getElementById('email').value = data.email;
                        document.getElementById('role').value = data.roles[0].name;
                    });
            }
        });
    });

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (!preview) return;

        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    }

    const businessPermitInput = document.getElementById('business_permit_image');
    const validInput = document.getElementById('valid_id_image');

    if (businessPermitInput) {
        businessPermitInput.addEventListener('change', function () {
            previewImage(this, 'business_permit_preview');
        });
    }

    if (validInput) {
        validInput.addEventListener('change', function () {
            previewImage(this, 'valid_id_preview');
        });
    }

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('reset', function () {
            const previews = document.querySelectorAll('img[id$="_preview"]');
            previews.forEach(preview => {
                preview.src = '#';
                preview.classList.add('hidden');
            });
        });
    }




});


