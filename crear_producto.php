<?php include_once "encabezado.php" ?>

<?php
include_once "base_de_datos.php";
// $serial = 0;


$sentencia = $base_de_datos->prepare("SELECT `AUTO_INCREMENT` as increment FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'tienda_cafe' AND TABLE_NAME = 'productos'");

$sentencia->execute();
$serial = $sentencia->fetch(PDO::FETCH_OBJ);
?>
<div class="col-xs-12">
	<h1 class="text-center">Crear nuevo producto</h1>
	<form method="post" class="form-edit" action="nuevo_producto.php">
		<label for="codigo">Id de producto:</label>
		<input class="form-control inputs-edit" autofocus name="codigo" value="<?php echo $serial->increment?>" required type="number" readonly="readonly" min="0" id="codigo" placeholder="Escribe el código">
	
		<label for="existencia">Existencia:</label>
		<input class="form-control inputs-edit" name="existencia" required min="0" type="number" id="existencia" placeholder="Cantidad o existencia">
		<div class="container-description">
			
			<label for="name">Nombre producto:</label>
			<input type="text" required id="name" name="name" class="form-control inputs-edit" >
			<label for="categoria">Categoria producto:</label>
			<input type="text" required id="categoria" name="categoria" class="form-control inputs-edit" >
			<label for="referencia">Referencia de producto:</label>
			<input type="text" required id="referencia" name="referencia" class="form-control inputs-edit" >
		
		</div>
		<label for="Precio">Precio:</label>
		<input class="form-control inputs-edit" name="Precio" required type="number" id="Precio" min="0" placeholder="Precio">

		<label for="Peso">Peso:</label>
		<input class="form-control inputs-edit" name="Peso" required type="number" id="Peso" placeholder="Peso" min="0">

		
		<br><br>
		<div class="buttons-edit text-center">
				<input class="btn btn-info" type="submit" value="Guardar">
				<a class="btn btn-warning" href="./listar_productos.php">Cancelar</a>
			</div>
	</form>
</div>
<?php include_once "footer-page.php" ?>