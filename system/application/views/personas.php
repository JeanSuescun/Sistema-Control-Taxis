<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/personas_form/','AGREGAR PERSONA');?>
<center>
<BR>
<h3>Consulta de Personas</H3>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="100" height="20" align="center">C&eacute;dula</th>
    <th align="center">Nombre</th>
    <!--<th width="60" align="center">Direcci&oacute;n</th>
    <th width="40">Tel&eacute;fono</th>-->
    <th width="40">Celular</th>
    <th width="40">Veh&iacute;culo</th>
    <th width="40">Tipo de persona</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>

    <td align="left"><?php echo anchor('/datos/personas_form/'.$row_rs_examples->cedula ,$row_rs_examples->cedula) ; ?></td>
    <td height="20"><?php echo $row_rs_examples->nombre ; ?></td>
   <!--<td align="left"><?php echo $row_rs_examples->direccion ; ?></td>
    <td align="left"><?php echo $row_rs_examples->telefono ; ?></td>-->
    <td align="left"><?php echo $row_rs_examples->celular ; ?></td>
    <td align="center"><?php echo anchor('/datos/vehiculos_form/'.$row_rs_examples->numero_vehiculo ,$row_rs_examples->numero_vehiculo) ; ?></td>
    <td align="left"><?php echo $row_rs_examples->tipo_persona ; ?></td>
  </tr>
<?php endforeach ; ?>
</table>
<?php
$this->load->view('footer');
?>