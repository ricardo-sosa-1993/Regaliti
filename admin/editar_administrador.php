<?php session_start();?>
<html>
	<head>
		<title>Agregar administrador</title>
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
			      <li><a href="agregar_categoria.php">Agregar categoria</a></li>
			      <li class="active"><a href="agregar_administrador.php">Usuarios</a></li>
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
	    <li><a href="agregar_administrador.php">Usuarios</a></li>
	    <li class="active">Editar usuario</li>
	</ul>
		<div class="container">
		<center>
			<FORM class="formulario" action="edita_administrador.php" method="post">
			<?php 
				include "../conexion.php";
				$link = conectarse();
				$result = mysqli_query($link,"select * from Usuario where Id_usuario='".$_GET["Id_usuario"]."'");
				$row = mysqli_fetch_array($result);
			?>
				<h1>Editar usuario</h1>
	    		<table>
		    		<tr>
		    			<td>Nombre del usuario: <INPUT type="text" name="Nombre_usuario" value="<?php echo $row["Nombre_usuario"]?>" required></td>
		    		</tr>
		    		<tr>
		    			<td>Nueva contraseña: <INPUT type="password" name="Contrasena" value="<?php echo $row["Contrasena"]?>" required></td>
		    		</tr>
		    		<tr>
		    			<td>Confirma nueva contraseña: <INPUT type="password" name="Confirma_contrasena" value="<?php echo $row["Contrasena"]?>" required></td>
		    		</tr>
					<tr>
						<input type="hidden" name="Id_usuario" value="<?php echo $_GET["Id_usuario"]; ?>">
						<td><INPUT type="submit" value="Enviar"> </td>
					</tr>
		    	</table>
 			</FORM>
 			</center>
		</div>
		</body>
</html>