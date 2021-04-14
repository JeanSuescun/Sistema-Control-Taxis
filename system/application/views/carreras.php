<?php
$this->load->view('header');
?>
<?php //echo anchor('/datos/personas_form/','AGREGAR PERSONA');?>
<center>
<h3>Consulta de Carreras</H3>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="50" height="20" align="center">N&uacute;mero de carrera</th>
    <th width="30" align="center">Veh&iacute;culo</th>
    <th width="60" align="center">Origen</th>
    <th width="40">Destino</th>
    <th width="40">Conductor</th>
    <th width="40">Fecha / hora</th>
  </tr>
<?php foreach ($rs_consulta as $row_rs_examples) :
$fecha=explode('-',$row_rs_examples->fecha_hora);
$fecha2=explode (' ',$fecha[2]);
$fecha_hora=$fecha2[0]."-".$fecha[1]."-".$fecha[0]." ".$fecha2[1];
?>
  <tr>
    <td align="center" height="20"><?php echo $row_rs_examples->codigo_carrera ; ?></td>
    <td align="left"><?php echo $row_rs_examples->numero_vehiculo ; ?></td>
    <td align="left"><?php echo $row_rs_examples->codigo_origen ; ?></td>
    <td align="left"><?php echo $row_rs_examples->codigo_destino ; ?></td>
    <td align="left"><?php echo $row_rs_examples->nombre ; ?></td>
    <td align="left"><?php echo $fecha_hora; ?></td>
  </tr>
<?php endforeach ; ?>
</table>
<?php //echo $this->pagination->create_links(); ?>
<?php echo "N&uacute;mero de carreras: ",$total_rows?>

<?php
$this->load->view('footer');
?>