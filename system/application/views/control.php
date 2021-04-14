<?php
$this->load->view('header');
?>
<?php echo anchor('/datos/control_form/','AGREGAR VEHICULO');
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo anchor('/datos/ubicacion2' , 'VER UBICACI&Oacute;N TODOS');
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//echo anchor('/datos/ubicacion' , 'VER UBICACI&Oacute;N');
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo anchor('/datos/ubicacion_puntos' , 'VER UBICACI&Oacute;N PUNTOS');
?>

<center>
<br>
<h3>Control de veh&iacute;culos</H3>

<?php

$cont=0;
$contador=0;

$punto=0;
$ban=0;


//$rs_consulta1=$rs_consulta;
foreach ($rs_consulta as $row_rs_examples) :

if(($punto!=$row_rs_examples->codigo_punto)and($row_rs_examples->estado=="Disponible")){
//if($row_rs_examples->estado=="Disponible"){
$punto=$row_rs_examples->codigo_punto;

?>
<table width="" border="1" style="width:700px">
<tr><td colspan='50' style="background:#333333" align='center'><font size='4' color='#FFFFFF'><b>Punto "<?php echo $punto;?>"</b></font></td></tr>
<?php
$cont=0;
$ban=1;
}
if($ban==1){
	//echo "No".$punto;
}
$fondo="#0C0";
if($row_rs_examples->estado=="Disponible"){
$cont=$cont+1;
//echo $cont;
?>
<form action="<?php echo base_url()?>index.php/datos/control_form/<?php echo $row_rs_examples->numero_vehiculo?>">
    <td align="center" width="10" height="30">
    <!--<img src="<?php echo base_url()?>images/taxi.jpg" width="50" height="30">-->
    <input style="border:2px solid #dddddd; padding:1px; color:#000000; background:<?php echo $fondo?>; font-family:Arial, Helvetica, sans-serif; font-size:1.8em;" type="submit" value="<?php if (strlen($row_rs_examples->numero_vehiculo)==1) echo "&larr;0".$row_rs_examples->numero_vehiculo; else echo "&larr;".$row_rs_examples->numero_vehiculo;?>">
    <!--<input style="border:2px solid #dddddd; padding:1px; color:#000000; background:<?php echo base_url()?>images/taxi.jpg; font-family:Arial, Helvetica, sans-serif; font-size:1.8em;" type="submit" value="<?php if (strlen($row_rs_examples->numero_vehiculo)==1) echo "&larr;0".$row_rs_examples->numero_vehiculo; else echo "&larr;".$row_rs_examples->numero_vehiculo;?>">-->
    </td>
</form>
<?php
}

if($cont%8){

}else{
?>
  </tr>
<?php
}
endforeach ; ?>
</table>

<table width="" border="1"  style="width:700px">
<tr><td colspan='50' style="background:#333333" align='center'><font size='4' color='#FFFFFF'><b>Veh&iacute;culos ocupados </b></font></td></tr>

<?php
$cont=0;
foreach ($rs_consulta1 as $row_rs_examples) :
$fondo="#C00";
if($row_rs_examples->estado=="Ocupado"){
$cont=$cont+1;
//echo $cont;
?>
<form action="<?php echo base_url()?>index.php/datos/control_form/<?php echo $row_rs_examples->numero_vehiculo?>">
	<td align="center" width="10" height="30"><input style="border:2px solid #dddddd; padding:1px; color:#000000; background:<?php echo $fondo?>; font-family:Arial, Helvetica, sans-serif; font-size:1.8em;" type="submit" value="<?php if (strlen($row_rs_examples->numero_vehiculo)==1) echo "&larr;0".$row_rs_examples->numero_vehiculo; else echo "&larr;".$row_rs_examples->numero_vehiculo;?>"></td>
</form>
<?php
}
if($cont%8){

}else{
?>
  </tr>
<?php
}
endforeach ;
?>
</table>

<table width="" border="1"  style="width:700px">
<tr><td colspan='50' style="background:#333333" align='center'><font size='4' color='#FFFFFF'><b>Veh&iacute;culos desocupados </b></font></td></tr>

<?php
$cont=0;
foreach ($rs_consulta1 as $row_rs_examples) :
$fondo="#00C";
if($row_rs_examples->estado=="Desocupado"){
$cont=$cont+1;
//echo $cont;
?>
<form action="<?php echo base_url()?>index.php/datos/control_form/<?php echo $row_rs_examples->numero_vehiculo?>">
	<td align="center" width="10" height="30"><input style="border:2px solid #dddddd; padding:1px; color:#000000; background:<?php echo $fondo?>; font-family:Arial, Helvetica, sans-serif; font-size:1.8em;" type="submit" value="<?php if (strlen($row_rs_examples->numero_vehiculo)==1) echo "&larr;0".$row_rs_examples->numero_vehiculo; else echo "&larr;".$row_rs_examples->numero_vehiculo;?>"></td>
</form>
<?php
}
if($cont%8){

}else{
?>
  </tr>
<?php
}
endforeach ;
?>
</table>

<?php
$this->load->view('footer');
?>