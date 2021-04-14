<?php
//$this->load->view('header');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Línea de Taxis</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/styles.css" />
<!--<iframe width="800" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-

71.1839,8.5797,-71.1156,8.6255&amp;layer=mapnik" style="border: 1px solid black"></iframe><br /><small>-->
<!--<iframe width="800" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-71.2063,8.5619,-71.1379,8.6077&amp;layer=mapnik" style="border: 1px solid black"></iframe>-->

<a href="<?php echo base_url()?>index.php/datos/control ?>"><b><font color='#FFF'> < REGRESAR A CONTROL</font></b></a>
<table height="670" border="0" background="<?php echo base_url()?>images/map.jpg" style="width:1000px;">
<tr>
<?php
$this->db->order_by("orden_hora","ASC");
$this->db->where('estado', "Disponible");
$query=$this->db->get('control');
$result= $query->result();
$n=0;
$punto[]=0;
foreach($result as $registro){
	$n=$n+1;
	$disponible[$n]=$registro->numero_vehiculo;
	$punto[$n]=$registro->codigo_punto;
}

$this->db->order_by("orden_hora","ASC");
$this->db->where('estado', "Ocupado");
$query=$this->db->get('control');
$result= $query->result();
$z=0;
$destino[]=0;
foreach($result as $registro){
	$z=$z+1;
	$ocupado[$z]=$registro->numero_vehiculo;
	$destino[$z]=$registro->codigo_destino;
}
$this->db->order_by("orden_hora","ASC");
$this->db->where('estado', "Desocupado");
$query=$this->db->get('control');
$result= $query->result();
$h=0;
$destino2[]=0;
foreach($result as $registro){
	$h=$h+1;
	$desocupado[$h]=$registro->numero_vehiculo;
	$destino2[$h]=$registro->codigo_destino;
}

//$num_vehiculo=10;
//$sector=40;
$punto1=20;
$punto2=40;

	for($i=1;$i<=96;$i++){

		if($punto1==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 1<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==1){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#0C0'><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if($punto2==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 2<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==2){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#0C0'><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if(($punto1!=$i)and($punto2!=$i)){
			echo "<td width='80' height='80' align='center'>";
			$ban_ocu="no";
			for($y=1;$y<=$z;$y++){
				if($destino[$y]==$i){
				$ban_ocu="si";
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $ocupado[$y]?>"><b><font color='#C00'><?php echo $ocupado[$y]?></font></b></a>
					<?php
				}
			}
			$ban_des="no";
			for($x=1;$x<=$h;$x++){
				if($destino2[$x]==$i){
					$ban_des="si";
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $desocupado[$x]?>"><b><font color='#00C'><?php echo $desocupado[$x]?></font></b></a>
					<?php
				}
			}
			if(($ban_des=="si")or($ban_ocu=="si")){
				echo "<br><b>Sector ".$i."<br>";
			}
			echo "</td>";
		}

		if ($i%12){

		}else{
			echo "<tr>";
		}
	}
?>
</tr>

</table>

<?php
//$this->load->view('footer');
?>
