<?php
$this->load->view('header');

echo anchor('/datos/control' , 'REGRESAR A CONTROL');
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//echo anchor('/datos/ubicacion' , 'VER UBICACI&Oacute;N');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php

//echo form_open('datos/control_form',array('id' => 'datos','name'=>'datos'));
?>
<SCRIPT type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$("#numero_vehiculo").bind("change",function() {

	  	$("#conductor").load("<?php echo base_url()?>index.php/datos/ajax_conductor/"+$("#numero_vehiculo").val(),function() {
	  		/*$("#coductor").empty();
	  		$("#conductor").html('<option  value="0">-- SELECCIONE --</option>');*/
	  		//alert ("ENTRAaa");
	  		//alert("numero_vehiculo"+$("#numero_vehiculo").val());
     	});
});
});

</script>
<center>
<h3>Registro de control</h3>
<table width="300" border="1">
  <?php


        echo form_open_multipart('/datos/control_form/'.$this->uri->segment(3) );

        echo "<th height='40'>".form_label('N&uacute;mero', 'numero_vehiculo1' ).'&nbsp;&nbsp;</th>';
        /*$data = array(
                  'name'        => 'numero_vehiculo',
                  'id'          => 'numero_vehiculo',
                  'value'       => set_value('numero_vehiculo', (isset($rs_consulta->numero_vehiculo)) ? $rs_consulta->numero_vehiculo : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td width='400'><font color='#c00'>".form_input($data).'<br />' ;*/
        if($numero_vehiculo!=""){
        	echo "<td><input name='numero_vehiculo' value='$numero_vehiculo' readonly></td>";
        }else{
        	$id='id="numero_vehiculo"';
        	//set_value('numero_vehiculo',(isset($rs_consulta->numero_vehiculo)) ? $rs_consulta->numero_vehiculo : '')
        	$otro="";
        	echo "<td>".form_dropdown('numero_vehiculo',$menu_vehiculos, $otro,$id);
        }
        echo "<font color='#c00'>".form_error('numero_vehiculo').'<br /> </font></td></tr>'  ;

		echo "<th height='40'>".form_label('Conductor', 'conductor' ).'&nbsp;&nbsp;</th>';
		if(isset($rs_consulta->conductor)){
			$datos=$this->system_model->get_conductores2_select($rs_consulta->conductor);
			?><td><input size="7" readonly name="conductor" id="conductor" value="<?php echo $datos->cedula;?>"> <?php echo $datos->nombre;?></input></td><tr><?php
		}else{
		?>
		<td><select name="conductor" id="conductor">
     		</select></td><tr>
		<?php
		}
		echo form_error('conductor').'<br /> '  ;

		$options["Disponible"] = "Disponible";
		$options["Ocupado"] = "Ocupado";
		$options["Desocupado"] = "Desocupado";
		$options["Fuera Servicio"] = "Fuera Servicio";

		$options_origen["1"] = "Punto 1";
		$options_origen["2"] = "Punto 2";
		$options_origen["3"] = "Punto 3";
		$options_origen["4"] = "Punto 4";
		$options_origen["5"] = "Punto 5";
		$options_origen["Sector 1"] = "Sector 1";
		$options_origen["Sector 2"] = "Sector 2";
		$options_origen["Sector 3"] = "Sector 3";
		$options_origen["Sector 4"] = "Sector 4";
		$options_origen["Sector 5"] = "Sector 5";
		$options_origen["Sector 6"] = "Sector 6";
		$options_origen["Sector 7"] = "Sector 7";
		$options_origen["Sector 8"] = "Sector 8";
		$options_origen["Sector 9"] = "Sector 9";
		$options_origen["Sector 10"] = "Sector 10";
		$options_origen["Sector 11"] = "Sector 11";
		$options_origen["Sector 12"] = "Sector 12";
		$options_origen["Sector 13"] = "Sector 13";
		$options_origen["Sector 14"] = "Sector 14";
		$options_origen["Sector 15"] = "Sector 15";

		echo "<th>".form_label('Origen', 'codigo_origen' ).'&nbsp;&nbsp;</th>';

        echo "<td ><font color='#c00'>".form_dropdown('codigo_origen', $options_origen, set_value('codigo_origen', (isset($rs_consulta->codigo_origen)) ? $rs_consulta->codigo_punto : '')).'<br />' ;
        echo form_error('codigo_origen').'<br /> </font></td></tr>'  ;

		/* echo "<th>".form_label('Origen', 'codigo_origen' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'codigo_origen',
                  'id'          => 'codigo_origen',
                  'value'       => set_value('codigo_origen', (isset($rs_consulta->codigo_origen)) ? $rs_consulta->codigo_origen : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td><font color='#c00'>". form_input($data).'<br />' ;
        echo form_error('codigo_origen').'<br /> </font></td></tr>'  ; */

		$options_destino["Sector 1"] = "Sector 1";
		$options_destino["Sector 2"] = "Sector 2";
		$options_destino["Sector 3"] = "Sector 3";
		$options_destino["Sector 4"] = "Sector 4";
		$options_destino["Sector 5"] = "Sector 5";
		$options_destino["Sector 6"] = "Sector 6";
		$options_destino["Sector 7"] = "Sector 7";
		$options_destino["Sector 8"] = "Sector 8";
		$options_destino["Sector 9"] = "Sector 9";
		$options_destino["Sector 10"] = "Sector 10";
		$options_destino["Sector 11"] = "Sector 11";
		$options_destino["Sector 12"] = "Sector 12";
		$options_destino["Sector 13"] = "Sector 13";
		$options_destino["Sector 14"] = "Sector 14";
		$options_destino["Sector 15"] = "Sector 15";

		echo "<th>".form_label('Destino', 'codigo_destino' ).'&nbsp;&nbsp;</th>';
		echo "<td ><font color='#c00'>".form_dropdown('codigo_destino', $options_destino, set_value('codigo_destino', (isset($rs_consulta->codigo_destino)) ? $rs_consulta->codigo_destino : '')).'<br />' ;
        echo form_error('codigo_destino').'<br /> </font></td></tr>'  ;

		/* echo "<th>".form_label('Destino', 'codigo_destino' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'codigo_destino',
                  'id'          => 'codigo_destino',
                  'value'       => set_value('codigo_destino', (isset($rs_consulta->codigo_destino)) ? $rs_consulta->codigo_destino : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td><font color='#c00'>".form_input($data).'<br />' ;
        echo form_error('codigo_destino').'<br /> </font></td></tr>'  ; */

		echo "<th>".form_label('Estado', 'estado' ).'&nbsp;&nbsp;</th>';

        echo "<td ><font color='#c00'>".form_dropdown('estado', $options, set_value('estado', (isset($estado)) ? $estado : '')).'<br />' ;
        echo form_error('estado').'<br /> </font></td></tr>'  ;


        $options_punto["1"] = "Punto 1";
		$options_punto["2"] = "Punto 2";
		$options_punto["3"] = "Punto 3";
		$options_punto["4"] = "Punto 4";
		$options_punto["5"] = "Punto 5";

		echo "<th>".form_label('Punto', 'codigo_punto' ).'&nbsp;&nbsp;</th>';
		echo "<td ><font color='#c00'>".form_dropdown('codigo_punto', $options_punto, set_value('codigo_punto', (isset($rs_consulta->codigo_punto)) ? $rs_consulta->codigo_punto : '')).'<br />' ;
        echo form_error('codigo_punto').'<br /> </font></td></tr>'  ;

		/* echo "<th>".form_label('Punto', 'codigo_punto' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'codigo_punto',
                  'id'          => 'codigo_punto',
                  'value'       => set_value('codigo_punto', (isset($rs_consulta->codigo_punto)) ? $rs_consulta->codigo_punto : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td><font color='#c00'>".form_input($data).'<br />' ;
        echo form_error('codigo_punto').'<br /> </font></td></tr>'  ; */
		?>
</table>
<input type="submit" value="Aplicar"  style="width:150px; height:35px">
</form>
<?php
$this->load->view('footer');
?>
