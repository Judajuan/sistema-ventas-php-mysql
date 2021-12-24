<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.codigo, GROUP_CONCAT(	productos.codigo, '..',  productos.name, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.codigo_venta = ventas.codigo INNER JOIN productos ON productos.codigo = productos_vendidos.codigo_producto GROUP BY ventas.codigo ORDER BY ventas.codigo;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
if(isset($_GET["status"])){
	
			
	if($_GET["status"] === "1"){
		echo '<div class="alert alert-success text-center">';
		?>
			<strong>¡Hecho!</strong> Venta borrada correctamente
		<?php
		echo '</div>';
	}
}
?>

	<div class="col-xs-12">
		<h1 class="text-center">Historial de ventas</h1>
		<div>
			<a class="btn btn-success" href="./vender.php">Vender un producto <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered text-center">
			<thead>
				<tr>
					<th>Codigo de venta</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->codigo ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered text-center">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?> Pesos</td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?codigo=" . $venta->codigo?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "footer-page.php" ?>