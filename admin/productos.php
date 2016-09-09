<?php session_start();?>
<html>
	<head>
		<title>Productos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
		<script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$( "#boton_borrar" ).click(function() {
						
						var chkArray = [];
						$(".chk:checked").each(function() {
							chkArray.push($(this).val());
						});
						if (chkArray.length === 0) {
						    alert("No has seleccionado ningún elemento");
						}else{
							var r = confirm("¿Seguro que deseas eliminar los productos seleccionados?");
							if(r){
								$.ajax({    //create an ajax request to load_page.php
							        type: "post",
							        url: "elimina_producto.php",  
							        	data: {articulos: chkArray},  

							        success: function(data){		
						    				location.href= 'productos.php';                             
							        }

					    		});
							}
						}
				});
				$( "#boton_editar" ).click(function() {
					var id_producto = $("input[name='radio_editar']:checked").val();
					if(id_producto==null){
						alert("No has seleccionado ningún elemento");
					}else{
						location.href= 'editar_producto.php?Id_articulo='+id_producto;
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
			      <li><a href ="ventas.php">Ventas</a></li> 
			      <li class="active"><a  href ="productos.php">Productos</a></li>
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
	    <li class="active">Productos</li>
	</ul>
		<div class="container">
		<center>
		<br><br>
		<form action="productos.php" method="get">
			Buscar por nombre de producto o categoría:
			<input type="text" name="busqueda">
			<input type="submit" value="Buscar">
		</form>
		<div class="botones">
		<input type="button" id="boton_editar" value="Editar">
		<input type="button" id="boton_borrar" value="Eliminar"><br>
		</div>
		<table class='tabla'>
				<thead>
					<tr>
						<th>Id del artículo</th>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Categoría</th>
						<th>Descripción</th>
						<th>Existencias</th>
						<th>Precio unitario</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
		<?php
			include "../conexion.php";
			$link  = conectarse();
			if($link){
							$result=mysqli_query($link,"select * from Articulo where Activo=1");
							if($_GET){
								$busqueda = $_GET["busqueda"];
								if($busqueda !== ''){
									while($row=mysqli_fetch_array($result)){
										if((strpos(strtolower($row["Nombre_articulo"]), strtolower($busqueda)) !== false) || (strpos(strtolower($row["Categoria"]), strtolower($busqueda)) !== false)){
											echo "<tr>
													<td>",$row["Id_articulo"],"</td>
													<td><img src='../".$row["Imagen"]."' width='100px' height='100px'></td>
													<td>",$row["Nombre_articulo"],"</td>
													<td>",$row["Categoria"],"</td>
													<td>",$row["Descripcion"],"</td>
													<td>",$row["Stock"],"</td>
													<td>$",$row["Precio"],"</td>
													<td><input type='radio' name='radio_editar' value='",$row["Id_articulo"],"'></td>
													<td><input type='checkbox' class='chk' value='",$row["Id_articulo"],"'></td>
												</tr>";
										}
									}
								}
							}else{
								while($row=mysqli_fetch_array($result)){
									echo "<tr>
											<td>",$row["Id_articulo"],"</td>
											<td><img src='../".$row["Imagen"]."' width='100px' height='100px'></td>
											<td>",$row["Nombre_articulo"],"</td>
											<td>",$row["Categoria"],"</td>
											<td>",$row["Descripcion"],"</td>
											<td>",$row["Stock"],"</td>
											<td>$",$row["Precio"],"</td>
											<td><input type='radio' name='radio_editar' value='",$row["Id_articulo"],"'></td>
											<td><input type='checkbox' class='chk' value='",$row["Id_articulo"],"'></td>
										</tr>";
								}
							}
							mysqli_close($link);
						}
		?>
		</tbody>
		</table>
		</center>
		</div>
		</body>
</html>