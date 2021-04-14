<?php
$this->load->view('header');
$fecha=date("Y-m-d");
?>
<center>
<form action="registro_fallas2" name="datos" id="datos" method="post">
<h4>Registro de Nuevas Fallas</h4>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
 	<th width="150" height="20" align="center">T&iacute;tulo</th><td><input type="text" name="titulo" id="titulo"></td><tr>
    <th width="150" height="20" align="center">Descripci&oacute;n de la falla</th><td><textarea cols="100" name="falla" id="falla"></textarea></td></tr>
	<th width="150" height="20" align="center">Fecha</th><td><input type="text" name="fecha" id="fecha" value="<?php echo $fecha ?>" readonly="true"></td></tr>
	<th width="150" height="20" align="center">Hora</th><td><input type="text" name="hora" id="hora">Formato: hh:mm:ss</td></tr>
	<th width="150" height="20" align="center">Usuario</th><td><input type="text" name="usuario" id="usuario" value="<?php echo $username;?>" readonly="true"></td></tr>
  </tr>
</table>
<br>
<input type="submit" value="Guardar">
</form>
<?php
$this->load->view('footer');
?>
