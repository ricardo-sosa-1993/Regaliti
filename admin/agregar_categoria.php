<?php session_start();?>
<html>
	<head>
		<title>Agregar categoria</title>
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
			      <li><a href ="agregar_producto.php">Agregar producto</a></li>
			      <li><a href="categorias.php">Categorias</a></li>
			      <li class="active"><a href="agregar_categoria.php">Agregar categoria</a></li>
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
	    <li class="active">Agregar categoria</li>
	</ul>
		<div class="container">
		<center>
			<FORM class="formulario" action="agregar_categoria.php" method="post" enctype="multipart/form-data">
				<h1>Agregar categoria</h1>
	    		<table>
		    		<tr>
		    			<td>Nombre de la categoria: <INPUT type="text" name="nombre_categoria" required></td>
		    		</tr>
					<tr>
						<td>Imagen:</td>
					</tr> 
					<tr> 
						<td><input type="file" name="archivo" id="archivo" accept="image/*" required></td>
					</tr>
					<tr>
		    			<td>Descripción:</td>
		    		</tr> 
		    		<tr>
		    			<td><INPUT type="text" name="descripcion" required></td>
		    		</tr>
					<tr>
						<td><INPUT type="submit" value="Enviar"> </td>
					</tr>
		    	</table>
					<?php
					include "inserta_categoria.php";
						if($_POST){
							insertar();
						}
					?>
				
 			</FORM>
 			</center>
		</div>
		</body>
</html>