<?php
	function ConectarseServidor()
	{
	    if(!$_SESSION['link'] = mysqli_connect("localhost", "root", "", "inderval_ventanillaunica"))
		{
			echo "Error conectando a la base de datos.";
			exit();
		}
		mysqli_query($_SESSION['link'], "SET NAMES 'utf8'");
		//echo "Conexión con la base de datos conseguida.<br>";
		return $_SESSION['link'];
	}

	function ConectarseBaseDatos($link)
	{
		//if (!mysqli_select_db("inderval_ventanillaunica",$link))
		//{
		//	echo "Error seleccionando la base de datos.";
		//	exit();
		//}
		//echo "Selección con la base de datos conseguida.<br>";
	}

	function desconectarse($link)
	{
		if(!mysqli_close($_SESSION['link']))
		{
			echo "FALLO CERRANDO LA CONEXION";
			exit();
		}; //cierra la conexion
		//echo "se cerro la base de datos";
	}

	function consultas($consulta)
	{
	    $respuesta=mysqli_query($_SESSION['link'],$consulta);
		if(!$respuesta){
			 echo mysqli_error($_SESSION['link'])." => ".$consulta;
		}
		return $respuesta;
	}
	
	
?>