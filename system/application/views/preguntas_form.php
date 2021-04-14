<?php
$this->load->view('header');
?>
<center>
<h4>Registro de Nuevas Preguntas a la Base de Datos</h4>
<table border="1">
  <?php 
		echo anchor('/datos/preguntas_list' , 'REGRESAR A LISTA DE PREGUNTAS');

        echo form_open_multipart('/datos/preguntas_form/'.$this->uri->segment(3) );

        echo "<th>".form_label('Identificador de pregunta', 'id_pregunta' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'id_pregunta',
                  'id'          => 'id_pregunta',
                  'value'       => set_value('id_pregunta', (isset($rs_consulta->id_pregunta)) ? $rs_consulta->id_pregunta : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td width='400'>".form_input($data).'<br />' ;
        echo form_error('id_pregunta').'<br /> </td></tr>'  ; 
		
		
		echo "<th>".form_label('Pregunta', 'pregunta' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'pregunta',
                  'id'          => 'pregunta',
                  'value'       => set_value('pregunta', (isset($rs_consulta->pregunta)) ? $rs_consulta->pregunta : ''),
                  'maxlength'   => '200',
                  'size'        => '100',
                  'style'       => ''
                );
        echo "<td>". form_input($data).'<br />' ;
        echo form_error('pregunta').'<br /> </td></tr>'  ;
		
		echo "<th>".form_label('Identificador de padre', 'id_padre' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'id_padre',
                  'id'          => 'id_padre',
                  'value'       => set_value('id_padre', (isset($rs_consulta->id_padre)) ? $rs_consulta->id_padre : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('id_padre').'<br /> </td></tr>'  ; 
		
		
		
		
		?>
</table>
<br>
<input type="submit" value="Guardar">
</form>
<?php
$this->load->view('footer');
?>
