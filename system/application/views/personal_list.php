<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/form_mantenimiento/' , 'Agregar nuevo personal'); ?></p>
<center>
<br>
<br>
<h4>Consulta de personal</h4>
<br>
<table width="600" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">C&eacute;dula</th>
    <th align="center">Nombre</th>
    <th width="60" align="center">Departamento</th>
	<th width="40" align="center">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->cedula ; ?></td>
    <td height="20"><?php echo utf8_decode($row_rs_examples->nombre_persona) ; ?></td>
    <td align="left"><?php echo $row_rs_examples->departamento ; ?></td>
     <td align="center"><?php echo anchor('/datos/modificar_personal/'.$row_rs_examples->cedula, 'Modificar' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
