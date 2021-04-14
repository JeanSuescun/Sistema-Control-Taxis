<?php
$this->load->view('header');
?>
<center>
<form action="<?php echo base_url()?>index.php/datos/consultar_fallas" name="datos" id="datos" method="post">
<h4>Cambio de estatus de falla</h4>

<br>
<font color="#0000FF">La falla ha sido modificada con &eacute;xito!!!</font>
<br>
<input type="submit" value="Regresar">
</form>
<?php
$this->load->view('footer');
?>
