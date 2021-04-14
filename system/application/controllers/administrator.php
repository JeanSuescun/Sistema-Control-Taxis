<?php

class Administrator extends Controller {

	function Administrator()
	{
		parent::Controller();
		// para autentificacion DX


		$this->load->helper('form');

		// Load library
		$this->load->library('DX_Auth');

		//load the model and get results
       $this->load->model('administrator_model');
	}

	function index()
	{
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		//$data['id_principal'] = $this->dx_auth->get_user_id_principal();
		// para la auth
		if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }



	   // load pagination class
       $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/administrator';
       $config['total_rows'] = $this->db->count_all('users');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);

       $data['users'] = $this->administrator_model->get_users($config['per_page'],$this->uri->segment(3));

       //$data['investigador'] = $this->administrator_model->get_investigador($data['id_principal']);


		$data['title'] = "Sistema Solar";
        $data['heading'] = "Sistema Solar";

		$this->load->view('administrator/listUsersView',$data);
	}

	function formUser()
	{

		$data['title'] = "Sistema Solar";
        $data['heading'] = "Sistema Solar";
        $data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		//$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		// para la auth
		if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

        $user_id        = $this->uri->segment(3);

        //$data['drop_menu_investigadores'] = $this->administrator_model->drop_menu_investigadores() ;
        $data['drop_menu_roles'] = $this->administrator_model->drop_menu_roles() ;
        //$data['investigador'] = $this->administrator_model->get_investigador($data['id_principal']);

        if ($user_id != "") { // edit so populate the form from database
        $data['rs_user']                = $this->administrator_model->get_user_by_id($user_id) ;
        }

        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted

            $form = array(
                      'role_id' =>             $this->input->post('role_id'),
                      'nombres' =>            $this->input->post('nombres'),
                      'apellidos' =>            $this->input->post('apellidos')

                    );

            if ($user_id != '') {
                    // id passed so update
                   $this->db->where('id', $user_id);
                   $this->db->update('users', $form);
            }
            redirect('/administrator');

        } else {
        	$this->load->view('/administrator/editUserView', $data);
        } // check if validation failed


    }



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */