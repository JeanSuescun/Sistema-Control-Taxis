<?php
$this->load->view('header');

echo anchor('/datos/vehiculos' , 'REGRESAR A LISTA DE VEHICULOS');
?>
<center>
<br>
<h3>Registro de vehículos</h3>
<br>
<p align="right">

<?php
if($bandera==1){
	echo anchor('/datos/vehiculos_suspendidos/'.$this->uri->segment(3), "Ver suspensiones de veh&iacute;culo")  ?>
	 |
	<?php echo anchor('/datos/vehiculos_historial/'.$this->uri->segment(3), " Ver aver&iacute;as de veh&iacute;culo");
}
?>
</p>
<table border="1">
  <?php


        echo form_open_multipart('/datos/vehiculos_form/'.$this->uri->segment(3) );

        echo "<th>".form_label('N&uacute;mero', 'numero' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'numero',
                  'id'          => 'numero',
                  'value'       => set_value('numero', (isset($rs_consulta->numero)) ? $rs_consulta->numero : ''),
                  'maxlength'   => '10',
                  'size'        => '10',
                  'style'       => ''
                );
        echo "<td width='500'>".form_input($data).'<br />' ;
        echo form_error('numero').'<br /> </td></tr>'  ;


		echo "<th>".form_label('Placa', 'placa' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'placa',
                  'id'          => 'placa',
                  'value'       => set_value('placa', (isset($rs_consulta->placa)) ? $rs_consulta->placa : ''),
                  'maxlength'   => '10',
                  'size'        => '10',
                  'style'       => ''
                );
        echo "<td>". form_input($data).'<br />' ;
        echo form_error('placa').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Modelo', 'modelo' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'modelo',
                  'id'          => 'modelo',
                  'value'       => set_value('modelo', (isset($rs_consulta->modelo)) ? $rs_consulta->modelo : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('modelo').'<br /> </td></tr>'  ;

		echo "<th>".form_label('A&ntilde;o', 'ano' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'ano',
                  'id'          => 'ano',
                  'value'       => set_value('ano', (isset($rs_consulta->ano)) ? $rs_consulta->ano : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('ano').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Marca', 'marca' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'marca',
                  'id'          => 'marca',
                  'value'       => set_value('marca', (isset($rs_consulta->marca)) ? $rs_consulta->marca : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('marca').'<br /> </td></tr>'  ;


		/*echo "<th>".form_label('Propietario', 'propietario' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'propietario',
                  'id'          => 'propietario',
                  'value'       => set_value('propietario', (isset($rs_consulta->ced_propietario)) ? $rs_consulta->ced_propietario : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('propietario').'<br /> </td></tr>'  ;

		echo "<th>".form_label('Avance', 'avance' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'avance',
                  'id'          => 'avance',
                  'value'       => set_value('avance', (isset($rs_consulta->ced_avance)) ? $rs_consulta->ced_avance : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('avance').'<br /> </td></tr>'  ;*/

		$options["Activo"] = "Activo";
		$options["Accidentado"] = "Accidentado";
		$options["De viaje"] = "De viaje";
		$options["Suspendido"] = "Suspendido";

		echo "<th height='40'>".form_label('Estado', 'estado' ).'&nbsp;&nbsp;</th>';
        echo "<td>".form_dropdown('estado', $options, set_value('estado', (isset($rs_consulta->estado)) ? $rs_consulta->estado : ''));
        echo "</br>".form_error('estado').".<br /></td></tr>";

		echo "<th>".form_label('Comentario', 'otro' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'otro',
                  'id'          => 'otro',
                  'value'       => set_value('otro', (isset($rs_consulta->otro)) ? $rs_consulta->otro : ''),
                  'maxlength'   => '200',
                  'size'        => '80',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('otro').'<br /> </td></tr>'  ;



		?>
</table>
<input type="submit" value="Guardar" style="width:150px; height:35px">
<p>
</p>
</form>
<?php
$this->load->view('footer');
?>
