<?php
	include "../conexion.php";
	$link = conectarse();
	mysqli_query($link,"delete from Detalle_venta where Folio_vende=".$_GET["Id_venta"]);
	mysqli_query($link,"delete from Vende where Folio_vende=".$_GET["Id_venta"]);
	header("Location: ventas.php");
?>