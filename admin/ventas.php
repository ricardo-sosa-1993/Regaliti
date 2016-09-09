<?php session_start();?>
<html>
	<head>
		<title>Ventas</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
	</head>
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
	    <li class="active">Ventas</li>
	</ul>
		<div class="container">
		<center>
		<br><br>
		<form method="post" action="ventas.php">
			Buscar por 
			mes: <select name="mes">
					<option value="1">Enero</option>
					<option value="2">Febrero</option>
					<option value="3">Marzo</option>
					<option value="4">Abril</option>
					<option value="5">Mayo</option>
					<option value="6">Junio</option>
					<option value="7">Julio</option>
					<option value="8">Agosto</option>
					<option value="9">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
			año: <select name="ano">
					<?php
						for($i=date("Y");$i>1900;$i--)
							echo "<option value='",$i,"'>",$i,"</option>";
					?>
				</select>
			<input type="submit" value="Enviar">
		</form>
		<?php
			if(!$_POST){
		?>
		<table class='tabla'>
				<thead>
					<tr>
						<th>Folio</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
		<?php
			include "../conexion.php";
			$link  = conectarse();
			if($link){

							$result=mysqli_query($link," select Folio_vende, Total, DATE_FORMAT(Fecha_venta, '%d-%m-%Y') as Fecha, DATE_FORMAT(Fecha_venta,'%H:%i:%s') as Hora from Vende");
							echo mysqli_error($link);
							while($row=mysqli_fetch_array($result)){
								echo "<tr>
										<td>",$row["Folio_vende"],"</td>
										<td>",$row["Fecha"],"</td>
										<td>",$row["Hora"],"</td>
										<td>$",$row["Total"],"</td>
										<td><a href='plantilla_venta.php?id_venta=",$row["Folio_vende"],"'>Detalle</a></td>
									</tr>";
							}
							mysqli_close($link);
						}
		?>
		</tbody>
		</table>
		<?php
			}else{
		?>
		<table class='tabla'>
				<thead>
					<tr>
						<th>Folio</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
		<?php
		include "../conexion.php";
			$link  = conectarse();
			if($link){
							switch ($_POST["mes"]) {
							    case 1:
							        $mes = "Enero";
							        break;
							    case 2:
							        $mes = "Febrero";
							        break;
							    case 3:
							        $mes = "Marzo";
							        break;
							    case 4:
							        $mes = "Abril";
							        break;
							    case 5:
							        $mes = "Mayo";
							        break;
							    case 6:
							        $mes = "Junio";
							        break;
							    case 7:
							        $mes = "Julio";
							        break;
							    case 8:
							        $mes = "Agosto";
							        break;
							    case 9:
							        $mes = "Septiembre";
							        break;
							    case 10:
							        $mes = "Octubre";
							        break;
							    case 11:
							        $mes = "Noviembre";
							        break;
							    case 11:
							        $mes = "Diciembre";
							        break;
							}
							echo "Resultados del mes ".$mes." del año ".$_POST["ano"];
							$result=mysqli_query($link," select Folio_vende, Total, DATE_FORMAT(Fecha_venta, '%d-%m-%Y') as Fecha, DATE_FORMAT(Fecha_venta,'%H:%i:%s') as Hora from Vende where YEAR(Fecha_venta)=".$_POST["ano"]." and MONTH(Fecha_venta)=".$_POST["mes"]);
							echo mysqli_error($link);
							while($row=mysqli_fetch_array($result)){
								echo "<tr>
										<td>",$row["Folio_vende"],"</td>
										<td>",$row["Fecha"],"</td>
										<td>",$row["Hora"],"</td>
										<td>$",$row["Total"],"</td>
										<td><a href='plantilla_venta.php?id_venta=",$row["Folio_vende"],"'>Detalle</a></td>
									</tr>";
							}
							mysqli_close($link);
						}
		?>
		</tbody>
		</table>
		<?php
			}
		?>
		</center>
		</section>
		</body>
</html>