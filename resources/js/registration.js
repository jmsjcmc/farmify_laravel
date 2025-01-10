
function passwordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const message = document.getElementById('password-message');

    if (confirmPassword === '') {
        message.style.color = '';
        message.textContent = '';
    } else if (password === confirmPassword) {
        message.style.color = 'green';
        message.textContent = 'Passwords match';
    } else {
        message.style.color = 'red';
        message.textContent = 'Passwords do not match';
    }
}


window.passwordMatch = passwordMatch;
