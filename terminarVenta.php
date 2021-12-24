<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
include_once "base_de_datos.php";


$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

$sentencia = $base_de_datos->prepare("SELECT codigo FROM ventas ORDER BY codigo DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$codigo_venta = $resultado === false ? 1 : $resultado->codigo;

$base_de_datos->beginTransaction();



	$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(codigo_producto,  cantidad,codigo_venta) VALUES (?, ?, ?);");
	$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE codigo = ?;");
	foreach ($_SESSION["carrito"] as $producto) {
		$total += $producto->total;
		$sentencia->execute([$producto->codigo,  $producto->cantidad, $codigo_venta]);
		$sentenciaExistencia->execute([$producto->cantidad, $producto->codigo]);
	}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>