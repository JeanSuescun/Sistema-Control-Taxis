<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/respuestas_form/' , 'AGREGAR NUEVA RESPUESTA'); ?></p>
<center>
<h4>Consulta de respuestas</h4>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="100" height="20" align="center">Idetificador de Respuesta</th>
    <th align="center">Respuesta</th>
    <th width="60" align="center">Identificador de pregunta</th>
	<th width="40">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="left"><?php echo $row_rs_examples->id_respuesta ; ?></td>
    <td height="20"><?php echo $row_rs_examples->respuesta ; ?></td>
    <td align="left"><?php echo $row_rs_examples->id_pregunta ; ?></td>
    <td align="center"><?php echo anchor('/datos/respuestas_form/'.$row_rs_examples->id_respuesta, 'MODIFICAR' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
