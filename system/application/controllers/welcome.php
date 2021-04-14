<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
	}

	function index()
	{
		$data['title'] = "Sistema Control Lineas de Taxis";
		$data['heading']="Sistema que permite el control de los vehículos, conductores y servicios realizados de la línea '...'";
		$data['logueado'] = false;

		$this->load->library('DX_Auth');


		// bloque todo y deja a admin y los que tengan acceso
		//$this->dx_auth->check_uri_permissions();
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
		// Check if user is logged in or not
        if ($this->dx_auth->is_logged_in())
        {
            $data['logueado'] = true;
        }
        else
        {
            $data['logueado'] = false;
        }
				$this->load->view('welcome_message',$data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */