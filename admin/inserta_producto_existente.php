<?php
	function insertar(){
		$link  = conectarse();
		mysqli_query($link,"update Articulo set Activo=1 where Id_articulo=".$_POST["Articulo"]);
		echo "<script>
				alert('Se reactivó el producto');
				location.href= 'agregar_producto.php';
			</script>";
	}
?>