<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/vehiculos_form/' , 'AGREGAR NUEVO CARRO?></p>
<center>
<h4>Consulta de Vehículos</h4>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="100" height="20" align="center">N&uacute;mero</th>
    <th align="center">Placa</th>
    <th width="60" align="center">Modelo</th>
    <th width="40">A&ntilde;o</th>
    <th width="40">Marca</th>
    <th width="40">Propietario</th>
    <th width="40">Avance</th>
    <th width="40">Otro</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="left"><?php echo $row_rs_examples->numero ; ?></td>
    <td height="20"><?php echo $row_rs_examples->placa ; ?></td>
    <td align="left"><?php echo $row_rs_examples->modelo ; ?></td>
    <td align="left"><?php echo $row_rs_examples->ano ; ?></td>
    <td align="left"><?php echo $row_rs_examples->marca ; ?></td>
    <td align="left"><?php echo $row_rs_examples->ced_propietario ; ?>
    <td align="left"><?php echo $row_rs_examples->ced_avance ; ?></td>
    <td align="left"><?php echo $row_rs_examples->otro ; ?></td>


</td>



    <td align="center"><?php echo anchor('/datos/vehiculos_form/'.$row_rs_examples->numero, 'MODIFICAR' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>