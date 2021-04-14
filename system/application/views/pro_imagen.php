<?php
$this->load->view('header');
//echo form_open_multipart('prototipos/agregar_imagen',array('id' => 'datos','name'=>'datos'));
echo form_open_multipart('upload/do_upload');
?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/ajax.js"></script>
<?php 
if(isset($error)){
	echo $error;
}
?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="<?php echo base_url();?>js/calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<SCRIPT type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<center><p><h3>Agregar Imagen</h3></p></center>
<center>




<?php

//foreach ($rs_sinainpo->result() as $rs_sinainpo) :
?>
<table border="1" style="solid #FF0000; width:650px; font-size:8pt;">
	<tr bgcolor="#666666"><th colspan="3"><font color="#ffffff">Datos Prototipos</th></font>
	</tr>
	<tr>
		<th>C&oacute;digo Prototipo</th><th>Imagen Prototipo</th>
	</tr>
	<tr>
		<td>
		<?php 
			$data = array(
				  'name'        => 'cod_prototipo',
				  'id'          => 'cod_prototipo',
				  'value'       => set_value('cod_prototipo', (isset($cod_prototipo)) ? $cod_prototipo : ''),
				  'maxlength'   => '12',
				  'size'        => '12',
				  'style'       => '',
				  'readonly'    => 'readonly'
				);

			echo form_input($data).'<br />' ;
			echo form_error('cod_prototipo').'<br /> '  ;			
		?>
		</td>
		<td>
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
		</td>
		

		
	</tr>
<tr bgcolor="#666666"><th colspan="3"><font color="#ffffff"></th></font>
</table>
<tr bgcolor="#666666"><th colspan="3"><font color="#ffffff"></th></font>
<tr>
<td colspan="3">
<center><input title="Guardar Informaci&oacute;n" src="<?php echo base_url().'images/boton-guardar.png' ?>" type="image" /></center>
</td>
</tr>
<?php
$this->load->view('footer');
?>

