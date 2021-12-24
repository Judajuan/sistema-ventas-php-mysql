<?php
if(!isset($_GET["codigo"])) exit();
$codigo = $_GET["codigo"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE codigo = ?;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese codigo!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
	<div class="col-xs-12">
		<h1 class="text-center">Editar producto | <?php echo $producto->name; ?> |</h1>
		<form method="post" class="form-edit" action="guardarDatosEditados.php">
			<input type="hidden" name="codigo" value="<?php echo $producto->codigo; ?>">
	
			<label for="codigo">Código de producto:</label>
			<input value="<?php echo $producto->codigo ?>" class="form-control inputs-edit" name="codigo" required type="text" codigo="codigo" placeholder="Escribe el código">

			<label for="existencia">Existencia:</label>
			<input value="<?php echo $producto->existencia ?>" class="form-control inputs-edit" name="existencia" required type="number" codigo="existencia" placeholder="cantidad o existencia">

			<div class="container-description">
				<label for="name">Nombre producto:</label>
				<input type="text" required id="name" name="name" class="form-control inputs-edit" value="<?php echo $producto->name ?>">
				<label for="categoria">Categoria producto:</label>
				<input type="text" required id="categoria" name="categoria" class="form-control inputs-edit" value="<?php echo $producto->categoria ?>">
				<label for="referencia">Referencia de producto:</label>
				<input type="text" required id="referencia" name="referencia" class="form-control inputs-edit"  value="<?php echo $producto->referencia ?>" >
		
			</div>

			<label for="Precio">Precio:</label>
			<input value="<?php echo $producto->Precio ?>" class="form-control inputs-edit" name="Precio" required type="number" codigo="Precio" placeholder="Precio">

			<label for="Peso">Peso:</label>
			<input value="<?php echo $producto->Peso ?>" class="form-control inputs-edit" name="Peso" required type="number" codigo="Peso" placeholder="Peso">

			
			<br><br>
			<div class="buttons-edit text-center">
				<input class="btn btn-info" type="submit" value="Guardar">
				<a class="btn btn-warning" href="./listar_productos.php">Cancelar</a>
			</div>
		</form>
	</div>
<?php include_once "footer-page.php" ?>
