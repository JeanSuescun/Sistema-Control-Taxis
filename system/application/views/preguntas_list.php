<?php
$this->load->view('header');
?>
<br>
<?php echo anchor('/datos/preguntas_form/' , 'AGREGAR NUEVA PREGUNTA'); ?></p>
<center>
<h4>Consulta de preguntas</h4>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="100" height="20" align="center">Idetificador de Pregunta</th>
    <th align="center">Pregunta</th>
    <th width="60" align="center">Identificador de padre</th>
	<th width="40">Acci&oacute;n</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="left"><?php echo $row_rs_examples->id_pregunta ; ?></td>
    <td height="20"><?php echo $row_rs_examples->pregunta ; ?></td>
    <td align="left"><?php echo $row_rs_examples->id_padre ; ?></td>
    <td align="center"><?php echo anchor('/datos/preguntas_form/'.$row_rs_examples->id_pregunta, 'MODIFICAR' );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
