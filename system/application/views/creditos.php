<?php
$this->load->view('header');
?>

	<table class="contentpaneopen">
	  <tbody>
	    <tr>
		<td class="contentheading" width="100%">
		<br>
		<b><?=$heading?></b>

		</td>
	    </tr>
	  </tbody>
	</table>

	<table class="contentpaneopen">

	<tbody><tr>
	  <td valign="top">
		<br>
	      <p>

	      Este sistema es desarrollado por la coordinaci&oacute;n de sistemas de CompuSoftware M&eacute;rida C.A., una soluci&oacute;n integral en sistemas de computaci&oacute;n.

          </p>
          <p>
		<ul>
            	<li>Jean C. Suesc&uacute;n H. (jean.suescun@gmail.com).  Gerente de Sistemas</li>
            	<li>Jovanny R. Suesc&uacute;n H. (jovanny@gmail.com). Gerente General</li>
			<li>Ricardo A. Suesc&uacute;n H. (ricardo@gmail.com).  Gerente de Ventas</li>
           </ul>
          </p>
	      <p>
	      Programado con php, mysql y el framework de php CodeIgniter
	      </p>
		  <p align="center">
		  	<img width="220" src="<?php echo base_url()?>images/logo.jpg">
		  </p>
	    </td>
	    </tr>
	  </tbody>
	</table>



<?php
$this->load->view('footer');
?>
