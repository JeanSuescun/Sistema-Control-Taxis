<?php
$this->load->view('header');
?>
<html>
	<body>
	<?php  				
		// Show error
		echo validation_errors();
		
		$this->table->set_heading('', 'Nombre de Usuario', 'Correo electr&oacute;nico', 'Registro IP', 'C&oacute;digo de activaci&oacute;n', 'Fecha creado');
		
		foreach ($users as $user) 
		{
			$this->table->add_row(
				form_checkbox('checkbox_'.$user->id, $user->username).form_hidden('key_'.$user->id, $user->activation_key),
				$user->username, 
				$user->email, 
				$user->last_ip, 				
				$user->activation_key, 
				date('Y-m-d', strtotime($user->created)));
		}
		
		echo form_open($this->uri->uri_string());
				
		echo form_submit('activate', 'Activar usuario');
		
		echo '<hr/>';
		
		echo $this->table->generate(); 
		
		echo form_close();
		
		echo $pagination;
			
	?>
	</body>
</html>
<?php
$this->load->view('footer');
?>