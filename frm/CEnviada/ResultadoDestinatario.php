<?php //C�digo para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexi�n con el servidor
	 $link=ConectarseServidor();

	 //Conexi�n con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 ?>	
 
<?php


 
	//Declaro Variables
	$nuRemitente 		= $_POST ['cmbDestinatario'];
	
	
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	
	
	
	
	 
	 	 //realiza consulta a la base de datos
	 $sqlInterno = "SELECT rti.id, d.descripcion
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id
			";

		 //realiza consulta a la base de datos
	 $sqlExterno = "SELECT rte.id, rte.nombre
			FROM remitentesexternos rte 
			";
				 
	 $resultExterno=mysqli_query($link,$sqlExterno);
	 $resultInterno=mysqli_query($link,$sqlInterno);
	
	
	 /*////////////////////////////////////////////////////////
			INICIO REMITENTE ESTERNO 
	 /////////////////////////////////////////////////////////*/
	
	if($nuRemitente == 1){
	$sbHtml="

   

		
	
	<select name='cmbDependencia' id='cmbDependencia'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowExterno=mysqli_fetch_array($resultExterno))
			    {
				
			   	  $sbHtml.="<option ";
				 
					  
				  $sbHtml.= " value=$rowExterno[0]>";
				  $sbHtml.= $rowExterno[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultExterno);
		    // ------------------------------------------------------------	
$sbHtml.="	 
</select>
<a href='../RteExterno/Ingresar.php?id=0'><img src = '../../img/nuevo.png' width='20' height='20'><a>

	";
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN REMITENTE EXTERNO 
	 /////////////////////////////////////////////////////////*/
	
	 /*////////////////////////////////////////////////////////
			INICIO REMITENTE INTERNO 
	 /////////////////////////////////////////////////////////*/
	if($nuRemitente == 2){
	
	$sbHtml="
	<select name='cmbDependencia' id='cmbDependencia'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowInterno=mysqli_fetch_array($resultInterno))
			    {
				
			   	  $sbHtml.="<option ";
				 
					  
				  $sbHtml.= " value=$rowInterno[0]>";
				  $sbHtml.= $rowInterno[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultInterno);
	
		$sbHtml.="	 
</select>
<a href='../RteInterno/Ingresar.php?id=0'><img src = '../../img/nuevo.png' width='20' height='20'><a>

	";
	}
		 /*////////////////////////////////////////////////////////
			FIN REMITENTE INTERNO 
	 /////////////////////////////////////////////////////////*/
	
	
		 
		 
	 /*////////////////////////////////////////////////////////
			INCIO CAMPO VACIO
	 /////////////////////////////////////////////////////////*/
	if($nuRemitente == ''){
	$sbHtml='
	<input  type="text" disabled>	</div>
	';
	}
		 
	 /*////////////////////////////////////////////////////////
			FIN CAMPO VACIO
	 /////////////////////////////////////////////////////////*/
  	 
	
	 
echo $sbHtml;

?>
	