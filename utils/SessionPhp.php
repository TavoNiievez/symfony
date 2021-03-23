<?php


session_start();
 
define ("KEY_SESSION","VENUS");

function getSession( $sbNombreSession ) {
    return $_SESSION[ md5($sbNombreSession.KEY_SESSION) ];
}

function setSession( $sbNombreSession , $sbValorSession ) {
    $_SESSION[ md5($sbNombreSession.KEY_SESSION) ] = $sbValorSession;
}

function endSession() {
    $sbNombreSession = "Login";
        unset($_SESSION[md5($sbNombreSession.KEY_SESSION)]);
        $_SESSION[ md5($sbNombreSession.KEY_SESSION) ] = ""; 
		
	
}
?>