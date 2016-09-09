<?php
	include "../conexion.php";
	$link = conectarse();
	$i=0;
	$result = mysqli_query($link,"select * from Detalle_venta,Articulo where Folio_vende=".$_POST["id_venta"]." and Detalle_venta.Id_articulo=Articulo.Id_articulo");
	while($row=mysqli_fetch_array($result)){
		if($row["Activo"==0]){
			$articulos[$i]["cantidad"] = "<input type='number' class='cantidad' id='".$row["Id_articulo"]."' min='1' value='".$row["Cantidad"]."' disabled>";
		}else{
			$articulos[$i]["cantidad"] = "<input type='number' class='cantidad' id='".$row["Id_articulo"]."' min='1' value='".$row["Cantidad"]."'>";
		}
		$articulos[$i]["id_articulo"] = $row["Id_articulo"];
		$articulos[$i]["nombre"] = $row["Nombre_articulo"];
		$articulos[$i]["precio"] = $row["Precio"];
		$articulos[$i]["subtotal"] = $row["Subtotal"];
		$articulos[$i]["boton"] = "<input type='button' class='eliminar' value='Eliminar' >";
		$i++;
	}
	echo json_encode($articulos);
?>