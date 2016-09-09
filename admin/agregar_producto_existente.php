<?php session_start();?>
<html>
	<head>
		<title>Agregar producto</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
	</head>
	<body>
		<nav class="navbar navbar-default barra_breadcrumb">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="pull-left" href="#"><img src="../logo_regaliti.png" width="190px" height="100px"></a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li><a href ="registrar_venta.php">Registrar venta</a></li>
			      <li><a href ="ventas.php">Ventas</a></li> 
			      <li><a  href ="productos.php">Productos</a></li>
			      <li class="active"><a href ="agregar_producto.php">Agregar producto</a></li>
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
		<li><a href="agregar_producto.php">Agregar producto</a></li>
	    <li class="active">Reactivar producto</li>
	</ul>
		<div class="container">
		<center>
			<FORM class='formulario' action="agregar_producto_existente.php" method="post" enctype="multipart/form-data">
	    		<h1>Reactivar producto</h1>
	    		<table>
		    		<tr>
		    			<td>Articulo:</td>
		    		</tr>
		    		<tr>
		    			<td>
							<?php
								include "../conexion.php";
								$link = conectarse();
								$result=mysqli_query($link,"select * from Articulo where Activo=0");
								echo mysqli_error($link);
								echo "<select name='Articulo' required>";
								while($row=mysqli_fetch_array($result)){
									echo "<option value='",$row["Id_articulo"],"'>",$row["Nombre_articulo"],"</option>";
								}
							?> 
							</select>
						</td>
					</tr>
					<tr>
						<td><INPUT type="submit" value="Enviar"></td>
					</tr>
		    		
					<?php
					include "inserta_producto_existente.php";
						if($_POST){
							mysqli_close($link);
							insertar();
						}
					?>
				</table>
 			</FORM>
 			</center>
		</div>
		</body>
</html>