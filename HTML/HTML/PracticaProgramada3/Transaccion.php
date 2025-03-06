<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta - Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Estado de Cuenta de Tarjeta de Crédito</h1>
        <div class="row">
            <div class="col-md-12">
                <?php
                
                $transacciones = [];
   
                function registrarTransaccion($id, $descripcion, $monto) {
                    global $transacciones;
                    $transaccion = [
                        'id' => $id,
                        'descripcion' => $descripcion,
                        'monto' => $monto
                    ];
                    array_push($transacciones, $transaccion);
                }

                function generarEstadoDeCuenta() {
                    global $transacciones;

                    $totalContado = 0;
                    foreach ($transacciones as $transaccion) {
                        $totalContado += $transaccion['monto'];
                    }

                    $interes = 2.6 / 100;
                    $totalConInteres = $totalContado * (1 + $interes);

                    $cashback = $totalContado * 0.1 / 100;

                    $montoFinal = $totalConInteres - $cashback;

                    echo '<div class="card">';
                    echo '<div class="card-header"><strong>Transacciones Registradas</strong></div>';
                    echo '<ul class="list-group list-group-flush">';
                    foreach ($transacciones as $transaccion) {
                        echo '<li class="list-group-item">';
                        echo 'ID: ' . $transaccion['id'] . ' | Descripción: ' . $transaccion['descripcion'] . ' | Monto: $' . number_format($transaccion['monto'], 2);
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';

                    echo '<div class="card mt-3">';
                    echo '<div class="card-header"><strong>Resumen del Estado de Cuenta</strong></div>';
                    echo '<div class="card-body">';
                    echo 'Monto Total de Contado: $' . number_format($totalContado, 2) . '<br>';
                    echo 'Monto Total con Interés (2.6%): $' . number_format($totalConInteres, 2) . '<br>';
                    echo 'Cashback (0.1%): $' . number_format($cashback, 2) . '<br>';
                    echo 'Monto Final a Pagar: $' . number_format($montoFinal, 2) . '<br>';
                    echo '</div>';
                    echo '</div>';

                    $estadoCuenta = "Estado de Cuenta:\n";
                    $estadoCuenta .= "----------------------\n";
                    $estadoCuenta .= "Transacciones Registradas:\n";
                    foreach ($transacciones as $transaccion) {
                        $estadoCuenta .= "ID: " . $transaccion['id'] . " | Descripción: " . $transaccion['descripcion'] . " | Monto: $" . number_format($transaccion['monto'], 2) . "\n";
                    }
                    $estadoCuenta .= "\nMonto Total de Contado: $" . number_format($totalContado, 2) . "\n";
                    $estadoCuenta .= "Monto Total con Interés (2.6%): $" . number_format($totalConInteres, 2) . "\n";
                    $estadoCuenta .= "Cashback (0.1%): $" . number_format($cashback, 2) . "\n";
                    $estadoCuenta .= "Monto Final a Pagar: $" . number_format($montoFinal, 2) . "\n";

                    file_put_contents('estado_cuenta.txt', $estadoCuenta);
                }

                registrarTransaccion(1, 'Compra en supermercado', 150.00);
                registrarTransaccion(2, 'Pago de factura de teléfono', 200.00);
                registrarTransaccion(3, 'Compra en tienda online', 300.00);

                generarEstadoDeCuenta();
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
