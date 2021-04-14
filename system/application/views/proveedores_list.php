<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/form_proveedores/' , 'Agregar nuevo proveedor'); ?></p>
<center>
<br>
<br>
<h4>Consulta de proveedores</h4>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">Rif</th>
    <th align="center">Nombre</th>
    <th width="60" align="center">Tel&eacute;fono</th>
	<th width="40" align="center">Area comercial</th>
	<th width="40" align="center">Direcci&oacute;n</th>
	<th width="40" align="center">Correo Electr&oacute;nico</th>
	<th width="40">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->rif_proveedor ; ?></td>
    <td height="20"><?php echo utf8_decode($row_rs_examples->nombre_proveedor) ; ?></td>
    <td align="left"><?php echo $row_rs_examples->telefono ; ?></td>
	<td align="left"><?php echo $row_rs_examples->area_comercial ; ?></td>
	<td align="left"><?php echo $row_rs_examples->direccion ; ?></td>
	<td align="left"><?php echo $row_rs_examples->correo_electronico ; ?></td>
     <td align="center"><?php echo anchor('/datos/modificar_proveedor/'.$row_rs_examples->rif_proveedor, 'Modificar' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
