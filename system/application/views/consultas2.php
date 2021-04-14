<?php
$this->load->view('header');
//$fecha_desde=$fecha_desde." 00:00:00";
$fecha=explode('-',$fecha_desde);
$fecha_desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];
$fecha=explode('-',$fecha_hasta);
$fecha_hasta=$fecha[2]."-".$fecha[1]."-".$fecha[0];


?>
<?php echo anchor('/datos/consultas/','REGRESAR');?>
<center>
<h3>Consulta de Carreras del veh&iacute;culo Nº <?php echo $numero_vehiculo?>, <br>desde el <?php echo $fecha_desde ?> hasta el <?php echo $fecha_hasta ?></H3>
<table width="700" border="1" class="AdminTable">
  <tr class="AdminTableHeader">
    <th width="50" height="20" align="center">N&uacute;mero de carrera</th>
    <th width="30" align="center">Veh&iacute;culo</th>
    <th width="60" align="center">Origen</th>
    <th width="40">Destino</th>
    <th width="40">Conductor</th>
    <th width="40">Fecha / hora</th>
  </tr>
<?php
$total=0;
foreach ($rs_consulta as $row_rs_examples) :
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
    <td align="left"><?php echo $fecha_hora ; ?></td>
  </tr>
<?php
$total=$total+1;
endforeach ;
if ($total==0)
	echo "<td align='center' colspan='6'>No hay carreras registradas para este periodo...</td>";
?>
</table>
<?php echo "N&uacute;mero de carreras: ",$total?>
<?php
$this->load->view('footer');
?>