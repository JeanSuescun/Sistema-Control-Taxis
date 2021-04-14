<?php
$this->load->view('header');
?>
<center>
<h4>Registro de Nuevas Respuestas a la Base de Datos</h4>
<table border="1">
  <?php 
		echo anchor('/datos/respuestas_list' , 'REGRESAR A LISTA DE RESPUESTAS');

        echo form_open_multipart('/datos/respuestas_form/'.$this->uri->segment(3) );

        echo "<th>".form_label('Identificador de respuesta', 'id_respuesta' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'id_respuesta',
                  'id'          => 'id_respuesta',
                  'value'       => set_value('id_respuesta', (isset($rs_consulta->id_respuesta)) ? $rs_consulta->id_respuesta : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td width='400'>".form_input($data).'<br />' ;
        echo form_error('id_respuesta').'<br /> </td></tr>'  ; 
		
		
		echo "<th>".form_label('Respuesta', 'respuesta' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'respuesta',
                  'id'          => 'respuesta',
                  'value'       => set_value('respuesta', (isset($rs_consulta->respuesta)) ? $rs_consulta->respuesta : ''),
                  'maxlength'   => '300',
                  'size'        => '100',
                  'style'       => ''
                );
        echo "<td>". form_input($data).'<br />' ;
        echo form_error('pregunta').'<br /> </td></tr>'  ;
		
		echo "<th>".form_label('Identificador de pregunta', 'id_pregunta' ).'&nbsp;&nbsp;</th>';
        $data = array(
                  'name'        => 'id_pregunta',
                  'id'          => 'id_pregunta',
                  'value'       => set_value('id_pregunta', (isset($rs_consulta->id_pregunta)) ? $rs_consulta->id_pregunta : ''),
                  'maxlength'   => '25',
                  'size'        => '25',
                  'style'       => ''
                );
        echo "<td>".form_input($data).'<br />' ;
        echo form_error('id_pregunta').'<br /> </td></tr>'  ; 
		
		
		
		
		?>
</table>
<br>
<input type="submit" value="Guardar">
</form>
<?php
$this->load->view('footer');
?>
