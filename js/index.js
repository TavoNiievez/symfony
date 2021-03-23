function isEmptyFields(form) {
  if (form.login.value=='') {
    alert ('El campo login es requerido')
    form.login.focus();
  	return false;
  }
  if (form.clave.value=='') {
	alert ('El campo Clave es requerido')
    form.clave.focus();
    return false;
  }
  return true;
}