<?php

class Upload extends Controller {
	
	function Upload()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{	
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$ruta=$config['upload_path'];
		
		
		if ($this->uri->segment(3)){	
			$cod_prototipo = $this->uri->segment(3);
		}else{
			$cod_prototipo=$this->input->post('cod_prototipo');
		}
		$data['cod_prototipo'] = $cod_prototipo;
		$this->load->library('upload', $config);

		$form = array(
			'cod_prototipo' 	=>	$this->input->post('cod_prototipo'),
			'imagen' 		=>      $this->input->post('userfile'),
			);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('pro_imagen', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//echo "Data: ",$data->upload_path;
			//$this->db->insert('prototipo', $form);			
			$this->load->view('upload_success', $data);
		}
	}	
function do_upload1()
	{
		

		$form = array(
			'cod_prototipo' 	=>	$this->input->post('cod'),
			'imagen' 		=>      $this->input->post('userfile'),
			);
	
		
			//echo "Data: ",$data->upload_path;
			$this->db->insert('prototipo', $form);			
			//$this->load->view('upload_success', $data);
		
	}	
}
?>
