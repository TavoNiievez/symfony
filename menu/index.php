<?php include_once ("../utils/SessionPhp.php"); ?>
<?php include_once("../src/conexion.php");	 

	//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	
	 ?>

<?php include("../includes/top_pageMenu.php"); ?>
<?php include("../includes/header.php"); ?>
<?php include("../includes/menu.php"); ?>

<?php 


    
   //saca variable perfil de la sesion
   $sessionLogin = getSession("Login");
      
if ( $sessionLogin == "") {
	$sbCadena =  "<script language='javascript'>";
	$sbCadena .= "alert('Usuario No Autenticado')";
	$sbCadena .= "</script>";
	echo $sbCadena;

	$sbCadena =  "<script language='javascript'>";
	$sbCadena .= "location.href = '../index.php'";
	$sbCadena .= "</script>";
	echo $sbCadena;  	
}
else{


 //saca variable Login de la sesion
     $sessionLogin = getSession("Login");
	 
	 	 //----------------------------------------------------------------------------
	 //Obtiene Id y nombre usuario
	 $sql2 = "SELECT u.nombre, u.apellido1, apellido2, p.descripcion, u.perfil_id
			FROM usuario u, perfil p
			WHERE u.login =  '$sessionLogin'
			AND u.perfil_id = p.id";
  			 			 
	 $result2=mysqli_query($link,$sql2);
	$row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
	 $sbNombreUser   	= $row2[0];
	 $sbApellido1User 	= $row2[1];
	 $sbApellido2User 	= $row2[2];
	 $sbPerfil		 	= $row2[3];	
	 $sbIdPerfil	 	= $row2[4];
	 
	 
	$Html='
<div id="subMenu">
		<a href="../frm/Usuario/CambiarClave.php">Cambiar Clave</a>&nbsp;&nbsp; 
		<!--<a href="../importar/src/ImportarUsuarios.php">Importar Usuarios</a>&nbsp;&nbsp; -->
	
	</div>
	
		<div id="contenido">
		<h1>BIENVENIDOS AL SOFTWARE 		</h1>
				
				<h2><BR>
				'. $sbNombreUser.'&nbsp'.$sbApellido1User.'&nbsp'.$sbApellido2User.'
				<BR>
				Cuenta de '. $sbPerfil.'
				</h2>
		
				<input name="txtIdPerfil" type="hidden" id="txtIdPerfil" value="'.$sbIdPerfil.'">

	</div>
	
	
		';


	echo $Html;
}?>
<?php include("../includes/footer.php"); ?>
