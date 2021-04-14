<?php
$this->load->view('header');
?>
<h1><?php echo $heading?></h1>
<h2>Edici&oacute;n de usuario</h2>
<center>

<table>
<?php

        echo form_open_multipart('/administrator/formUser/'.$this->uri->segment(3) );

        echo "<tr><th>Nombre usuario: </th><td>".$rs_user->username."</td></tr>";
        echo "<tr><th>Nombre: </th><td><input type='text' name='nombres' id='nombres' value='".$rs_user->nombres."'></td></tr>";
        echo "<tr><th>Apellido: </th><td><input type='text' name='apellidos' id='apellidos' value='".$rs_user->apellidos."'></td></tr>";

        //echo "<tr><th>".form_label('Investigadores: ', 'investigadores' )."</th>";
        //echo "<td>".form_dropdown('Id_Principal', $drop_menu_investigadores, set_value('investigadores', (isset($rs_user->Id_Principal)) ? $rs_user->Id_Principal : ''))."</td></tr>";
        //echo form_error('investigadores_dropmenu').'<br />' ;

        echo "<tr><th>".form_label('Rol: ', 'roles' )."</th>";
        echo "<td>".form_dropdown('role_id', $drop_menu_roles, set_value('roles', (isset($rs_user->role_id)) ? $rs_user->role_id : ''))."</td></tr>";
        echo form_error('investigadores_dropmenu').'<br />' ;

		//echo anchor('/administrator/' , 'Regresar');


        echo "<tr><td>".form_submit('submit','Editar')."</td>";
        echo form_close();

        echo form_open_multipart('/administrator/');
		echo "<td>".form_submit('submit','Regresar')."</td></tr></table>";

        echo form_close();

?>




</p>

<p><br />Pagina generada en {elapsed_time} segundos</p>

<?php
$this->load->view('footer');
?>