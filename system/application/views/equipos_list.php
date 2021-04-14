<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/form_equipos/' , 'Agregar nuevo equipo'); ?></p>
<center>
<br>
<br>
<h4>Consulta de equipos</h4>
<br>
<table width="600" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">C&oacute;digo</th>
    <th align="center">Nombre</th>
    <th width="60" align="center">Marca</th>
	<th width="60" align="center">Modelo</th>
	<th width="60" align="center">Informaci&oacute;n adicional</th>
	<th width="40" align="center">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->id_equipo ; ?></td>
    <td height="20"><?php echo utf8_decode($row_rs_examples->nombre_equipo) ; ?></td>
    <td align="left"><?php echo $row_rs_examples->marca ; ?></td>
	<td align="left"><?php echo $row_rs_examples->modelo ; ?></td>
	<td align="left"><?php echo $row_rs_examples->informacion_extra ; ?></td>
     <td align="center"><?php echo anchor('/datos/modificar_equipo/'.$row_rs_examples->id_equipo, 'Modificar' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
