<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container mt-4">
    <h1>Iniciar Sesión</h1>
    <form id="loginForm">
        <div id="login-error" class="alert alert-danger" style="display: none;"></div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required >
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</div>

<script src="js/index.js"></script>
</body>
</html>
