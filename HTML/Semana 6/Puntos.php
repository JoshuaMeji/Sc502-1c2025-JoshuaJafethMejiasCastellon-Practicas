<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patrón de Estrellas</title>
</head>
<body>

<?php
for ($i = 6; $i >= 1; $i--) { 
    for ($j = 1; $j <= $i; $j++) { 
        echo "*"; 
    }
    echo "<br>"; 
}
?>

</body>
<footer>
</footer>
</html>
