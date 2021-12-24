<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["codigo"]) || !isset($_POST["name"]) || !isset($_POST["Precio"]) || !isset($_POST["Peso"]) || !isset($_POST["existencia"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$codigo = $_POST["codigo"];
$name = $_POST["name"];
$categoria = $_POST["categoria"];
$referencia = $_POST["referencia"];
$Precio = $_POST["Precio"];
$Peso = $_POST["Peso"];
$existencia = $_POST["existencia"];
$date = date('Y-m-d H:i:s');


	
	$sentencia = $base_de_datos->prepare("INSERT INTO productos(codigo, name,referencia,categoria, Precio, Peso, existencia,fecha) VALUES (?,?, ?, ?, ?, ?,?);");
	$resultado = $sentencia->execute([$codigo, $name, $referencia, $categoria,$Precio, $Peso, $existencia,$date]);

	if($resultado === TRUE){
		header("Location: ./listar_productos.php?status=4");
		exit;
	}
	else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "footer-page.php" ?>