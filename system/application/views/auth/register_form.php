<?php
$this->load->view('header');
?>
<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'value' =>  set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'value' => set_value('password')
);

$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'size'	=> 30,
	'value' => set_value('confirm_password')
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value'	=> set_value('email')
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha'
);
?>
<fieldset><legend>Registrar</legend>
<?php echo form_open($this->uri->uri_string())?>

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

	<dt><?php echo form_label('Confirmar contrase&ntilde;a', $confirm_password['id']);?></dt>
	<dd>
		<?php echo form_password($confirm_password);?>
		<?php echo form_error($confirm_password['name']); ?>
	</dd>

	<dt><?php echo form_label('Correo electr&oacute;nico', $email['id']);?></dt>
	<dd>
		<?php echo form_input($email);?>
		<?php echo form_error($email['name']); ?>
	</dd>
		
<?php if ($this->dx_auth->captcha_registration): ?>

	<dt>Enter the code exactly as it appears. There is no zero.</dt>
	<dd><?php echo $this->dx_auth->get_captcha_image(); ?></dd>

	<dt><?php echo form_label('Confirmation Code', $captcha['id']);?></dt>
	<dd>
		<?php echo form_input($captcha);?>
		<?php echo form_error($captcha['name']); ?>
	</dd>
	
<?php endif; ?>
<br>
	<dt></dt>
	<dd><?php echo form_submit('register','Registrar');?></dd>
</dl>

<?php echo form_close()?>
</fieldset>
<?php
$this->load->view('footer');
?>