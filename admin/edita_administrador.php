<?php
	include "../conexion.php";
	$link = conectarse();
	$result = mysqli_query($link,"select * from Usuario where Nombre_usuario='".$_POST["Nombre_usuario"]."' and Activo=1 and Id_usuario!=".$_POST["Id_usuario"]);

	if(mysqli_num_rows($result)==0){
		if($_POST["Contrasena"] == $_POST["Confirma_contrasena"]){
			mysqli_query($link,"update Usuario set Nombre_usuario='".$_POST["Nombre_usuario"]."',Contrasena = '".$_POST["Contrasena"]."' where Id_usuario=".$_POST["Id_usuario"]);
			echo "<script>
				alert('Se modificó el usuario');
				location.href = 'agregar_administrador.php';
			  </script>";
		}else{
			echo "<script>
				alert('Las contraseñas ingresadas no coinciden');
				location.href = 'editar_administrador.php?Id_usuario=",$_POST["Id_usuario"],"';
			  </script>";
		}
	}else{
		echo "<script>
				alert('Ya existe otro usuario con ese nombre');
				location.href = 'editar_administrador.php?Id_usuario=",$_POST["Id_usuario"],"';
			  </script>";
	}
?>