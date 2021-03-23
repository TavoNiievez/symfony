<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php include_once("../../src/conexion.php");	 

	//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	
	 ?>
	 
<?php include("../../includes/top_pageForm.php"); ?>
<?php include("../../includes/headerForm.php"); ?>
<?php include("../../includes/menuForm.php"); ?>
<?php include("../../includes/subMenuInicio.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


<?php
 
 
 
	 
	 
$sbHtml='
<html>
<head>
<script src="../../js/IngresarPGA.js"></script>

<script language="javascript" src="../../js/popcalendar.js"></script> 

<title>INGRESAR REGISTROS PGA</title>
</head>
	<body>		
	 <form action="../../src/CambiarClave.php" method="post" name="crearPGA" onSubmit= "validarIngreso(this)" >
	  <center><b><h1>CAMBIAR CLAVE</b></center></h1><br>
		
		
		<table border ="0" align="CENTER" >
		
		<TR><TD>
		 <!-- //////////////////////////////// Info General/////////////////////////////////////////-->  
	
		<table border ="0" align="left">
		
		 <tr>
		     <td>
			  <label>Clave</label>
 	  	     </td>
  		     <td><b>:</b> </td>
  		     <td>
			  <input name="txtClaveAntigua" type="password" id="txtClaveAntigua"   ><br>
 	  	     </td>
			 </tr>
			 
			 <tr>
			 <td>
			  <label>Nueva Clave</label>
 	  	     </td>
  		     <td><b>:</b> </td>
  		     <td>
			  <input name="txtClaveNueva" type="password" id="txtClaveNueva"   ><br>
 	  	     </td>
		</tr>

		<tr>
			 <td>
			  <label>Confirmar Clave</label>
 	  	     </td>
  		     <td><b>:</b> </td>
  		     <td>
			  <input name="txtConfirmarClave" type="password" id="txtConfirmarClave"  " ><br>
 	  	     </td>
			 </tr>
			
		</table>
			
	</TD></TR>	
	
	</TABLE>
	
	
		<center>
		<br>
	
	 <input type="submit" name="btnIngresar" value="Ingresar">


	</form>
	

	</body> 

</html>';

echo $sbHtml;
?>

	</div>
		
<?php include("../../includes/footerForm.php"); ?>