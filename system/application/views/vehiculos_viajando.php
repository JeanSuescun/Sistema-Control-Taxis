<?php
$this->load->view('header');
?>
<br>
<?php //echo anchor('/datos/vehiculos_form/','AGREGAR NUEVO VEHICULO');?>
<center>
<BR>
<h3>Consulta de Vehículos de Viaje</H3>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="15" height="20" align="center">N&uacute;mero</th>
    <th width="60" align="center">Placa</th>
    <th width="40">Marca</th>
    <th width="60" align="center">Modelo</th>
    <th width="40">A&ntilde;o</th>
    <!--<th width="40">Propietario</th>-->
    <th width="40">Estado</th>
    <th width="150">Comentario</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
	<?php  $numero="0".$row_rs_examples->numero  ?>
    <td align="center"><?php if (strlen($row_rs_examples->numero)==1) echo anchor('/datos/vehiculos_form/'.$row_rs_examples->numero, $numero); else echo anchor('/datos/vehiculos_form/'.$row_rs_examples->numero,$row_rs_examples->numero); ?></td>
    <td height="20"><?php echo $row_rs_examples->placa ; ?></td>
    <td align="left"><?php echo $row_rs_examples->marca ; ?></td>
    <td align="left"><?php echo $row_rs_examples->modelo ; ?></td>
    <td align="left"><?php echo $row_rs_examples->ano ; ?></td>
    <td align="left"><?php echo $row_rs_examples->estado ; ?></td>
    <!--<td align="left"><?php echo $row_rs_examples->ced_propietario ; ?>-->
    <!--<td align="left"><?php echo $row_rs_examples->ced_avance ; ?></td>-->
    <td align="left"><?php echo $row_rs_examples->otro ; ?></td>
  </tr>
<?php endforeach ; ?>
</table>
<?php
$this->load->view('footer');
?>