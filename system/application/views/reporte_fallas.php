<?php
$this->load->view('header');
?>
<center>
<br>
<br>
<h4>Reporte de fallas registradas</h4>
<br>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="30" height="20" align="center">Identificador</th>
	<th align="center">Descripci&oacute;n de la falla</th>
    <th align="center">Usuario</th>
	<th align="center">Fecha</th>
	<th align="center">Ocurrencia</th>
  </tr>
<?php 
  $id_pregunta="";
  $cont=1;
  foreach ($rs_consulta as $row_rs_examples) : ?>
  <?php
	if($row_rs_examples->id_pregunta==$id_pregunta){
		
		$cont=$cont+1;?>
	<?php
	}else{
    ?>
  <tr>
    <td align="center"><?php echo $row_rs_examples->id_pregunta ; ?></td>
    <td height="20"><?php echo $row_rs_examples->pregunta ; ?></td>
	<td height="20"><?php echo $row_rs_examples->usuario ; ?></td>
	<td height="20"><?php echo $row_rs_examples->fecha ; ?></td>
	<td align="center"><?php echo $cont  ?></td>
	<?php
	}
	$id_pregunta=$row_rs_examples->id_pregunta;
	//if($cont){
	?>
		
  </tr>
  <?php 
	//}
   endforeach ; ?>


</table>
<br>
<br>
<input type='button' onclick='window.print();' value='Imprimir' />
<?php echo $this->pagination->create_links(); ?>
<?php //echo "N&uacute;mero de registros: ",$total_rows?>
<?php
$this->load->view('footer');
?>
