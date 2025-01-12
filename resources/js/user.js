document.addEventListener('DOMContentLoaded', function() {
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
        button.addEventListener('click', function() {
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
});
