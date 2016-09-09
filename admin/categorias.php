<?php session_start();?>
<html>
	<head>
		<title>Categorias</title>
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
							var r = confirm("¿Seguro que deseas eliminar las categorias seleccionadas?");
							if(r){
								$.ajax({    //create an ajax request to load_page.php
						        type: "post",
						        url: "elimina_categoria.php",  
						        	data: {categorias: chkArray},  

						        success: function(data){		
						        		
					    				location.href= 'categorias.php';                             
						        }

				    			});
							}
						}

					
				});
				$( "#boton_editar" ).click(function() {
					var nombre_categoria = $("input[name='radio_editar']:checked").val();
					if(nombre_categoria==null){
						alert("No has seleccionado ningún elemento");
					}else{
						location.href= 'editar_categoria.php?Nombre_categoria='+nombre_categoria;
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
			      <li class="active"><a href="categorias.php">Categorias</a></li>
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
	    <li class="active">Categorias</li>
	</ul>
		<div class="container">
		<center>
		<br><br>
		<div class="botones">
		<input type="button" id="boton_editar" value="Editar">
		<input type="button" id="boton_borrar" value="Eliminar"><br>
		</div>
		<table class='tabla'>
				<thead>
					<tr>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
		<?php
			include "../conexion.php";
			$link  = conectarse();
			if($link){
							$result=mysqli_query($link,"select * from Categoria where Activo=1");
							echo mysqli_error($link);
							while($row=mysqli_fetch_array($result)){
								echo "<tr>
										<td><img src='../",$row["Imagen"],"'  width='100px' height='100px'></td>
										<td>",$row["Nombre_categoria"],"</td>
										<td>",$row["Descripcion"],"</td>
										<td><input type='radio' name='radio_editar' value='",$row["Nombre_categoria"],"'></td>
										<td><input type='checkbox' class='chk' value='",$row["Nombre_categoria"],"'</td>
									</tr>";
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