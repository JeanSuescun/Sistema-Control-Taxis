<?php
$this->load->view('header');
?>
<center>
<form action="<?php echo base_url()?>index.php/datos/consultar" name="datos" id="datos" method="post">
<h4>Reporte de Eventos Ocurridos</h4>

<br>
<font color="#0000FF">Se ha reportado el evento ocurrido con &eacute;xito!!!</font>
<br>
<input type="submit" value="Regresar">
</form>
<?php
$this->load->view('footer');
?>
