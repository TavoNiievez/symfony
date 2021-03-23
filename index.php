<?php include("includes/top_page.php"); ?>
<?php include("includes/headerInicio.php"); ?>
<?php include("includes/menuInicio.php"); ?>

<div id="contenido">



	<form action="src/ValidarUsuario.php" method="post" name="frmLogin" onSubmit = "return isEmptyFields(frmLogin)" ><center>
			<!--<td colspan="2"><div align="center"><img src="img/logocdvc.jpg" width="250" height="148"> </div></td>-->
	

	<table >
			<tr>
                 
                  <td><b>Login</b></td>
                  <td><b>:</b><td/>
                  <td><input name="login" type="text" id="login" size="25"></td>
             
			</tr>
			 
			<tr>
                 
                  <td><b>Clave</b></td>
                  <td><b>:</b><td/>
                  <td><input name="clave" type="password" id="clave" size="25"></td>
             
			</tr>
			
			<tr>
			
			</tr>
                     
             
      </table>
	 
	  <center><br>
	  
	  <input type="submit" name="Submit" value="Aceptar">
      <input name="Cancelar" type="reset" id="Cancelar" value="Cancelar">
      
	  </center>	  
	
	</form>
	
	</div>
	
	<?php include("includes/footerInicio.php"); ?>
