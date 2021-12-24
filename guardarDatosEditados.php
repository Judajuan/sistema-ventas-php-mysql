<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["codigo"]) || 
	!isset($_POST["name"]) || 
	!isset($_POST["Peso"]) || 
	!isset($_POST["Precio"]) || 
	!isset($_POST["existencia"]) || 
	!isset($_POST["categoria"]) || 
	!isset($_POST["referencia"]) 
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$codigo = $_POST["codigo"];
$name = $_POST["name"];
$categoria = $_POST["categoria"];
$referencia = $_POST["referencia"];

$Peso = $_POST["Peso"];
$Precio = $_POST["Precio"];
$existencia = $_POST["existencia"];

$sentencia = $base_de_datos->prepare("UPDATE productos SET codigo = ?, name = ?, categoria = ?, referencia = ?, Peso = ?, Precio = ?, existencia = ? WHERE codigo = ?;");
$resultado = $sentencia->execute([$codigo, $name, $categoria , $referencia, $Peso, $Precio, $existencia, $codigo]);

if($resultado === TRUE){
	// echo "<script>alert('Producto actualizado correctamente'); window.location.replace('./listar_productos.php');</script>";
	header("Location: ./listar_productos.php?status=2");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>