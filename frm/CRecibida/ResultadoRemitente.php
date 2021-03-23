<?php 
	//Declaro Variables
	$nuRemitente 		= $_REQUEST ['cmbRemitente'];
	
	
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	$sbHtml='';
	
	 include_once("../../src/conexion.php");
	 //Conexión con el servidor
	 $link=ConectarseServidor();

	 //Conexión con la base de datosrecepcion
	 ConectarseBaseDatos($link);

	 
	 	 //realiza consulta a la base de datos
	 $sqlInterno = "SELECT rti.id, d.descripcion
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id
			";

		 //realiza consulta a la base de datos
	 $sqlExterno = "SELECT rte.id, rte.nombre
			FROM remitentesexternos rte 
			";
				 
	 //$resultExterno=mysqli_query($link,$sqlExterno);
	 $resultInterno=mysqli_query($link,$sqlInterno);
	
	
	 /*////////////////////////////////////////////////////////
			INICIO REMITENTE ESTERNO 
	 /////////////////////////////////////////////////////////*/
	
	if($nuRemitente == 1){
	
	$sbHtml='
	

    <input id="tags" />

<script>
    $(function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "holassssssssssss",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    });
</script>

				
 ';
	
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
<a href='../RteInterno/Ingresar.php?id=0'><img src = '../../img/nuevo.png' width='20' height='20'></a>
<div class='ui-widget'>
    <label for='tags'>Tags: </label>
    <input id='tags' />
</div>
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
	