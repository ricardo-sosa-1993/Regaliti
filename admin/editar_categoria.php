<?php session_start();?>
<html>
	<head>
		<title>Editar categoria</title>
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
			      <li class="active"><a href="categorias.php">Categorias</a></li>
			      <li><a href="agregar_categoria.php">Agregar categoria</a></li>
			      <li><a href="agregar_administrador.php">Usuarios</a></li>
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
	    <li><a href="categorias.php">Categorias</a></li>
	    <li class="active">Editar categoria</li>
	</ul>
		<div class="container">
		<center>
			<FORM class="formulario" action="edita_categoria.php" method="post" enctype="multipart/form-data">
				<h1>Editar categoria</h1>
	    		<table>
	    		<?php
	    			include "../conexion.php";
					$link = conectarse();
					$result = mysqli_query($link,"select * from Categoria where Nombre_categoria='".$_GET["Nombre_categoria"]."'");
					$categoria = mysqli_fetch_array($result); 
	    		?>
		    		<tr>
		    			<td>Nombre de la categoria: <INPUT type="text" name="nombre_categoria"  value= "<?php echo $categoria['Nombre_categoria']; ?>" required></td>
		    		</tr>
					<tr>
						<td>Imagen:</td>
					</tr> 
					<tr> 
						<td><input type="file" name="archivo" id="archivo" accept="image/*"></td>
					</tr>
					<tr>
		    			<td>Descripción:</td>
		    		</tr> 
		    		<tr>
		    			<td><INPUT type="text" name="descripcion" value= "<?php echo $categoria['Descripcion']; ?>" required></td>
		    		</tr>
					<tr>
					<input type="hidden" name="Nombre_categoria_viejo" value="<?php echo $_GET['Nombre_categoria']; ?>">
						<td><INPUT type="submit" value="Enviar"> </td>
					</tr>
		    	</table>
				
 			</FORM>
 			</center>
		</div>
		</body>
</html>