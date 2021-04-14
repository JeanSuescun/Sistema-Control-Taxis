<?php
$this->load->view('header');
?>
<center>
<form action="registro_fallas" name="datos" id="datos" method="post">
<h4>Registro de Nuevas Fallas</h4>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
  	<th width="150" height="20" align="center">T&iacute;tulo</th><td><?php echo $titulo ?></td><tr>
    <th width="150" height="20" align="center">Descripci&oacute;n de la falla</th><td><?php echo $falla ?></td><tr>
	<th width="150" height="20" align="center">Fecha</th><td><?php echo $fecha ?></td><tr>
	<th width="150" height="20" align="center">Hora</th><td><?php echo $hora ?></td><tr>
	<th width="150" height="20" align="center">Usuario</th><td><?php echo $usuario ?></td><tr>
  </tr>
</table>
<br>
<font color="#0000FF">La nueva falla ha sido registrada con &eacute;xito!!!</font>
<br>
<input type="submit" value="Regresar">
</form>
<?php
$this->load->view('footer');
?>
