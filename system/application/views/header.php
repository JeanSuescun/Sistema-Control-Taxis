<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Línea de Taxis</title>
<!--<link rel="stylesheet" href="styles.css" type="text/css" />-->

<!--<link rel="stylesheet" type="text/css" href="styles.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/styles.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/ajax.js"></script>
</head>
<body>



<div class="logo">
<!--<table border="0">
<tr>
<td colspan="2" >
<img src="<?php echo base_url()?>images/linea1.png" height="5px" WIDTH="100%">
</td>
</tr></table>-->
</div>
<div class="header">

		<div class="innertitle">

			<!-- TITLE -->
			<table border="0">
				<tr>
					<td align="left"><img width="100" src="<?php echo base_url()?>images/images_taxi.jpg"></td>
					<td align="center"><h1>SICOLTAXIS </h1><h2>Sistema de Control de Línea de Taxis</h2></td>
					<td align="right"><img width="100" src="<?php echo base_url()?>images/images_taxi.jpg"></td>
				</tr>
			</table>
			<!-- END TITLE -->

		</div>



<div class="outernav">
		<div class="nav">
			<div class="innernav">
				<ul>
				<center><li><a href="<?php echo base_url()?>index.php">Inicio<br><img width="35" src="<?php echo base_url()?>images/inicio.png"></a></li>
				<?php

					if($logueado){
				?>


				<!-- MENU -->
					<li><a href="<?php echo base_url()?>index.php/datos/control">Control<br><img width="35" src="<?php echo base_url()?>images/control.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/vehiculos">Veh&iacute;culos<br><img width="35" src="<?php echo base_url()?>images/carro.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/personas">Personas<br><img width="35" src="<?php echo base_url()?>images/personas2.png"></a></li>
					<!--<li><a href="<?php echo base_url()?>index.php/tecnologos/consultas">Avances</a></li>-->
					<!--<li><a href="<?php echo base_url()?>index.php/tecnologos/planillas">Controladores</a></li>-->
					<li><a href="<?php echo base_url()?>index.php/datos/carreras">Carreras<br><img width="35" src="<?php echo base_url()?>images/carreras.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/consultas">Consultas<br><img width="35" src="<?php echo base_url()?>images/buscar.png"></td></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/mapa">Mapa M&eacute;rida<br><img width="45" src="<?php echo base_url()?>images/Mapa.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/accidentados">Accidentados<br><img width="35" src="<?php echo base_url()?>images/carro_accidentado.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/suspendidos">Suspendidos<br><img width="35" src="<?php echo base_url()?>images/stop.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/viaje">De viaje<br><img width="35" src="<?php echo base_url()?>images/viaje.png"></a></li>
					<li><a href="<?php echo base_url()?>index.php/datos/creditos">Cr&eacute;ditos<br><img width="60" src="<?php echo base_url()?>images/logo.jpg"></a></li>


					<!-- END MENU -->
				</ul>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<div class="clear"></div>
	</div>
<div id="wrap">
	<div class="pagewrapper">
		<div class="innerpagewrapper">

			<div class="page">


<div class="sidebar">

					<!-- SIDEBAR -->

			<h5>Acceso al Sistema
				<?php

				if($logueado){
				echo "Centralista: ",$username,"";
				//echo "<br>Rol: ",$role_name;

		?><br><a href="<?php echo base_url()?>index.php/auth/logout">Cerrar sesi&oacute;n</a><?php
				echo "<br><br><br><br>Fecha:".$fecha."<br>Hora: ".$hora."</h5>";

				if(isset($tiempo30)){
					$rs_consulta = $this->system_model->get_control();
					$rs_consulta1 = $this->system_model->get_control1();
					echo "<br><br><br>";
					$fecha_actual= date("Y-m-d");
					$hora_actual= date("H:i:s");
					$fecha_actual1=date("Y-m-d H:m:s");
					echo "<br>";
					foreach ($rs_consulta1 as $row_rs_examples) :
						$total_sistema=explode(" ", $row_rs_examples->orden_hora);
						$fecha_sistema=$total_sistema[0];

						//if(($fecha_actual==$fecha_sistema)and($hora_actual>$total_sistema[1])){
						if($fecha_actual1>$row_rs_examples->orden_hora){
							//echo "<br>",$total_sistema[1];
							$hora_sistema=explode (":", $total_sistema[1]);
							$hora_actual1=explode (":", $hora_actual);
							$hora=$hora_actual1[0]-$hora_sistema[0].":";
							$min=$hora_actual1[1]-$hora_sistema[1].":";
							$seg=$hora_actual1[2]-$hora_sistema[2];
							//echo "entra: ",$hora.$min.$seg;
						}
						//echo "<br>",$menos=$actual-$row_rs_examples->orden_hora;
						/*if($row_rs_examples->orden _hora == $actual){
							echo "carro: ",$row_rs_examples->numero_vehiculo;
						}*/
					endforeach;
					$punto=0;
					$cont=0;
					$punto1=0;
					$punto2=0;
					$punto3=0;
					$punto4=0;
					$punto5=0;
					foreach ($rs_consulta as $row_rs_examples) :

					$cont=$cont+1;
					if(($punto!=$row_rs_examples->codigo_punto)and($row_rs_examples->estado=="Disponible")){
						$puntor=$row_rs_examples->codigo_punto;
						if($puntor==1){
							$punto1=$punto1+1;
						}
						if($puntor==2){
							$punto2=$punto2+1;
						}
						if($puntor==3){
							$punto3=$punto3+1;
						}
						if($puntor==4){
							$punto4=$punto4+1;
						}
						if($puntor==5){
							$punto5=$punto5+1;
						}
					}
					$punto=$punto+1;
					endforeach;
					echo "<b><font color='#063A4B'>Control Vehículos</font></b><br>";
					if($punto1==0){
						echo "<b><font color='red'>Punto 1: </b>".$punto1." carros</font>";
					}else{
						echo "<b>Punto 1: </b>".$punto1." carros";
					}
					echo"<br>";
					if($punto2==0){
						echo "<b><font color='red'>Punto 2: </b>".$punto2." carros</font>";
					}else{
						echo "<b>Punto 2: </b>".$punto2." carros";
					}
					echo"<br>";
					if($punto3==0){
						echo "<b><font color='red'>Punto 3: </b>".$punto3." carros</font>";
					}else{
						echo "<b>Punto 3: </b>".$punto3." carros";
					}
					echo"<br>";
					if($punto4==0){
						echo "<b><font color='red'>Punto 4: </b>".$punto4." carros</font>";
					}else{
						echo "<b>Punto 4: </b>".$punto4." carros";
					}
					echo"<br>";
					if($punto5==0){
						echo "<b><font color='red'>Punto 5: </b>".$punto5." carros</font>";
					}else{
						echo "<b>Punto 5: </b>".$punto5." carros";
					}
				}

					}else{
		?><a href="<?php echo base_url()?>index.php/auth/login">Iniciar sesi&oacute;n</a><?php
					}

				?>

					<form action="#" method="get" class="searchform">
						<p>

</p>
					</form>
					<!-- SIDEBAR -->

				</div>
<div class="content">

