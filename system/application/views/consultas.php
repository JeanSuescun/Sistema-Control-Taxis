<?php
$this->load->view('header');

//echo anchor('/datos/personas' , 'REGRESAR A LISTA DE PERSONAS');
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="<?php echo base_url();?>js/calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<SCRIPT type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>

<center>
<br>
<h3>Consulta de carreras</h3>
<br>
<table border="1">
  <?php
        echo form_open_multipart('/datos/consultas2/'.$this->uri->segment(3) );

		echo "<th width='40%' height='40'>".form_label('N&uacute;mero veh&iacute;culo', 'numero_vehiculo1' ).'&nbsp;&nbsp;</th>';
		echo "<td>".form_dropdown('numero_vehiculo',$menu_vehiculos, set_value('numero_vehiculo',(isset($rs_consulta->numero_vehiculo)) ? $rs_consulta->numero_vehiculo : ''))."</td></tr>";

		?>
		<th>Fecha desde</th><td><input type="text" readonly name="fecha_desde"><input type="button" name="fecha_desde1" id="fecha_desde1" value="Seleccione" onclick="displayCalendar(fecha_desde,'yyyy-mm-dd',this)">
		<br>
		<?php echo form_error('fecha_desde').'<br /> '  ;?>
		<tr><th>Fecha hasta</th><td><input type="text" readonly name="fecha_hasta"><input type="button" name="fecha_hasta1" id="fecha_hasta1" value="Seleccione" onclick="displayCalendar(fecha_hasta,'yyyy-mm-dd',this)">
		<br>
		<?php echo form_error('fecha_desde').'<br /> '  ;
		/*

        echo "<th>".form_label('C&eacute;dula', 'cedula' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'cedula',
                  'id'          => 'cedula',
                  'value'       => set_value('cedula', (isset($rs_consulta->cedula)) ? $rs_consulta->cedula : ''),
                  'maxlength'   => '10',
                  'size'        => '10',
                  'style'       => ''
                );
        echo "<td width='400'>".form_input($data).'<br />' ;
        echo form_error('cedula').'<br /> </td></tr>'  ;


		echo "<th>".form_label('Nombre', 'nombre' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'nombre',
                  'id'          => 'nombre',
                  'value'       => set_value('nombre', (isset($rs_consulta->nombre)) ? $rs_consulta->nombre : ''),
                  'maxlength'   => '120',
                  'size'        => '100',
                  'style'       => ''
                );
        echo "<td>". form_input($data).'<br />' ;
        echo form_error('nombre').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Direcci&oacute;n', 'direccion' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'direccion',
                  'id'          => 'direccion',
                  'value'       => set_value('direccion', (isset($rs_consulta->direccion)) ? $rs_consulta->direccion : ''),
                  'maxlength'   => '250',
                  'size'        => '100',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('direccion').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Tel&eacute;fono', 'telefono' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'telefono',
                  'id'          => 'telefono',
                  'value'       => set_value('telefono', (isset($rs_consulta->telefono)) ? $rs_consulta->telefono : ''),
                  'maxlength'   => '12',
                  'size'        => '12',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('telefono').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Celular', 'celular' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'celular',
                  'id'          => 'celular',
                  'value'       => set_value('celular', (isset($rs_consulta->celular)) ? $rs_consulta->celular : ''),
                  'maxlength'   => '12',
                  'size'        => '12',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('celular').'<br /> </td></tr>'  ;

		echo "<th>".form_label('N&uacute;mero veh&iacute;culo', 'numero_vehiculo1' ).'&nbsp;&nbsp;</th>';
		echo "<td>".form_dropdown('numero_vehiculo',$menu_vehiculos, set_value('numero_vehiculo',(isset($rs_consulta->numero_vehiculo)) ? $rs_consulta->numero_vehiculo : ''))."</td></tr>";

		echo "<th>".form_label('Tipo persona', 'tipo_persona' ).'&nbsp;&nbsp;</th>';
		?>
		<td>
		<select name="tipo_persona">
			<?php
			if(isset($rs_consulta->tipo_persona)){
				echo "<option selected>$rs_consulta->tipo_persona</option>";
			}else
				echo "<option>Seleccione</option>";
			?>
			<option>Propietario</option>
			<option>Avance</option>
			<option>Controlador</option>
			<option>Centralista</option>
		</select>
		</td>
		<?php

        echo form_error('tipo_persona').'<br /> </td></tr>'  ;
		*/
		?>
</table>
<input type="submit" value="Buscar" style="width:150px; height:35px">
<p>
</p>
</form>
<?php
$this->load->view('footer');
?>
