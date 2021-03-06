<?php
$this->load->view('header');
?>
<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'value' => set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30
);

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0'
);

$confirmation_code = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8
);

?>

<fieldset><legend>Ingrese Nombre de usuario y contrase&ntilde;a</legend>
<?php echo form_open($this->uri->uri_string())?>

<?php echo $this->dx_auth->get_auth_error(); ?>


<dl>	
	<dt><?php echo form_label('Nombre de Usuario', $username['id']);?></dt>
	<dd>
		<?php echo form_input($username)?>
    <?php echo form_error($username['name']); ?>
	</dd>

  <dt><?php echo form_label('Contrase&ntilde;a', $password['id']);?></dt>
	<dd>
		<?php echo form_password($password)?>
    <?php echo form_error($password['name']); ?>
	</dd>

<?php if ($show_captcha): ?>

	<dt>Enter the code exactly as it appears. There is no zero.</dt>
	<dd><?php echo $this->dx_auth->get_captcha_image(); ?></dd>

	<dt><?php echo form_label('C&oacute;digo de confirmaci&oacute;n', $confirmation_code['id']);?></dt>
	<dd>
		<?php echo form_input($confirmation_code);?>
		<?php echo form_error($confirmation_code['name']); ?>
	</dd>
	
<?php endif; ?>

	<dt></dt>
	

	<dt></dt>
	<dd><br><?php echo form_submit('login','Entrar');?></dd>
	
	<dd><br>
		<!--<?php echo form_checkbox($remember);?> <?php echo form_label('Recordarme', $remember['id']);?> -->
		<?php echo anchor($this->dx_auth->forgot_password_uri, 'Olvido contrase&ntilde;a');?> 
		|
		<?php
			if ($this->dx_auth->allow_registration) {
				echo anchor($this->dx_auth->register_uri, 'Registrarme');
			};
		?>
	</dd>
</dl>

<?php echo form_close()?>
</fieldset>
<?php
$this->load->view('footer');
?>