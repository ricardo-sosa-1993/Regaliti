<?php session_start();?>
<html>
	<head>
		<title>Usuarios</title>
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
							var r = confirm("¿Seguro que deseas eliminar los usuario seleccionados?");
							if(r){
								$.ajax({    //create an ajax request to load_page.php
							        type: "post",
							        url: "elimina_usuario.php",  
							        	data: {usuarios: chkArray},  

							        success: function(data){		
						    				location.href= 'agregar_administrador.php';                             
							        }

					    		});
							}
						}
				});
				$( "#boton_editar" ).click(function() {
					var id_usuario = $("input[name='radio_editar']:checked").val();
					if(id_usuario==null){
						alert("No has seleccionado ningún elemento");
					}else{
						location.href= 'editar_administrador.php?Id_usuario='+id_usuario;
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
			      <li><a  href ="productos.php">Productos</a></li>
			      <li><a href ="agregar_producto.php">Agregar producto</a></li>
			      <li><a href="categorias.php">Categorias</a></li>
			      <li><a href="agregar_categoria.php">Agregar categoria</a></li>
			      <li class="active"><a href="agregar_administrador.php">Usuarios</a></li>
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
	    <li class="active">Usuarios</li>
	</ul>
		<div class="container">
		<center>
			<FORM class="formulario" action="agregar_administrador.php" method="post">
				<h1>Nuevo usuario</h1>
	    		<table>
		    		<tr>
		    			<td>Nombre del usuario: <INPUT type="text" name="nombre" required></td>
		    		</tr>
		    		<tr>
		    			<td>Contraseña: <INPUT type="password" name="contrasena" required></td>
		    		</tr>
		    		<tr>
		    			<td>Confirma contraseña: <INPUT type="password" name="confirma_contrasena" required></td>
		    		</tr>
					<tr>
						<td><INPUT type="submit" value="Enviar"> </td>
					</tr>
		    	</table>
					<?php
					include "inserta_usuario.php";
					include "../conexion.php";
						if($_POST){
							insertar();
						}
					?>
 			</FORM>
 			<div class="tabla"> 
 				<h1>Usuarios registrados</h1>
 				<br><br>
 				<div class="botones">
				<input type="button" id="boton_editar" value="Editar">
				<input type="button" id="boton_borrar" value="Eliminar"><br>
				</div>
 				<table>
 					<thead>
 						<tr>
 							<th>Nombre</th>
 							<th>Editar</th>
 							<th>Eliminar</th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php
 							$link= conectarse();
	 						$result=mysqli_query($link,"select * from Usuario where Activo=1");
								echo mysqli_error($link);
								while($row=mysqli_fetch_array($result)){
									if($_SESSION["Id_usuario"]==$row["Id_usuario"]){
										$eliminar ="";
										$editar = "<input type='radio' name='radio_editar' value='".$row["Id_usuario"]."'>";
									}else{
										$eliminar = "<input type='checkbox' class='chk' value='".$row["Id_usuario"]."'>";
										$editar = "";
									}
									echo "<tr>
											<td>",$row["Nombre_usuario"],"</td>
											<td>",$editar,"</td>
											<td>",$eliminar,"</td>
										</tr>";
								}
								mysqli_close($link);
					
						?>
 					</tbody>
 				</table>
 			</div>
 			</center>
		</div>
		</body>
</html>