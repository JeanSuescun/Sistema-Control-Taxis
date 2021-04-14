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

<a href="<?php echo base_url()?>index.php/datos/control"><b><font color='#FFF'> < REGRESAR A CONTROL</font></b></a>
<table height="677" border="0" background="<?php echo base_url()?>images/mapa_puntos.jpg" style="width:998px;">
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

$punto1=87;
$punto2=51;
$punto3=43;
$punto4=54;
$punto5=22;

	for($i=1;$i<=96;$i++){

		if($punto1==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 1<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==1){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#fff'><span background="#0C0" style="background-color:green;"><?php echo $disponible[$j]?></font></b></a>
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
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#fff'><span background="#0C0" style="background-color:green;"><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if($punto3==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 3<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==3){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#fff'><span background="#0C0" style="background-color:green;"><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if($punto4==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 4<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==4){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#fff'><span background="#0C0" style="background-color:green;"><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if($punto5==$i){
			echo "<td width='80' height='80' align='center'><font color='#000'><b>Punto 5<br></b></font>";
			for($j=1;$j<=$n;$j++){
				if($punto[$j]==5){
					?>
					<a href="<?php echo base_url()?>index.php/datos/control_form/<?php echo $disponible[$j]?>"><b><font color='#fff'><span background="#0C0" style="background-color:green;"><?php echo $disponible[$j]?></font></b></a>
					<?php
				}
			}

			echo "</td>";
		}
		if(($punto1!=$i)and($punto2!=$i)and($punto3!=$i)and($punto4!=$i)and($punto5!=$i)){
			echo "<td width='80' height='80' align='center'>";
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
<!--<img src="<?php echo base_url()?>images/mapa1.jpg" style="width:1000px;">-->

<?php
//$this->load->view('footer');
?>