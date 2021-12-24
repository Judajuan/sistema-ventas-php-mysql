<?php
if(!isset($_GET["codigo"])) exit();
$codigo = $_GET["codigo"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM ventas WHERE codigo = ?;");
$resultado = $sentencia->execute([$codigo]);
if($resultado === TRUE){
	header("Location: ./ventas.php?status=1");
	exit;
}
else echo "Algo salió mal";
?>