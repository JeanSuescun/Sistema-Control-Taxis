function objetoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function enviarDatosEmpleado(){
	//donde se mostrará lo resultados
	divResultado = document.getElementById('resultado');
	divFormulario = document.getElementById('formulario');
	divResultado.innerHTML= '<img src="anim.gif">';

	//valores de los cajas de texto
	id=document.frmempleado.idempleado.value;
	nom=document.frmempleado.nombres.value;
	dep=document.frmempleado.departamento.value;
	suel=document.frmempleado.sueldo.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usando del medoto POST
	//archivo que realizará la operacion ->actualizacion.php
	ajax.open("POST", "actualizacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar los nuevos registros en esta capa
			divResultado.innerHTML = ajax.responseText
			//una vez actualizacion ocultamos formulario
			divFormulario.style.display="none";

		}
	}
	//muy importante este encabezado ya que hacemos uso de un formulario
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idempleado="+id+"&nombres="+nom+"&departamento="+dep+"&sueldo="+suel)
}

function pedirDatos(num_observacion,fecha){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta_por_id.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	ajax.send("num_observacion="+num_observacion+"&fecha="+fecha)
}

function instancias(num_observacion,fecha,nropagina){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
	//alert("Entra"+nropagina);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta_instancias.php");
	ajax.onreadystatechange=function() {
	/*	if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3)
		{

			divFormulario.innerHTML = "Cargando...."
		}
	*/
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//ajax.send(null)
	ajax.send("num_observacion="+num_observacion+"&fecha="+fecha+"&pag="+nropagina)
}
function instancias_avanzadas(num_observacion,fecha,nropagina,radio_consulta,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
	//alert("Entra"+fecha_desde);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta_instancias_avanzadas.php");
	ajax.onreadystatechange=function() {
	/*	if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3)
		{

			divFormulario.innerHTML = "Cargando...."
		}
	*/
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//ajax.send(null)
	//alert("Entra"+fecha_desde);
	//alert("Entra: "+declinacion2);
	ajax.send("num_observacion="+num_observacion+"&fecha="+fecha+"&pag="+nropagina+"&consulta="+radio_consulta+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2)
}
function instancias2(nropagina){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('resultado');
	//alert("Entra"+nropagina);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//ajax.send(null)
	ajax.send("pag="+nropagina)
}
function instancias3(nropagina,radio_consulta,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('resultado');
	//alert("Entra"+radio_consulta);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta1.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//ajax.send(null)
	ajax.send("pag="+nropagina+"&consulta="+radio_consulta+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2)
}
function instancias4(nropagina,radio_consulta,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('resultado');
	//alert("Entra"+radio_consulta);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "consulta2.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//ajax.send(null)
	ajax.send("pag="+nropagina+"&consulta="+radio_consulta+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2)
}
function mostrar_fecha(){
	//donde se mostrará el formulario con los datos
	var radio=getRadioButtonSelectedValue(document.datos.consulta);
	//alert("Entra"+radio);
	location.href=""
}
function mostrar_fecha1(){
	//donde se mostrará el formulario con los datos
	location.href="consulta_avanzada2.php"
}
function mostrar_asc(){
	//donde se mostrará el formulario con los datos
	//imagen = document.getElementById('lanzador');
	//imagen1 = document.getElementById('lanzador1');
	//imagen.style.visibility = "hidden"
	//imagen1.style.visibility = "hidden"

	var F=document.datos;
	F.fecha_desde.style.visibility = "hidden";
	F.fecha_hasta.style.visibility = "hidden";
	F.start_date.value="";
	F.start_date.disabled=true;
	F.end_date.disabled=true;
	F.end_date.value="";
	F.asc_recta.disabled=false;
	F.declinacion.disabled=false;
	F.asc_recta2.disabled=false;
	F.declinacion2.disabled=false;
	F.asc_recta.focus();

	var radio=getRadioButtonSelectedValue(document.datos.consulta);
	//radio = document.getElementById('consulta');
	//radio=radio.value;
	divFormulario = document.getElementById('asc');
	divFormulario1 = document.getElementById('fechas');
	//alert("Entra"+radio);
	//instanciamos el objetoAjax
	//ajax.send("num="+num)
}


function getRadioButtonSelectedValue(ctrl)
	{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
	}


function mostrar_ambas(){
	//donde se mostrará el formulario con los datos
	//alert("Entra");
	//imagen = document.getElementById('lanzador');
	//imagen.style.visibility="visible";
	//imagen1 = document.getElementById('lanzador1');
	//imagen1.style.visibility="visible";

	var radio=getRadioButtonSelectedValue(document.datos.consulta);
	var F=document.datos;
	var tabla=F.tabla.value;

	//var F=document.datos;
	if(radio=="ambas" && tabla=="objetos"){
		F.fecha_desde.style.visibility = "hidden";
		F.fecha_hasta.style.visibility = "hidden";
	}else{
		F.fecha_desde.style.visibility = "visible";
		F.fecha_hasta.style.visibility = "visible";
	}

	F.asc_recta.disabled=false;
	F.declinacion.disabled=false;
	F.asc_recta2.disabled=false;
	F.declinacion2.disabled=false;
	F.start_date.disabled=false;
	F.end_date.disabled=false;

	//radio = document.getElementById('consulta');
	//radio=radio.value;
	//alert("Entra"+radio);
	divFormulario = document.getElementById('asc');
	divFormulario1 = document.getElementById('fechas');
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	ajax.open("POST", "form_asc.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			//divFormulario1.innerHTML = ajax.responseText
			if(divFormulario1!=null)
			//radio.style.visibility = "hidden"
			divFormulario1.style.display="block";
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo POST
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	//alert("Entra"+num);
	ajax.send(null)
	//ajax.send("num="+num)
}
function valida_radio(){
	var radio=getRadioButtonSelectedValue(document.datos.consulta);
	var F=document.datos;
	var tabla=F.tabla.value;

	//alert("entra"+radio);
	if (tabla=="objetos"){
		//F.consulta.checked=false;
		F.fecha_desde.style.visibility = "hidden";
		F.fecha_hasta.style.visibility = "hidden";
		F.start_date.value="";
		F.start_date.disabled=true;
		F.end_date.disabled=true;
		F.end_date.value="";
		//alert("entra"+tabla);
	}
	if (tabla=="observaciones" || tabla=="instancias_objeto"){

		F.fecha_desde.style.visibility = "visible";
		F.fecha_hasta.style.visibility = "visible";
		F.start_date.disabled=false;
		F.end_date.disabled=false;
	}
}


function prueba1(){
	//alert("entraaaaaaaaaaaa");
	var F=document.datos;
	//imagen = document.getElementById('lanzador');
	//imagen1 = document.getElementById('lanzador1');
	//imagen.style.visibility = "hidden"
	//imagen1.style.visibility = "hidden"
	//var asc_recta=F.asc_recta.value;
	F.asc_recta.disabled=true;
	F.declinacion.disabled=true;
	F.asc_recta2.disabled=true;
	F.declinacion2.disabled=true;
	//F.lanzador.disabled=false;
	//alert("entra"+fecha_desde);
}


function deshabilitar(){
	//alert("entra");
	var F=document.formulario;
	//imagen = document.getElementById('lanzador');
	//imagen1 = document.getElementById('lanzador1');
	//imagen.style.visibility = "hidden"
	//imagen1.style.visibility = "hidden"
	//var asc_recta=F.asc_recta.value;
	F.asc_recta.disabled=true;
	F.declinacion.disabled=true;
	F.asc_recta2.disabled=true;
	F.declinacion2.disabled=true;
	//F.lanzador.disabled=false;
	//alert("entra"+fecha_desde);
}
////////////////// FUNCION PARA VALIDAR ACCESO////////////////
function validar_datos()
{
	function getRadioButtonSelectedValue(ctrl)
	{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
	}
	var consul=getRadioButtonSelectedValue(document.formulario.consulta);
	var F=document.formulario;
	if (consul=="fecha"){
		if (F.fecha_desde.value==""){
			alert("Debe seleccionar Fecha Desde");
			return false;
		}
		if (F.fecha_hasta.value==""){
			alert("Debe seleccionar Fecha Hasta");
			return false;
		}
	}
	if (consul=="asc"){
		if (F.asc_recta.value==""){
			alert("Debe introducir Ascención recta desde");
			F.asc_recta.focus();
			return false;
		}
		if (F.asc_recta2.value==""){
			alert("Debe introducir Ascención recta hasta");
			F.asc_recta2.focus();
			return false;
		}
		if (F.declinacion.value==""){
			alert("Debe introducir Declinación desde");
			F.declinacion.focus();
			return false;
		}
		if (F.declinacion2.value==""){
			alert("Debe introducir Declinación hasta");
			F.declinacion2.focus();
			return false;
		}
	}
	if (consul=="ambas"){
		if (F.fecha_desde.value==""){
			alert("Debe seleccionar Fecha Desde");
			return false;
		}
		if (F.fecha_hasta.value==""){
			alert("Debe seleccionar Fecha Hasta");
			return false;
		}
		if (F.asc_recta.value==""){
			alert("Debe introducir Ascención recta desde");
			F.asc_recta.focus();
			return false;
		}
		if (F.asc_recta2.value==""){
			alert("Debe introducir Ascención recta hasta");
			F.asc_recta2.focus();
			return false;
		}
		if (F.declinacion.value==""){
			alert("Debe introducir Declinación desde");
			F.declinacion.focus();
			return false;
		}
		if (F.declinacion2.value==""){
			alert("Debe introducir Declinación hasta");
			F.declinacion2.focus();
			return false;
		}
	}
	F.action="consulta_avanzada1.php";
}
////////////////// FUNCION PARA VALIDAR ACCESO////////////////
function validar_datos1()
{
	function getRadioButtonSelectedValue(ctrl)
	{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
	}
	var consul=getRadioButtonSelectedValue(document.formulario.consulta);
	var F=document.formulario;
	if (consul=="fecha"){
		if (F.fecha_desde.value==""){
			alert("Debe seleccionar Fecha Desde");
			return false;
		}
		if (F.fecha_hasta.value==""){
			alert("Debe seleccionar Fecha Hasta");
			return false;
		}
	}
	if (consul=="asc"){
		if (F.asc_recta.value==""){
			alert("Debe introducir Ascención recta desde");
			F.asc_recta.focus();
			return false;
		}
		if (F.asc_recta2.value==""){
			alert("Debe introducir Ascención recta hasta");
			F.asc_recta2.focus();
			return false;
		}
		if (F.declinacion.value==""){
			alert("Debe introducir Declinación desde");
			F.declinacion.focus();
			return false;
		}
		if (F.declinacion2.value==""){
			alert("Debe introducir Declinación hasta");
			F.declinacion2.focus();
			return false;
		}
	}
	if (consul=="ambas"){
		if (F.fecha_desde.value==""){
			alert("Debe seleccionar Fecha Desde");
			return false;
		}
		if (F.fecha_hasta.value==""){
			alert("Debe seleccionar Fecha Hasta");
			return false;
		}
		if (F.asc_recta.value==""){
			alert("Debe introducir Ascención recta desde");
			F.asc_recta.focus();
			return false;
		}
		if (F.asc_recta2.value==""){
			alert("Debe introducir Ascención recta hasta");
			F.asc_recta2.focus();
			return false;
		}
		if (F.declinacion.value==""){
			alert("Debe introducir Declinación desde");
			F.declinacion.focus();
			return false;
		}
		if (F.declinacion2.value==""){
			alert("Debe introducir Declinación hasta");
			F.declinacion2.focus();
			return false;
		}
	}
	F.action="consulta_avanzada21.php";
}
///////////////// FUNCION PARA VALIDAR ACCESO////////////////
function crear_archivo(num_observacion,fecha,RegistrosAEmpezar,RegistrosAMostrar,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2,radio_consulta)
{
	var F=document.frminstancia;
	var correo=F.correo.value;
	if (correo==""){
		alert("Debe ingresar una direccion de correo para enviar la ruta del archivo de texto de la pagina actual");
		F.correo.focus();
		return false;
	}

	location.href="texto2.php?num_observacion="+num_observacion+"&fecha="+fecha+"&RegistrosAEmpezar="+RegistrosAEmpezar+"&RegistrosAMostrar="+RegistrosAMostrar+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2+"&radio_consulta="+radio_consulta+"&correo="+correo
	return false;
}
//////////////////////////////////////////////////
function crear_archivo_completo(num_observacion,fecha,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2,radio_consulta)
{
	var F=document.frminstancia;
	var correo=F.correo.value;
	if (correo==""){
		alert("Debe ingresar una direccion de correo para enviar la ruta del archivo de texto de la observacion");
		F.correo.focus();
		return false;
	}

	location.href="texto.php?num_observacion="+num_observacion+"&fecha="+fecha+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2+"&radio_consulta="+radio_consulta+"&correo="+correo
	return false;
}
////////////////////////////////////////////////////////
function crear_archivo_avanzado(fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2,radio_consulta)
{
	var F=document.frminstancia;
	var correo=F.correo.value;
	if (correo==""){
		alert("Debe ingresar una direccion de correo para enviar la ruta del archivo de texto de la consulta");
		F.correo.focus();
		return false;
	}

	location.href="texto3.php?fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2+"&radio_consulta="+radio_consulta+"&correo="+correo
	return false;
}
////////////////////////////////////////////////////////////////
function devolver(num_observacion,fecha,RegistrosAEmpezar,RegistrosAMostrar,fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2,radio_consulta,correo)
{

	//fecha=document.formulario.fecha.value;
	alert("Archivo creado, se ha enviado la direccion donde se encuentra el archivo al correo "+correo);
	//var F=document.formulario;
	//var fecha=F.fecha.value;

	//fecha = document.getElementById('fecha');

	location.href="consulta_avanzada1.php?num_observacion="+num_observacion+"&fecha="+fecha+"&RegistrosAEmpezar="+RegistrosAEmpezar+"&RegistrosAMostrar="+RegistrosAMostrar+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2+"&radio_consulta="+radio_consulta
	return false;
}
////////////////////////////////////////////////////////////////
function devolver1(fecha_desde,fecha_hasta,asc_recta,declinacion,asc_recta2,declinacion2,radio_consulta,correo)
{

	//fecha=document.formulario.fecha.value;
	alert("Archivo creado, se ha enviado la direccion donde se encuentra el archivo al correo "+correo);
	//var F=document.formulario;
	//var fecha=F.fecha.value;

	//fecha = document.getElementById('fecha');

	location.href="consulta_avanzada21.php?fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&asc_recta="+asc_recta+"&declinacion="+declinacion+"&asc_recta2="+asc_recta2+"&declinacion2="+declinacion2+"&radio_consulta="+radio_consulta
	return false;
}
//////////////////////////////////////////////////
function prueba(num,fecha)
{

	//fecha=document.formulario.fecha.value;
	alert("ENtra"+fecha);
	return false;
}