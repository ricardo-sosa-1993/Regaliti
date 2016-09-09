<?php
	function insertar(){
		$link  = conectarse();
		if($link){
			if($_POST["contrasena"]==$_POST["confirma_contrasena"]){
				$result=mysqli_query($link,"select * from Usuario where Nombre_usuario='".$_POST["nombre"]."' and Activo=1");
				if(mysqli_num_rows($result)==0){
					if(mysqli_query($link,"insert into Usuario (Nombre_usuario,Contrasena) values ('".$_POST["nombre"]."','".$_POST["contrasena"]."')")){
						echo "<script>alert('Se agregó exitosamente el usuario');</script>";
					}else{
						echo mysqli_error($link);
					}
				}else{
					echo "<script>alert('Ya existe un usuario con ese nombre');</script>";
				}
			}else{
				echo "<script>alert('Las contraseñas no coinciden');</script>";
			}
			mysqli_close($link);
		}
	}