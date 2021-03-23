<?php

// Inicio de archivos PHP

class Date {
	var $dtFecha;

  function __construct() {
	$this->getFechaActual();	  
  }
  
  function getFechaActual () {
  	$this->dtFecha = date('Y-m-d');
  }
  
  function getString() {
  	$rcData = explode("-", $this->dtFecha);
  	return join('',$rcData);
  }
  
  function getDate() {
  	return $this->dtFecha;
  }
  
   function getDayOfTheWeek() {
	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('w', $nuTime); 
  }
  
  function getDay() {
	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('d', $nuTime); 
  }
  
  function getMonth () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('m', $nuTime);
  }
  
  function getYear () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('Y', $nuTime);
  }
  
  function getYearShort () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('y', $nuTime);
  }
  
  function getDayName () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date('D', $nuTime);
  }
  
  function getDateShort () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('y-m-d', $nuTime);
  }
  
}
 
 
 function getFechaActual () {
 
	date_default_timezone_set("America/Bogota");
	$dtFecha		= date('Y-m-d');
	
	return $dtFecha;
	
 }
 
 
  function getHoraActual () {
 
	date_default_timezone_set("America/Bogota");
	$dtTime			= date('H:i:s');
	
	return $dtTime;
	
 }
// Final de archivo PHP 
?>
