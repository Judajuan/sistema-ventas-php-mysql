<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
if(isset($_GET["status"])){
	
			
	if($_GET["status"] === "1"){
		echo '<div class="alert alert-success text-center">';
		?>
			<strong>¡Hecho!</strong> Producto borrado correctamente
		<?php
		echo '</div>';
	}
	else if($_GET["status"] === "2"){
		echo '<div class="alert alert-success text-center">';
		?>
			<strong>¡Hecho!</strong> Producto actualizado correctamente
		<?php
		echo '</div>';
	}

	else if($_GET["status"] === "4"){
		echo '<div class="alert alert-success text-center">';
		?>
			<strong>!Correcto!</strong> Producto creado satisfactoriamente
		<?php
		echo '</div>';
	}
				
	
}
?>

	<div class="col-xs-12">
		<h1 style="display: inline-block;">Productos</h1>
		<div class="float-r">
			<a class="btn btn-success" href="./crear_producto.php">Crear nuevo producto <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered text-center">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Referencia</th>
					<th>Categoria</th>
					<th>Peso</th>
					<th>Precio</th>
					<th>Existencia</th>
					<th>Fecha Creado</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($productos as $producto){ ?>
				<tr>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->name ?></td>
					<td><?php echo $producto->referencia ?></td>
					<td><?php echo $producto->categoria ?></td>
					<td><?php echo $producto->Peso ?> Kg</td>
					<td><?php echo $producto->Precio ?> Pesos</td>
					<td><?php echo $producto->existencia ?> Unidades disponibles</td>
					<td><?php echo $producto->fecha?></td>
					<td><a class="btn btn-warning" href="<?php echo "editar_producto.php?codigo=" . $producto->codigo?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" <?php echo " onclick='confirmar(".$producto->codigo.")'"  ?> ><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<script>
		function confirmar(id){
			
			
			if (confirm("¿Esta seguro que desea eliminar este producto?") == true) {
				window.location.replace('eliminar_producto.php?codigo='+id);
			} 
		}
	</script>
<?php include_once "footer-page.php" ?>