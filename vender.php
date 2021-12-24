<?php 
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
	<div class="col-xs-12">
		<h1 class="text-center">Carrito de compras</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>Lo sentimos, el producto está agotado. Vuelve mas tarde.
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>
		<form method="post" action="agregarAlCarrito.php" class="text-center">
			<label for="codigo" class="text-left">Código de producto:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código del producto que desea comprar">
			 <br>
			 <input class="btn btn-info" type="submit" value="Buscar">
			<a class="btn btn-warning" href="./listar_productos.php">Cancelar</a>
		</form>
		<br><br>
		

		<table class="table table-bordered text-center">
		<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Referencia</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->name ?></td>
					<td><?php echo $producto->categoria ?></td>
					<td><?php echo $producto->referencia ?></td>
					<td><?php echo $producto->Precio ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<h3 class="text-right">Total de la compra: $<?php echo $granTotal; ?>.000 Pesos</h3>
		<form action="./terminarVenta.php" method="POST" class="text-right">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form> <br>
		
	</div>
<?php include_once "footer-page.php" ?>