<span class="article_separator">&nbsp;</span>
		</div>
		</div>
		<!-- END: CONTENT -->
		</div>
		<!-- BEGIN: LEFT COLUMN -->
		<div id="ja-col1">
		<div class="ja-innerpad">
			<div class="moduletable">
				<h3>Men&uacute; Principal</h3>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
        <?php
          if($logeado){
          	
        ?>
		<tr>
			<td>
				<a href="http://www.cida.ve/cida_home/index.php?option=com_content&amp;view=frontpage&amp;Itemid=1" class="mainlevel">Web CIDA</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="<?php echo base_url()?>index.php/welcome" class="mainlevel">Principal</a>
			</td>
		</tr>
                <!--
		<tr>
			<td>
				<a href="#" class="mainlevel">Datos recientes</a>
			</td>
		</tr>
                -->
		<tr>
		  <td>
			<a href="#" class="mainlevel" id="active_menu">Datos Generales</a>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/consultar" class="sublevel" title="Consultar las fallas contenidas en la bd">Consultar</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/registro_fallas" class="sublevel" title="Registrar nueva falla ocurridas en el OAN">Registrar nueva falla</a></div>
                <!--<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/materiales_list" class="sublevel">Materiales</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/herramientas_list" class="sublevel">Herramientas</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/equipos_list" class="sublevel">Equipos</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/telescopios_list" class="sublevel">Telescopios</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/actividades_list" class="sublevel">Actividades</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/mantenimientos_list" class="sublevel">Mantenimientos</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/tiposactividad" class="sublevel">Tipos de Actividad</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/direccionviento" class="sublevel">Direcciones del Viento</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/vientos" class="sublevel">Vientos</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/tiposcolaboradores" class="sublevel">Tipos de Colaboradores</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/colaboradores" class="sublevel">Colaboradores</a></div>
		   -->
		  </td>
		</tr>
<!--
		<tr>
		  <td>
			<a href="#" class="mainlevel" id="active_menu">Datos Espec&iacute;ficos</a>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/observaciones" class="sublevel">Datos Observaciones</a></div>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/consulta_noches" class="sublevel">Noches de Observaci&oacute;n</a></div>
			</td>
		</tr>
		-->
		<?php if ($role_name=="Admin"){ ?>
		<tr>
		  <td>
			<a href="#" class="mainlevel" id="active_menu">Administrador</a>
                <div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/preguntas_list" class="sublevel" title="Ver preguntas contenidas en la bd">Preguntas</a></div>
				<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/respuestas_list" class="sublevel" title="Ver respuestas contenidas en la bd">Respuestas</a></div>
				<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/consultar_fallas" class="sublevel" title="Consultar nuevas fallas registradas por los observadores">Consultar nuevas fallas</a></div>
			<a href="#" class="mainlevel" id="active_menu">Control de usuarios</a>
				<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/backend/unactivated_users" class="sublevel" title="Activar los usuarios pre-registrados">Activar usuarios</a></div>
				<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/administrator" class="sublevel" title="Editar los usuarios ya registrados">Editar usuarios</a></div>
			<a href="#" class="mainlevel" id="active_menu">Reportes</a>
				<div style="padding-left: 4px;"><img src="images/indent1.png" alt=""><a href="<?php echo base_url()?>index.php/datos/reporte_fallas" class="sublevel" title="Activar los usuarios pre-registrados">Reporte de fallas</a></div>
			</td>
		</tr>
		
		<?php } ?>
		<tr><td><a href="<?php echo base_url()?>index.php/datos/creditos" class="mainlevel">Cr&eacute;ditos</a></td></tr>
		<?php }else{ echo "Debe iniciar sesi&oacute;n";} ?>
	</tbody>
</table>
</div>

		</div>
		</div><br>
		<!-- END: LEFT COLUMN -->
	</div>
</div>

<!-- BEGIN: FOOTER -->
<div id="ja-footerwrap" class="clearfix">

<div id="ja-footer">

 <div id="ja-usercolorswrap">
  <div id="ja-usercolors" class="clearfix">
		  	<ul style="margin: 0pt; padding-left: 10px;">
  	  <li><a href="#Top" title="Go to top" style="text-decoration: none;"><img src="images/top.gif" title="Goto top" alt="Goto top"></a></li>
  	</ul>
  </div>
  </div><div class="clr"></div>

	<ul id="mainlevel-nav"><li><a href="http://www.cida.ve/cida_home/index.php?option=com_content&amp;view=article&amp;id=50&amp;Itemid=75" class="mainlevel-nav">Inicio</a></li><li><a href="http://www.cida.ve/cida_home/index.php?option=com_content&amp;view=article&amp;id=257&amp;Itemid=43" class="mainlevel-nav">Comunidad</a></li><li><a href="http://www.cida.ve/cida_home/index.php?option=com_contact&amp;Itemid=18" class="mainlevel-nav">Contacto</a></li><li><a href="http://www.cida.ve/cida_home/index.php?option=com_content&amp;view=article&amp;id=261&amp;Itemid=193" class="mainlevel-nav">Integraci&oacute;n Comunitaria</a></li></ul>
	<p>&nbsp;</p>
<p><small>Copyright ©  2009 Web CIDA. <a href="http://www.cida.ve/" title="Visita el CIDA" target="blank">http://www.cida.ve</a></small>

  <!-- <a href="http://www.joomla.org">Joomla!</a> is Free Software released under the GNU General Public License.  -->
</p>

</div>
</div>
<!-- END: FOOTER -->

</div>

</body></html>
