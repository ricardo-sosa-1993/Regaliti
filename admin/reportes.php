<?php session_start();?>
<html>
	<head>
		<title>Productos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd-mm-yy' });
				$( "#fecha_fin" ).datepicker({ dateFormat: 'dd-mm-yy' });
				$("#reporte1").click(function() {
					if($("#fecha_incio").val() == "" || $("#fecha_fin").val() == ""){
						alert("Hay campos de fecha vacios");
					}else{
						var fecha_inicio = $("#fecha_inicio").datepicker("getDate");
						var fecha_fin = $("#fecha_fin").datepicker("getDate");
						var ano_inicio = fecha_inicio.getFullYear();
						var mes_inicio = fecha_inicio.getMonth() + 1;
						var dia_inicio = fecha_inicio.getDate();
						var ano_fin = fecha_fin.getFullYear();
						var mes_fin = fecha_fin.getMonth() + 1;
						var dia_fin = fecha_fin.getDate();
						if(dia_inicio<10){
							dia_inicio = "0"+ dia_inicio.toString(); 
						}
						if(mes_inicio<10){
							mes_inicio = "0"+ mes_inicio.toString(); 
						}
						if(dia_fin<10){
							dia_fin = "0"+ dia_fin.toString(); 
						}
						if(mes_fin<10){
							mes_fin = "0"+ mes_fin.toString(); 
						}
						
						var url = "reporte1.php?ano_inicio="+ano_inicio+"&mes_inicio="+mes_inicio+"&dia_inicio="+dia_inicio+"&ano_fin="+ano_fin+"&mes_fin="+mes_fin+"&dia_fin="+dia_fin;
						window.open(url, "Reporte", "height=800,width=400");

					}
				});
				$("#reporte2").click(function() {
					var url = "reporte2.php?Id_usuario="+$("#empleado").val();
					window.open(url, "Reporte", "height=800,width=400");
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
			      <li><a href="agregar_administrador.php">Usuarios</a></li>
			      <li class="active"><a href="reportes.php">Reportes</a></li>
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
	    <li class="active">Reportes</li>
	</ul>
		<div class="container">
		<center>
		<br><br>
		Desde <input type="text" id="fecha_inicio"> hasta  <input type="text" id="fecha_fin"> <input type='button' id='reporte1' value='Crear reporte'><br><br>
		Ventas por empleado: 
		<select id='empleado'>
			<?php
				include "../conexion.php";
				$link = conectarse();
				$result = mysqli_query($link,"select * from Usuario where Activo=1");
				while($row=mysqli_fetch_array($result)){
					echo "<option value='",$row["Id_usuario"],"'>",$row["Nombre_usuario"],"</option>";
				}
			?>
		</select> <input type='button' id='reporte2' value='Crear reporte'>
		</center>
		</div>
		</body>
</html>