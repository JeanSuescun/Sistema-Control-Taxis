<?php
$this->load->view('header');
echo anchor('/datos/personas_form/'.$this->uri->segment(3) , 'REGRESAR');
?>
<body>
<?php if(isset($error)) echo $error;?>
<center>
<br>
<h3>Registro de personas</h3>
<br>
<?php
echo "<br>";
 //echo form_open('upload/do_upload1');
echo form_open_multipart('datos/do_upload');
echo "<b>Cargar foto de:</b> ".$this->uri->segment(4);
?>
<br>
<br>
<input type="hidden" name="cedula" size="20" value="<?php echo $this->uri->segment(3)?>">
<input type="hidden" name="nombre" size="20" value="<?php echo $this->uri->segment(4)?>">
<?php
			$data = array(
				  'name'        => 'userfile',
				  'id'          => 'userfile',
				  'value'       => '',
				  'title'	=> 'Clic para seleccionar la Imagen',
				  'maxlength'   => '',
				  'size'        => '30',
				  'style'       => '',
				  'readonly'    => '',
				  'type'	=> 'file'
				);

			echo form_input($data).'<br />' ;
			echo form_error('userfile').'<br /> '  ;
		?>

<br /><br>

<input type="submit" value="Cargar">

</form>

<?php
$this->load->view('footer');
?>