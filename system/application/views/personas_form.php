<?php
$this->load->view('header');

echo anchor('/datos/personas' , 'REGRESAR A LISTA DE PERSONAS');
?>
<center>
<br>
<h3>Registro de personas</h3>
<br>
<table border="1">
  <?php


        echo form_open_multipart('/datos/personas_form/'.$this->uri->segment(3));
        if ($bandera==1){
        echo "<th>".form_label('Foto', 'foto' ).'&nbsp;&nbsp;</th>';
		?>
		<td>
			<?php
			if ($rs_consulta->foto){
			?>
				<img src="<?php echo base_url().'uploads/'.$rs_consulta->foto?>" width="100" height="100"><br>
				<?php echo anchor('/datos/upload/'.$rs_consulta->cedula.'/'.$rs_consulta->nombre , 'Cambiar foto'); ?>
			<?php
			}else{
				 echo "No tiene foto cargada.<br>";
				 echo anchor('/datos/upload/'.$rs_consulta->cedula.'/'.$rs_consulta->nombre , 'Cargar foto');
			}
			}
			?>

		</td></tr>
		<?php
        echo "<th>".form_label('C&eacute;dula', 'cedula' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'cedula',
                  'id'          => 'cedula',
                  'value'       => set_value('cedula', (isset($rs_consulta->cedula)) ? $rs_consulta->cedula : ''),
                  'maxlength'   => '10',
                  'size'        => '10',
                  'style'       => ''
                );
        echo "<td width='400'>".form_input($data).'<br />';
        //echo "<img src='fotos/555555.jpg' width='70' height='70'>";
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
			<!--<option>Centralista</option>-->
		</select>
		</td>
		<?php

        echo form_error('tipo_persona').'<br /> </td></tr>'  ;

		?>
</table>
<input type="submit" value="Guardar" style="width:150px; height:35px">
<p>
</p>
</form>
<?php
$this->load->view('footer');
?>
