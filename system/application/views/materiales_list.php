<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/form_materiales/' , 'Agregar nuevo material'); ?></p>
<center>
<br>
<br>
<h4>Consulta de materiales</h4>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">C&oacute;digo</th>
    <th align="center">Nombre</th>
    <th width="60" align="center">Especificaciones</th>
	<th width="40" align="center">Proveedor</th>
	<th width="40" align="center">Informaci&oacute;n adicional</th>
	<th width="40">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->id_material ; ?></td>
    <td height="20"><?php echo utf8_decode($row_rs_examples->nombre_material) ; ?></td>
    <td align="left"><?php echo $row_rs_examples->especificaciones ; ?></td>
	<td align="left"><?php echo $row_rs_examples->id_proveedor ; ?></td>
	<td align="left"><?php echo $row_rs_examples->informacion_extra ; ?></td>
	<td align="center"><?php echo anchor('/datos/modificar_material/'.$row_rs_examples->id_material, 'Modificar' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
