<?php
$this->load->view('header');
?>
<br>
<!--<?php echo anchor('/datos/form_mantenimiento/' , 'Agregar nuevo personal'); ?></p>-->
<center>
<h4>Consulta de preguntas</h4>
<br>
<table width="600" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">Pregunta</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) : ?>
  <tr>
    <td align="left"><?php echo anchor('/datos/consulta_pregunta/'.$row_rs_examples->id_pregunta, $row_rs_examples->id_pregunta." &nbsp; &nbsp;".$row_rs_examples->pregunta );  ?></td>
  </tr>
<?php endforeach ; ?>


</table>
<?php
$this->load->view('footer');
?>
