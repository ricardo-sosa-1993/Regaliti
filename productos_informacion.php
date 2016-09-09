<html>
	<head>
		<title>Productos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
			<nav class="navbar navbar-default barra_breadcrumb">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="pull-left" href="#"><img src="logo_regaliti.png" width="190px" height="100px"></a>
			    </div>
			    <ul class="nav navbar-nav navbar-right">
			      <li><a href ="index.php">Inicio</a></li>
			      <li class="active"><a href ="productos_informacion.php">Productos</a></li> 
			      <li><a href="contacto.php">Contacto</a></li>
			    </ul>
			  </div>
			</nav>
			<ul class="breadcrumb">
			    <li class="active">Categorias</li>
			</ul>
			<div class="container">
		
				  <?php
				  	include "conexion.php";
				  	$link = conectarse();
				  	$result = mysqli_query($link,"select * from Categoria where activo=1");
				  	while($row=mysqli_fetch_array($result)){
				  		echo "<div class='row featurette'>
						        <div class='col-md-7 col-md-push-5'>
						          <h2 class='featurette-heading'><a href='plantilla_productos.php?categoria=",$row["Nombre_categoria"],"'><span class='text-muted'>",$row["Nombre_categoria"],"</span></a></h2>
						          <p class='lead'>",$row["Descripcion"],"</p>
						        </div>
						        <div class='col-md-5 col-md-pull-7'>
						          <img src='",$row["Imagen"],"' class='img-circle'  width='204' height='136'>
						        </div>
						      </div>

						      <hr class='featurette-divider'>
				  				";
				  	}
				  	mysqli_close($link);
				  ?>
			</div> 
		</body>
</html>