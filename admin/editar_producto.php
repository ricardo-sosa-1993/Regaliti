<?php session_start();?>
<html>
	<head>
		<title>Editar producto</title>
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
			      <li class="active"><a  href ="productos.php">Productos</a></li>
			      <li><a href ="agregar_producto.php">Agregar producto</a></li>
			      <li><a href="categorias.php">Categorias</a></li>
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
	    <li><a href="productos.php">Productos</a></li>
	    <li class="active">Editar producto</li>
	</ul>
		<div class="container">
		<center>
			<FORM class="formulario" action="edita_producto.php" method="post" enctype="multipart/form-data">
	    	<table>
	    		<h1>Editar producto</h1>
	    		<?php
	    			include "../conexion.php";
					$link = conectarse();
					$result = mysqli_query($link,"select * from Articulo where Id_articulo=".$_GET["Id_articulo"]);
					$articulo = mysqli_fetch_array($result); 
	    		?>
	    		<tr>
	    			<td>Nombre:</td> 
	    		</tr>
	    		<tr>
	    			<td><INPUT type="text" name="nombre" value='<?php echo $articulo["Nombre_articulo"];?>' required></td>
	    		</tr>
	    		<tr>
	    			<td>Descripción:</td>
	    		</tr>
	    		<tr>
	    			<td> <INPUT type="text" name="descripcion" value='<?php echo $articulo["Descripcion"];?>' required></td>
	    		</tr>
	    		<tr>
	    			<td>Categoria:</td>
	    		</tr>
	    		<tr>
	    			<td>
						<?php
							$result=mysqli_query($link,"select * from Categoria");
							echo "<select name='categoria' required>";
							while($row=mysqli_fetch_array($result)){
								if($row["Nombre_categoria"]==$articulo["Categoria"]){
									echo "<option value='",$row["Nombre_categoria"],"' selected='selected'>",$row["Nombre_categoria"],"</option>";
								}else{
									echo "<option value='",$row["Nombre_categoria"],"'>",$row["Nombre_categoria"],"</option>";
								}
							}
						?> 
						</select>
					</td>
				</tr>
				<tr>
					<td>Precio:</td> 
				</tr>
				<tr>
					<td><INPUT type="decimal" name="precio" value='<?php echo $articulo["Precio"];?>' required></td>
				</tr>
				<tr>
					<td>Imagen:</td> 
				</tr>
				<tr>
					<td><input type="file" name="archivo" id="archivo" accept="image/*"></td>
				</tr>
				<tr>
						<td>Existencias:</td>
				</tr> 
				<tr>
						<td><INPUT type="number" min="1" name="stock" value='<?php echo $articulo["Stock"];?>' required></td>
				</tr>
				<tr>
					<input type="hidden" name="Id_articulo" value="<?php echo $_GET['Id_articulo']; ?>">
					<td><INPUT type="submit" value="Enviar"></td>
				</tr>
	    		</table>
				<?php
					mysqli_close($link);
				?>
 			</FORM>
 			</center>
		</section>
		</body>
</html>