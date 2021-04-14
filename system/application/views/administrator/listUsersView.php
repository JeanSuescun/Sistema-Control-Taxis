<?php
$this->load->view('header');
?>
<h1><?php echo $heading?></h1>
<h2>Consulta de usuarios</h2>
<center>
<table>
<TR>
<th align='center'>Id</th><th>Rol</th><th>Nombre usuario</th><th>Nombres</th><th>Apellidos</th><th>Correo</th>
</TR>

        <?php


        foreach( $users->result_array() as $user ){
        	echo '<tr>';
           		echo '<td>'. $user['id']. '</td>';
        		echo '<td>'. $user['name']. '</td>';
        		echo '<td>'. $user['username']. '</td>';
				echo '<td>'. $user['nombres']. '</td>';
				echo '<td>'. $user['apellidos']. '</td>';
        		echo '<td>'. $user['email']. '</td>';
        		echo '<td>'. anchor('/administrator/formUser/'.$user['id'] , 'Editar') . '</td>';
        	echo '</tr>';

       }

       ?>

<tr><td colspan=8 align=center><font color="#FFFFFF"><?php echo $this->pagination->create_links(); ?></td></tr>
<tr><td colspan=8 align=center><font color="#FFFFFF">Total de Registros:<?php echo $total_rows?></td></tr>

</table>

</p>

<p><br />Pagina generada en {elapsed_time} segundos</p>
<?php echo form_close();?>
<?php
$this->load->view('footer');
?>