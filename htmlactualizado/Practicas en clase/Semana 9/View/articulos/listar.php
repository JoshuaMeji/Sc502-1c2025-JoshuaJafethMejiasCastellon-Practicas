<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artículos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
                <?php foreach ($Pelicula as $Pelicula): ?>
                    <div class="container mt-5">
        <h2 class="text-center">Lista de Peliculas</h2>
        <div class="card" style="width: 18rem;">
  <img src="<?= htmlspecialchars($Pelicula['Imagen']) ?>" class="card-img-top">
  <div class="card-body">
    <p class="card-text"><?= htmlspecialchars($Pelicula['Codigo_ Pelicula']) ?>.</p>
    <p class="card-text"><strong><?= htmlspecialchars($Pelicula['nombre']) ?></strong></p>
    <p class="card-text"><?= htmlspecialchars($Pelicula['sinopsis']) ?></p>
    <p class="card-text">Protagonista: <?= htmlspecialchars($Pelicula['protagonista']) ?></p>
    <p class="card-text">Año de Estreno: <?= htmlspecialchars($Pelicula['Estreno']) ?></p>
  </div>
</div>
                <?php endforeach; ?>
    </div>
</body>
</html>
