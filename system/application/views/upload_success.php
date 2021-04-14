<?php
$this->load->view('header');
?>
<center><table>
<tr>
	<center>
	<br>
	<h3>Registro de fotograf&iacutea</h3>
	<br>
	<?php
		if(isset($error)){
		echo "<h5>Error al registrar fotograf&iacute;a de $nombre, verifique que el tama&ntilde;o sea menor a 500Kb <br> y las dimensiones sean igual o menores a 1024x768 pixeles</h5>";
		echo "<ul></ul><br>";
		echo anchor('/datos/upload/'.$cedula."/".$nombre , 'REGRESAR');
	}else{
	?>
	<h5>Foto de <?php echo $nombre;?> registrada con &eacute;xito</h5>

	<ul>
	<br>
	<?php echo anchor('/datos/personas_form/'.$cedula , 'REGRESAR'); ?>
	<?php
	$cont=0;
	$cedula=$_POST['cedula'];
	$nombre=$_POST['nombre'];
	foreach($upload_data as $item => $value):?>
	<!--<li><?php echo $item;?>: <?php echo $value;?></li>-->
	<?php

	if ($cont==0){
		$archivo=$value;

		$sql="update personas set foto='$archivo' where cedula='$cedula'";
		$query = $this->db->query($sql);

	}
	$cont=$cont+1;
	endforeach; ?>
	</ul>
	<?php
	}
	?>
	<p><?php //echo anchor('upload', 'Upload Another File!'); ?></p>

</tr>

</table></center>
<?php
$this->load->view('footer');
?>
