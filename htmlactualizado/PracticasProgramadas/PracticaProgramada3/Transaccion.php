  <?php

$transacciones = [
  ["Id" => "01", "Descripcion" => "Clases extra", "Monto" => 10000],
  ["Id" => "02", "Descripcion" => "Uber", "Monto" => 5000]
];

// link= https://www.php.net/manual/es/language.types.array.php

function registrarTransaccion($transacciones, $ID, $Descripcion, $Monto) {
  array_push($transacciones,"03" => $ID, "Mantenimiento" => $Descripcion, "80000" => $Monto);
  print_r($transacciones);
}

// links= https://www.php.net/manual/es/functions.user-defined.php y https://www.php.net/manual/en/function.array-push.php


function generarEstadoDeCuenta($transacciones) {
  $total = 0;

  foreach ($transacciones as $transaccion) {
    $detalle .= "ID: {$transaccion['id']}, Descripción: {$transaccion['descripcion']}, Monto: {$transaccion['monto']}\n";
    $totalContado += $transaccion['monto'];
}

$interes = $totalContado * 0.026;       
$totalConInteres = $totalContado + $interes;
$cashback = $totalContado * 0.001;           
$montoFinal = $totalConInteres - $cashback;

file_put_contents("estado_cuenta.txt", $transacciones);

}

// link= https://www.php.net/manual/es/control-structures.foreach.php y https://www.php.net/manual/es/function.file-put-contents.php

registrarTransaccion(1, "Compra 1", 100.00);
registrarTransaccion(2, "Compra 2", 200.00);
registrarTransaccion(3, "Compra 3", 150.00);
  ?>

 
