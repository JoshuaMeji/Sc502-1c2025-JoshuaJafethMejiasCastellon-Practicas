
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginError = document.getElementById('login-error');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'dashboard.php';
            } else {
                loginError.style.display = 'block';
                loginError.textContent = data.message || 'Email o contraseña inválidos.';
            }
        })
        .catch(error => {
            loginError.style.display = 'block';
            loginError.textContent = 'Ocurrió un error. Intenta nuevamente.';
            console.error('Error:', error);
        });
    });
});
