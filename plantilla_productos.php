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
		
		<?php
					include "conexion.php";
					$link  = conectarse();
					$categoria = $_GET["categoria"];
					echo "<ul class='breadcrumb'>
							    <li><a href='productos_informacion.php'>Categorias</a></li>
							    <li class='active'>",$categoria,"</li>
							</ul>";
					
		?>
		<div class="container">
		<center>
				<?php
					echo "<h2>",$categoria,"</h2>";
					if($link){
						$result=mysqli_query($link," select * from Articulo where Activo=1 and Categoria = '".$categoria."'");
  									echo "<div class='productos'>
		  										<ul>";
									while($row=mysqli_fetch_array($result)){
												echo " <li>
													      <img src='".$row["Imagen"]."' />
													      <h3>".$row["Nombre_articulo"]."</h3>
													      <p>Categoria: ".$row["Categoria"]."</p>
													      <p>Precio: $".$row["Precio"]."</p>
													      <p>Descripción: ".$row["Descripcion"]."</p>
													   </li>";
											}
										echo " </ul>
											</div>";
						
						mysqli_close($link);
					}
				?>
		</center>
		</div>
		</body>
</html>