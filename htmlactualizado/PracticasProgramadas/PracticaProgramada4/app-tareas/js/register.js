
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('register-form');
    const registerError = document.getElementById('register-error');

    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                <strong>Error:</strong> La contraseña y su confirmación no coinciden.
            </div>`;
            return;
        }

        fetch('register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                registerError.innerHTML = `<div class="alert alert-success fade show" role="alert">
                    <strong>Éxito:</strong> ${data.message}
                </div>`;
                setTimeout(() => {
                    registerError.innerHTML = "";
                    window.location.href = "index.php";
                }, 3000);
            } else {
                registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                    <strong>Error:</strong> ${data.message}
                </div>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                <strong>Error:</strong> Algo salió mal. Intenta nuevamente.
            </div>`;
        });
    });
});
