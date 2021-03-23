<?php

   $sessionLogin = getSession("Perfil");


    //<td><a href="../../frm/RteInterno/Lista.php">Rte. Interno</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
    //<td><a href="../../frm/Maestro/Ingresar.php">Maestros</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>   
$sbHtml = '';
   if($sessionLogin==1){
   
$sbHtml ='

<div id="menu">
<br>
<center>
	<table>
	<tr>
<tr>
	<td>&nbsp;&nbsp;<a href="../../frm/CRecibida/Lista.php">C. Recibida</a>&nbsp;&nbsp;|&nbsp;&nbsp; </td>   
    <td><a href="../../frm/CEnviada/Lista.php">C. Enviada</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
    <td><a href="../../frm/RteExterno/Lista.php">Rte. Externo</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="../../frm/Reportes/Ingresar.php">Reportes</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="../../frm/Usuario/Lista.php">Usuarios</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="../../frm/Trazabilidad/Lista.php">Trazabilidad</a></td>
	<tr>
	</table>
	</center>
	</div>';
	}

if($sessionLogin==2){
   
$sbHtml ='
<div id="menu">
<center>
<table>
	<tr>
	<td>&nbsp;&nbsp;<a href="../frm/CRecibida/Lista.php">C. Recibida</a>&nbsp;&nbsp;|&nbsp;&nbsp; </td>   
    <td><a href="../../frm/CEnviada/Lista.php">C. Enviada</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
    <td><a href="../../frm/RteExterno/Lista.php">Rte. Externo</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
    <td><a href="../../frm/Reportes/Ingresar.php">Reportes</a>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="../../frm/Trazabilidad/Lista.php">Trazabilidad</a></td>

		</tr>
	</table>
	</center>
</div>';}

echo $sbHtml;
	 ?>