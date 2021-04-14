<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/vehiculos_form/'.$this->uri->segment(3),'VOLVER');?>
<center>
<BR>
<h3>Historial de suspensiones de Veh&iacute;culo Nº <?php echo $this->uri->segment(3) ?> </H3>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="150">Comentario</th>
    <th width="150">Fecha</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
	<td height="20"><?php echo $row_rs_examples->comentario ; ?></td>
    <td align="left"><?php echo $row_rs_examples->fecha_hora ; ?></td>
  </tr>
<?php endforeach ; ?>
</table>
<?php
$this->load->view('footer');
?>