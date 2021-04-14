<?php
$this->load->view('header');
?>
<center>
<br>
<br>
<h4>Consulta de nuevas fallas registradas</h4>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">Identificador de falla</th>
	<th align="center">T&iacute;tulo</th>
    <th align="center">Descripci&oacute;n de la falla</th>
	<th align="center">Fecha</th>
	<th align="center">Hora</th>
	<th align="center">Usuario</th>
	<th width="40" align="center">Estatus</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->id_falla ; ?></td>
    <td height="20"><?php echo $row_rs_examples->titulo ; ?></td>
	<td height="20"><?php echo $row_rs_examples->descripcion_falla ; ?></td>
	<td height="20"><?php echo $row_rs_examples->fecha ; ?></td>
	<td height="20"><?php echo $row_rs_examples->hora ; ?></td>
	<td height="20"><?php echo $row_rs_examples->usuario ; ?></td>
	<?php
	if($row_rs_examples->estatus=="Solucionado"){
    ?>
		<td align="center"><?php echo $row_rs_examples->estatus;  ?></td>
	<?php
	}else{
	?>
		<td align="center"><?php echo anchor('/datos/cambiar_falla/'.$row_rs_examples->id_falla,$row_rs_examples->estatus );  ?></td>
	<?php
	}
	?>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
