<?php
	function conectarse(){
		if(!($link=mysqli_connect("localhost","miuser","mipass","regaliti"))){
			echo mysqli_error($link);
			echo "Error conectando con la base de datos";
			exit();
		}
		mysqli_set_charset ( $link , "utf8" );
		return $link;
	}
?>