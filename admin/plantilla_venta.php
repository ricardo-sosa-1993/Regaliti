<?php session_start();?>
<html>
	<head>
		<title>Detalle de venta</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
		<script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
		<script>
			$(document).ready(function(){
				$('#eliminar').click(function() {
					var r = confirm("¿Quieres borrar la venta?");
					if(r){
						location.href = "borra_venta.php?Id_venta="+$('#id_venta').val();
					}
				});
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-default barra_breadcrumb">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="pull-left" href="#"><img src="../logo_regaliti.png" width="190px" height="100px"></a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li><a href ="registrar_venta.php">Registrar venta</a></li>
			      <li class="active"><a href ="ventas.php">Ventas</a></li> 
			      <li><a  href ="productos.php">Productos</a></li>
			      <li><a href ="agregar_producto.php">Agregar producto</a></li>
			      <li><a href="categorias.php">Categorias</a></li>
			      <li><a href="agregar_categoria.php">Agregar categoria</a></li>
			      <li><a href="agregar_administrador.php">Usuarios</a></li>
			      <li><a href='reportes.php'>Reportes</a></li>
			    </ul>
			    <?php  
					if(!$_SESSION){
						echo "<script>location.href='index.php';</script>";
					}else{
						echo "<ul class='nav navbar-nav navbar-right'>
									<li><a>Administrador: ",$_SESSION["Nombre_usuario"],"</a></li>
									<li><a href='salir.php'>Cerrar sesión</a><li>
							</<ul>";
					}
				?>
			  </div>
	</nav>
	<ul class="breadcrumb">
	    <li><a href="ventas.php">Ventas</a></li>
	    <li class="active">Detalle de venta</li>
	</ul>
		<div class="container">
		<center>
		<?php
			include "../conexion.php";
			$id_venta = $_GET["id_venta"];
			$link  = conectarse();
			if($link){
				$result=mysqli_query($link,"select Id_usuario,DATE_FORMAT(Fecha_venta, '%d-%m-%Y') as Fecha from Vende where Folio_vende = ".$id_venta.";");
				$row=mysqli_fetch_array($result);
				$result2=mysqli_query($link,"select * from Vende,Usuario where Vende.Id_usuario=Usuario.Id_usuario and Usuario.Id_usuario=".$row["Id_usuario"]);
				$row2=mysqli_fetch_array($result2);
				echo "<br><br>
						<a href='editar_venta.php?id_venta=",$id_venta,"'>Editar</a><br>
						<input type='hidden' value='",$id_venta,"' id='id_venta'>
						<input type='button' class='link' id='eliminar' value='Eliminar'><br>
						Folio: ",$id_venta,"<br>
						Fecha: ",$row["Fecha"],"<br>
						Venta realizada por: <b>",$row2["Nombre_usuario"],"</b><br><br>";
				mysqli_close($link);
			}
		?>
		Artículos de la venta:
		<table class='tabla'>
				<thead>
					<tr>
						<th>Id del artículo</th>
						<th>Artículo</th>
						<th>Cantidad</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
		<?php
			$link  = conectarse();
			if($link){
							$result=mysqli_query($link," select * from Vende,Detalle_venta,Articulo where Vende.Folio_vende = ".$id_venta." and Detalle_venta.Folio_vende = ".$id_venta." and Detalle_venta.Id_articulo = Articulo.Id_articulo");
							while($row=mysqli_fetch_array($result)){
								echo "<tr>
										<td>",$row["Id_articulo"],"</td>
										<td>",$row["Nombre_articulo"],"</td>
										<td>",$row["Cantidad"],"</td>
										<td>$",$row["Subtotal"],"</td>
									</tr>";
							}
							$result=mysqli_query($link,"select * from Vende where Folio_vende = ".$id_venta.";");
							$row=mysqli_fetch_array($result);
							echo "
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th>Total</th>
										<th>$",$row["Total"],"</th>
									</tr>
								</tfoot>
								</table>
								";
							mysqli_close($link);
						}
		?>
		</tbody>
		</table>
		</center>
		</div>
		</body>
</html>