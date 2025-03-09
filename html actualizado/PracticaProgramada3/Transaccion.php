<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta - Dashboard</title>
    <link rel="stylesheet" href="./CSS/Style.css">

</head>
<body>
    <div class="container">
        <h1>Estado de Cuenta de Tarjeta de Crédito</h1>
        
        <div class="card">
            <div class="card-header">Transacciones Registradas</div>
            <ul class="list-group">
                <?php
                $transacciones = [
                    ['id' => 1, 'descripcion' => 'Compra en supermercado', 'monto' => 150.00],
                    ['id' => 2, 'descripcion' => 'Pago de factura de teléfono', 'monto' => 200.00],
                    ['id' => 3, 'descripcion' => 'Compra en tienda online', 'monto' => 300.00]
                ];

                $totalContado = 0;
                foreach ($transacciones as $transaccion) {
                    echo '<li class="list-group-item">';
                    echo 'ID: ' . $transaccion['id'] . ' | ' . $transaccion['descripcion'] . ' | Monto: $' . number_format($transaccion['monto'], 2);
                    echo '</li>';
                    $totalContado += $transaccion['monto'];
                }

                $interes = 2.6 / 100;
                $totalConInteres = $totalContado * (1 + $interes);
                $cashback = $totalContado * 0.1 / 100;
                $montoFinal = $totalConInteres - $cashback;
                ?>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">Resumen del Estado de Cuenta</div>
            <div>
                <p>Monto Total de Contado: $<?php echo number_format($totalContado, 2); ?></p>
                <p>Monto Total con Interés (2.6%): $<?php echo number_format($totalConInteres, 2); ?></p>
                <p>Cashback (0.1%): $<?php echo number_format($cashback, 2); ?></p>
                <p><strong>Monto Final a Pagar: $<?php echo number_format($montoFinal, 2); ?></strong></p>
            </div>
        </div>
    </div>
</body>
</html>
