<?php
	include "../conexion.php";
	$link = conectarse();
	$result = mysqli_query($link,"select * from Articulo where Id_articulo=".$_POST["Id_articulo"]);
	$row = mysqli_fetch_array($result);
		$articulo["stock"] = $row["Stock"];
		$articulo["nombre"] = $row["Nombre_articulo"];
		$articulo["subtotal"] = $row["Precio"] * $_POST["cantidad"];
		$articulo["id_articulo"] = $row["Id_articulo"];
		$articulo["cantidad"] = "<input type='number' class='cantidad' id='".$row["Id_articulo"]."' min='1' value='".$_POST["cantidad"]."'>";
		$articulo["precio"] = $row["Precio"];
		$articulo["boton"] = "<input type='button' class='eliminar' value='Eliminar' >";

	echo json_encode($articulo);
?>