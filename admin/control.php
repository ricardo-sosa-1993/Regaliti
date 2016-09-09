<?php
	include "../conexion.php";
	$link = conectarse(); 
	$result = mysqli_query($link,"select * from Usuario where Nombre_usuario='".$_POST["usuario"]."' and contrasena='".$_POST["contrasena"]."'");
	if(mysqli_num_rows($result) != 0){
	    $row=mysqli_fetch_array($result);
	    session_start(); 
	    $_SESSION["Nombre_usuario"] = $row["Nombre_usuario"];
	    $_SESSION["Id_usuario"]= $row["Id_usuario"];
	    header ("Location: index.php"); 
 	}else{
 		echo "<script language='javascript'>alert('Datos incorrectos');</script>";
		echo "<script>location.href='index.php';</script>";
 	}
 	mysqli_close($link);
?>