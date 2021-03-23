function clearTable (objTable) {

	while (objTable.rows.length>1)
		objTable.deleteRow(1);
	
}

function setVisible(objDocument, sbNombreElemento, blEstado ) {
	var objElemento = objDocument.getElementById (sbNombreElemento);
	if (objElemento) {
		if (blEstado)
			objElemento.style.display='';
		else
			objElemento.style.display='none';
	}
}

function onlyNumbers (event) {
  var key = event.keyCode;
  return (key<=13 || ( key>=48 && key<=57 ) );
}

function inputFicho (event) {
  var key = event.keyCode;
  return (key<=13 || ( key>=48 && key<=57 ) || key ==45 );
}

function disableRightClick() {
/*  if (event.button==2) {
    alert('Esta funcion esta deshabilitada.')
  }*/
}

function selectValidValue(field, sbName) {
  if (field[field.selectedIndex].value=="") {
  	alert('Debe seleccionar un item de '+sbName);
    field.focus();
    return false;
  }
  return true;
}

function emptyTextValue(field, sbName) {
  if (field.value==''){
    alert('Debe ingresar el '+sbName);
    field.focus();
    return false;
  } 
  return true;
}

function intValidator(field, sbName) {
  if (field.value=="") {
    alert('Debe Ingresar el '+sbName);
    field.focus();
    return false;
  } else {
  	var nuValor = parseInt(field.value);
  	if (nuValor<=0) {
  	  alert('debe ingresar un valor valido');
  	  field.focus();
  	  field.select();  	  
  	  return false;
  	}
  } 
  return true;
}
		 
function disableKeyPress(event) {
  var teclactrl=false;
  var NS=(navigator.appName == "Netscape")?true:false;   
  var keycode = (NS)?event.which:event.keyCode; 
  var tecla=(NS)?78:85; 
  teclactrl=(NS)?(keycode==17):(event.ctrlKey);
  if ((teclactrl)&&(keycode==78 ||keycode==85)){
    alert('No puede abrir una nueva ventana'); 
    return false; 
  } 
}

function FormatNumberBy3(field) {
  // check for missing parameters and use defaults if so
  num = field.value;
  sbValue = new String(field.value);
  sbValue=sbValue.replace(',','');
  num=sbValue;
  
  if (arguments.length == 2) {
    sep = ",";
  }
  if (arguments.length == 1) {
    sep = ",";
    decpoint = ".";
  }
  // need a string for operations
  num = num.toString();
  // separate the whole number and the fraction if possible
  a = num.split(decpoint);
  x = a[0]; // decimal
  y = a[1]; // fraction
  z = "";


  if (typeof(x) != "undefined") {
    // reverse the digits. regexp works from left to right.
    for (i=x.length-1;i>=0;i--)
      z += x.charAt(i);
    // add seperators. but undo the trailing one, if there
    z = z.replace(/(\d{3})/g, "$1" + sep);
    if (z.slice(-sep.length) == sep)
      z = z.slice(0, -sep.length);
    x = "";
    // reverse again to get back the number
    for (i=z.length-1;i>=0;i--)
      x += z.charAt(i);
    // add the fraction back in, if it was there
    if (typeof(y) != "undefined" && y.length > 0)
      x += decpoint + y;
  }
  return x;
}

function changeValueDHTML (sbFieldName, sbNewValue) {
  var field = document.getElementById (sbFieldName);
  if (field!= null)
  	field.innerText=sbNewValue;
}

function changeValueRemoteDHTML (form, sbFieldName, sbNewValue) {
  var field = form.getElementById (sbFieldName);
  if (field!= null)
  	field.innerText=sbNewValue;
}

function roundOff(value) {
  precision=2;
  value = "" + value //convert value to string
  precision = parseInt(precision);
  if (isNaN(value))
  	return 0;
  var whole = "" + Math.round(value * Math.pow(10, precision));
  var decPoint = whole.length - precision;
  if(decPoint != 0) {
    result = whole.substring(0, decPoint);
    result += ".";
    result += whole.substring(decPoint, whole.length);
  } else {
    result = 0;
    result += ".";
    result += whole.substring(decPoint, whole.length);
  }
  return result;
}
