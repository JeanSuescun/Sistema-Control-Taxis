<?php

class Datos extends Controller {
	function Datos()
	{
		parent::Controller();
		$this->load->model('system_model');
		$this->load->helper('url');
		$this->load->library('calendar');
		$this->load->helper('form');
		$this->load->library('form_validation');

		date_default_timezone_set('America/Caracas');

		// para autentificacion DX
		// Load library
		$this->load->library('DX_Auth');

		// bloque todo y deja a admin y los que tengan acceso
		$this->dx_auth->check_uri_permissions();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");

        $data['rs_consulta'] = $this->system_model->get_control();

		// Check if user is logged in or not
        if ($this->dx_auth->is_logged_in())
        {
            $data['logeado'] = true;
        }
        else
        {
            $data['logeado'] = false;
        }

	}

////////////////////////////////////////VEHICULOS//////////////////////////////////
	function vehiculos()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculos();
       // load the view
       $this->load->view('vehiculos',$data);
	}

///////////////////////////////Vehiculos form//////////////////////
	function vehiculos_form()
    {

       // Check if user is logged in or not

        $numero = $this->uri->segment(3);
        $data="";
        $bandera=0;
        $data['tiempo30']="si";

        if ($numero != "") { // edit so populate the form from database
        	$data['rs_consulta']                = $this->system_model->get_vehiculo_by_id($numero) ;
        	$bandera=1;
        }
        $data['bandera']=$bandera;

        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted

        $this->form_validation->set_rules('numero', 'Numero', 'required');
		$this->form_validation->set_rules('placa', 'Placa', 'required');

        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

            if ($this->form_validation->run() == FALSE) // check if validation failed
            {
                // failed validation, back to form
            }
            else
            {
                // grab post info and add it to the database
                $form = array(
                        'numero' =>             $this->input->post('numero'),
                        'placa' =>            $this->input->post('placa'),
                        'modelo' =>         $this->input->post('modelo'),
						'ano' =>         $this->input->post('ano'),
						'marca' =>         $this->input->post('marca'),
						//'ced_propietario' =>         $this->input->post('propietario'),
						'estado' =>         $this->input->post('estado'),
						'otro' =>         $this->input->post('otro'),
                    );

                        if ($numero != '') {
                            // id passed so update
                            $this->db->where('numero', $numero);
                            $this->db->update('vehiculos', $form);
                            if(($this->input->post('estado'))=="Accidentado"){
                            	$fecha = date("Y-m-d");
                            	$hora = date("H:i:s");
                            	$fecha_hora= $fecha." ".$hora;
								$form2 = array(
			                        'numero' =>             $this->input->post('numero'),
			                        'estado' =>            $this->input->post('estado'),
			                        'comentario' =>         $this->input->post('otro'),
			                        'fecha_hora'  =>   $fecha_hora,
			                    );
                            	$this->db->insert('vehiculos_historial', $form2);
                            }
                            if(($this->input->post('estado'))=="Suspendido"){
                            	$fecha = date("Y-m-d");
                            	$hora = date("H:i:s");
                            	$fecha_hora= $fecha." ".$hora;
								$form2 = array(
			                        'numero' =>             $this->input->post('numero'),
			                        'estado' =>            $this->input->post('estado'),
			                        'comentario' =>         $this->input->post('otro'),
			                        'fecha_hora'  =>   $fecha_hora,
			                    );
                            	$this->db->insert('vehiculos_historial', $form2);
                            }
                        } else {
                            // no id so insert
                            $this->db->insert('vehiculos', $form);
                        }

                        // all went ok back to list
                        redirect('/datos/vehiculos');

            } // check if validation failed

        } // check if form has been submitted
		$data['title'] = "Sistema Línea Taxis";
       	$data['heading'] = "Sistema Línea Taxis";
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }
            // Not submitted load an empty view
            $this->load->view('vehiculos_form', $data);
    }


////////////////////////////////////////VEHICULOS historial accientados//////////////////////////////////
	function vehiculos_historial()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$numero = $this->uri->segment(3);
        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculo_by_id_historial($numero);
       // load the view
       $this->load->view('vehiculos_historial',$data);
	}

////////////////////////////////////////VEHICULOS historial suspensiones//////////////////////////////////
	function vehiculos_suspendidos()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$numero = $this->uri->segment(3);
        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculo_by_id_suspendido($numero);
       // load the view
       $this->load->view('vehiculos_suspendidos',$data);
	}


////////////////////////////////////////PERSONAS//////////////////////////////////
	function personas()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Personas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_personas();
       // load the view
       $this->load->view('personas',$data);
	}

///////////////////////////////Vehiculos form//////////////////////
	function personas_form()
    {

       // Check if user is logged in or not

        $cedula = $this->uri->segment(3);
        $nombre = $this->uri->segment(4);
        $data="";
        $bandera=0;

        if ($cedula != "") { // edit so populate the form from database
        $data['rs_consulta'] = $this->system_model->get_persona_by_id($cedula);
        $bandera=1;
        }
        $data['bandera']=$bandera;
		$data['menu_vehiculos'] = $this->system_model->get_vehiculos_select();
        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted

        $this->form_validation->set_rules('cedula', 'C&eacute;dula', 'required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required');
		$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', 'required');
		$this->form_validation->set_rules('numero_vehiculo', 'N&uacute;mero veh&iacute;culo', 'required');
		$this->form_validation->set_rules('tipo_persona', 'Tipo persona', 'required');

        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

            if ($this->form_validation->run() == FALSE) // check if validation failed
            {
                // failed validation, back to form
            }
            else
            {
                // grab post info and add it to the database
                $form = array(
                        'cedula' =>             $this->input->post('cedula'),
                        'nombre' =>            $this->input->post('nombre'),
                        'direccion' =>         $this->input->post('direccion'),
						'telefono' =>         $this->input->post('telefono'),
						'celular' =>         $this->input->post('celular'),
						'numero_vehiculo' =>         $this->input->post('numero_vehiculo'),
						'tipo_persona' =>         $this->input->post('tipo_persona'),
                    );

                        if ($cedula != '') {
                            // id passed so update
                            $this->db->where('cedula', $cedula);
                            $this->db->update('personas', $form);
                        } else {
                            // no id so insert
                            $this->db->insert('personas', $form);
                            redirect('/datos/personas_form/'.$this->input->post('cedula'));
                        }

                        // all went ok back to list
                        redirect('/datos/personas');

            } // check if validation failed

        } // check if form has been submitted
		$data['title'] = "Sistema Línea Taxis";
        $data['heading'] = "Sistema Línea Taxis";
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }
            // Not submitted load an empty view
            $this->load->view('personas_form', $data);
    }



////////////////////////////////////////CONTROL//////////////////////////////////
	function control()
	{
       $data['heading'] = "Control principal";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }

	   $data['rs_consulta'] = $this->system_model->get_control();
	   $data['rs_consulta1'] = $this->system_model->get_control1();
       // load the view
       $this->load->view('control',$data);
	}

///////////////////////////////Control form//////////////////////
	function control_form()
    {

       // Check if user is logged in or not

        $numero_vehiculo = $this->uri->segment(3);
        $data="";
		//$data['conductores'] = $this->system_model->get_conductores($numero_vehiculo);
        if ($numero_vehiculo != "") { // edit so populate the form from database
        $data['rs_consulta']                = $this->system_model->get_control_by_id($numero_vehiculo) ;
        }
         $data['tiempo30']="si";
		$data['menu_vehiculos'] = $this->system_model->get_vehiculos_select_libres();
		$data['numero_vehiculo']=$numero_vehiculo;
        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted
		$this->form_validation->set_rules('numero_vehiculo', 'Numero Vehiculo', 'required');
		$this->form_validation->set_rules('codigo_punto', 'Punto', 'required');
		if ($this->input->post('estado')=="Ocupado"){
			$this->form_validation->set_rules('codigo_origen', 'Origen', 'required');
			$this->form_validation->set_rules('codigo_destino', 'Destino', 'required');
			$this->form_validation->set_rules('conductor', 'Conductor', 'required');
			$data['estado']="Ocupado";
		}
		//$data['conductor']=$this->input->post('conductor');
        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

            if ($this->form_validation->run() == FALSE) // check if validation failed
            {
                // failed validation, back to form
            }
            else
            {
            	$orden_hora = date("Y-m-d H:i:s");
                // grab post info and add it to the database
                $form = array(
                        'numero_vehiculo' =>             $this->input->post('numero_vehiculo'),
                        'codigo_origen' =>            $this->input->post('codigo_origen'),
                        'codigo_destino' =>         $this->input->post('codigo_destino'),
						'conductor' =>         $this->input->post('conductor'),
						'estado' =>         $this->input->post('estado'),
						'codigo_punto' =>         $this->input->post('codigo_punto'),
						'orden_hora' =>         $orden_hora,
                    );

                    $form_carrera = array(
                        'numero_vehiculo' =>             $this->input->post('numero_vehiculo'),
                        'codigo_origen' =>            $this->input->post('codigo_origen'),
                        'codigo_destino' =>         $this->input->post('codigo_destino'),
						'conductor' =>         $this->input->post('conductor'),
						'fecha_hora' =>         $orden_hora,
                    );

                        if ($numero_vehiculo != '') {
                            // id passed so update
                            $this->db->where('numero_vehiculo', $numero_vehiculo);
                            $this->db->update('control', $form);
                            if($this->input->post('estado')=="Fuera Servicio"){
                            	$this->db->where('numero_vehiculo', $numero_vehiculo);
                            	$this->db->delete('control');
                            }
                            if($this->input->post('estado')=="Ocupado"){
                            	$this->db->insert('carreras', $form_carrera);
                            }
                        } else {
                            // no id so insert
                            $this->db->insert('control', $form);
                            if($this->input->post('estado')=="Ocupado"){
                            	$this->db->insert('carreras', $form_carrera);
                            }
                        }

                        // all went ok back to list
                        redirect('/datos/control');

            } // check if validation failed

        } // check if form has been submitted
		$data['title'] = "Sistema Línea Taxis";
        $data['heading'] = "Sistema Línea Taxis";
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");


        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }
            // Not submitted load an empty view
            $this->load->view('control_form', $data);
    }


////////////////////////////////////////CARRERAS//////////////////////////////////
	function carreras()
	{
       $data['heading'] = "Ver carreras";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
      /* $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/carreras';
       $config['total_rows'] = $this->db->count_all('carreras');
       $config['per_page'] = '50';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';

       $this->pagination->initialize($config);*/
	   $data['total_rows'] = $this->db->count_all('carreras');
	   //$data['rs_consulta'] = $this->system_model->get_carreras($config['per_page'],$this->uri->segment(3));
	   $data['rs_consulta'] = $this->system_model->get_carreras();

	   //$data['rs_consulta'] = $this->system_model->get_carreras();
       // load the view
       $this->load->view('carreras',$data);
	}



////////////////////////////////////////CONSULTAS//////////////////////////////////
	function consultas()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Consultas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";


        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }

	   //$data['rs_consulta'] = $this->system_model->get_consultas();
	   $data['menu_vehiculos'] = $this->system_model->get_vehiculos_select();

       // load the view
       $this->load->view('consultas',$data);
	}

////////////////////////////////////////CONSULTAS//////////////////////////////////
	function consultas2()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Consultas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
		$numero_vehiculo = $this->input->post('numero_vehiculo');
		$fecha_desde = $this->input->post('fecha_desde');
		$fecha_hasta = $this->input->post('fecha_hasta');
		if ($this->dx_auth->is_logged_in())
	         {
	             $data['logueado'] = true;
	         }
	         else
	         {
	             $data['logueado'] = false;
	         }
		///validación
		if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted
			$this->form_validation->set_rules('fecha_desde', 'Fecha Desde', 'required');
			$this->form_validation->set_rules('fecha_hasta', 'Fecha Hasta', 'required');


	        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

	            if ($this->form_validation->run() == FALSE) // check if validation failed
	            {
	                // failed validation, back to form
	                // all went ok back to list
                        redirect('/datos/consultas');
	            }
	            else
	            {
				   $data['numero_vehiculo']=$numero_vehiculo;
				   $data['fecha_desde']=$fecha_desde;
				   $data['fecha_hasta']=$fecha_hasta;
				   $fecha_desde=$fecha_desde." 00:00:00";
				   $fecha_hasta=$fecha_hasta." 23:59:59";
				   $data['rs_consulta'] = $this->system_model->get_consultas($numero_vehiculo,$fecha_desde,$fecha_hasta);
				   //$data['menu_vehiculos'] = $this->system_model->get_vehiculos_select();

			       // load the view
			       $this->load->view('consultas2',$data);
			    }
		}
	}
/////////////////////////// AJAX CONDUCTOR
	function ajax_conductor()
	    {
		 echo "Entra";

	       	$numero_vehiculo=$this->uri->segment(3);
	       	$data['conductores'] = $this->system_model->get_conductores_select($numero_vehiculo);

	       	$this->load->view('cargaajaxconductor',$data);

	    }

////////////////////////////////////////Creditos//////////////////////////////////
	function creditos()
	{
       	$data['heading'] = "Cr&eacute;ditos";
  		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

       // load the view
       $this->load->view('creditos',$data);
	}

////////////////////////////////////////MAPA//////////////////////////////////
	function mapa()
	{
       	$data['heading'] = "Mapa";
  		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

       // load the view
       $this->load->view('mapa',$data);
	}



////////////////////////////////////////UBICACION//////////////////////////////////
	function ubicacion()
	{
       	$data['heading'] = "Mapa de Ubicaci&oacute;n";
  		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

       // load the view
       $this->load->view('ubicacion',$data);
	}

////////////////////////////////////////UBICACION//////////////////////////////////
	function ubicacion2()
	{
       	$data['heading'] = "Mapa de Ubicaci&oacute;n";
  		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

       // load the view
       $this->load->view('ubicacion2',$data);
	}

////////////////////////////////////////UBICACION//////////////////////////////////
	function ubicacion_puntos()
	{
       	$data['heading'] = "Mapa de Ubicaci&oacute;n de puntos";
  		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

       // load the view
       $this->load->view('ubicacion_puntos',$data);
	}




////////////////////////////////////////ACCIDENTADOS//////////////////////////////////
	function accidentados()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos accidentados";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculos_accidentados();
       // load the view
       $this->load->view('vehiculos_accidentados',$data);
	}


////////////////////////////////////////ACCIDENTADOS//////////////////////////////////
	function suspendidos()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos suspendidos";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculos_suspendidos();
       // load the view
       $this->load->view('vehiculos_suspendidos2',$data);
	}

////////////////////////////////////////DE VIAJE//////////////////////////////////
	function viaje()
	{
       //$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Vehículos viajando";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
	   $data['rs_consulta'] = $this->system_model->get_vehiculos_viajando();
       // load the view
       $this->load->view('vehiculos_viajando',$data);
	}


////////////////////////// SUBIR ARCHIVOS FOTOS /////////////////////////////////////////
	function upload()
	{
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
		if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		//$this->load->view('upload_form', array('error' => ' ' ));
		$this->load->view('upload_form', $data);
	}

	function do_upload()
	{
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";

		if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;
         }
         else
         {
             $data['logueado'] = false;
         }
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$ruta=$config['upload_path'];
		$cedula=$this->input->post('cedula');
		$nombre=$this->input->post('nombre');
		//$nombre=$this->uri->segment(4);
		$data['cedula'] = $cedula;
		$data['nombre'] = $nombre;
		$this->load->library('upload', $config);

		$form = array(
			'cedula' 	=>	$this->input->post('cedula'),
			'foto' 		=>  $this->input->post('userfile'),
			);

		if ( ! $this->upload->do_upload())
		{
			$data['role_name'] = $this->dx_auth->get_role_name();
			$data['username'] = $this->dx_auth->get_username();
			$data['fecha'] = date("d-m-Y");
	        $data['hora'] = date("H:i:s");

			if ($this->dx_auth->is_logged_in())
	         {
	             $data['logueado'] = true;
	         }
	         else
	         {
	             $data['logueado'] = false;
	         }
			$error = array('error' => $this->upload->display_errors());
			$data['error']=$error;
			$this->load->view('upload_success', $data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$data['cedula'] = $cedula;
			$data['nombre'] = $nombre;
			$data['role_name'] = $this->dx_auth->get_role_name();
			$data['username'] = $this->dx_auth->get_username();
			$data['fecha'] = date("d-m-Y");
	        $data['hora'] = date("H:i:s");

			if ($this->dx_auth->is_logged_in())
	         {
	             $data['logueado'] = true;
	         }
	         else
	         {
	             $data['logueado'] = false;
	         }
			//echo "Data: ",$data->upload_path;
			//$this->db->insert('prototipo', $form);
			$this->load->view('upload_success', $data);
		}
	}
	function do_upload1()
	{
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['fecha'] = date("d-m-Y");
        $data['hora'] = date("H:i:s");
        $data['tiempo30']="si";
		if ($this->dx_auth->is_logged_in())
         {
             $data['logueado'] = true;

         }
         else
         {
             $data['logueado'] = false;
         }

		$form = array(
			'cod_prototipo' 	=>	$this->input->post('cod'),
			'imagen' 		=>      $this->input->post('userfile'),
			);


			//echo "Data: ",$data->upload_path;
			$this->db->insert('prototipo', $form);
			//$this->load->view('upload_success', $data);

	}


































////////////////////////////////////////Principal preguntas//////////////////////////////////
	function consultar()
	{
       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;
         }
         else
         {
             $data['logeado'] = false;
         }
	   $data['rs_consulta'] = $this->system_model->get_preguntas();
       // load the view
       $this->load->view('consulta',$data);
	}

////////////////////////////////////////Manual usuarios//////////////////////////////////
	function manual_usuarios()
	{
       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;
         }
         else
         {
             $data['logeado'] = false;
         }
	   //$data['rs_consulta'] = $this->system_model->get_preguntas();
       // load the view
       $this->load->view('manual_usuarios.pdf');
	}



////////////////////////////////////////Consulta preguntas//////////////////////////////////
	function consulta_pregunta()
	{
       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;
         }
         else
         {
             $data['logeado'] = false;
         }
	   $id_pregunta=$this->uri->segment(3);
	   $data['id_actual']=$id_pregunta;
	   $data['rs_consulta'] = $this->system_model->get_consulta_pregunta($id_pregunta);
	   $data['rs_cadena'] = $this->system_model->get_consulta_cadena($id_pregunta);
       // load the view
       $this->load->view('consulta',$data);
	}

////////////////////////////////////////Preguntas//////////////////////////////////
	function preguntas_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();


        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
       $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/preguntas_list';
       $config['total_rows'] = $this->db->count_all('preguntas');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->system_model->get_preguntas_list($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('preguntas_list',$data);

	}


////////////////////////////////////////Preguntas//////////////////////////////////
	function preguntas_form()
    {

       // Check if user is logged in or not

        $id_pregunta = $this->uri->segment(3);
        $data="";

        if ($id_pregunta != "") { // edit so populate the form from database
        $data['rs_consulta']                = $this->system_model->get_pregunta_by_id($id_pregunta) ;
        }

        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted

        $this->form_validation->set_rules('id_pregunta', 'Identificar de pregunta', 'required');
		$this->form_validation->set_rules('pregunta', 'Pregunta', 'required');

        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

            if ($this->form_validation->run() == FALSE) // check if validation failed
            {
                // failed validation, back to form
            }
            else
            {
                // grab post info and add it to the database
                $form = array(
                        'id_pregunta' =>             $this->input->post('id_pregunta'),
                        'pregunta' =>            $this->input->post('pregunta'),
                        'id_padre' =>         $this->input->post('id_padre'),
                    );

                        if ($id_pregunta != '') {
                            // id passed so update
                            $this->db->where('id_pregunta', $id_pregunta);
                            $this->db->update('preguntas', $form);
                        } else {
                            // no id so insert
                            $this->db->insert('preguntas', $form);
                        }

                        // all went ok back to list
                        redirect('/datos/preguntas_list');

            } // check if validation failed

        } // check if form has been submitted
		$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();


        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
            // Not submitted load an empty view
            $this->load->view('preguntas_form', $data);
    }




////////////////////////////////////////Respuestas//////////////////////////////////
	function respuestas_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();


        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/respuestas_list';
       $config['total_rows'] = $this->db->count_all('respuestas');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->system_model->get_respuestas_list($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('respuestas_list',$data);

	}


////////////////////////////////////////Respuestas//////////////////////////////////
	function respuestas_form()
    {

       // Check if user is logged in or not

        $id_respuesta = $this->uri->segment(3);

        $data="";

        if ($id_respuesta != "") { // edit so populate the form from database
        $data['rs_consulta']                = $this->system_model->get_respuesta_by_id($id_respuesta) ;
        }

        if(isset($_POST) && count($_POST) > 0)    { // check if form has been submitted

        $this->form_validation->set_rules('id_respuesta', 'Identificar de respuesta', 'required');
		$this->form_validation->set_rules('respuesta', 'Respuesta', 'required');

        $this->form_validation->set_error_delimiters('<div class="Errors">', '</div>');

            if ($this->form_validation->run() == FALSE) // check if validation failed
            {
                // failed validation, back to form
            }
            else
            {
                // grab post info and add it to the database
                $form = array(
                        'id_respuesta' =>             $this->input->post('id_respuesta'),
                        'respuesta' =>            $this->input->post('respuesta'),
                        'id_pregunta' =>         $this->input->post('id_pregunta'),
                    );
                        if ($id_respuesta != '') {
                            // id passed so update
                            $this->db->where('id_respuesta', $id_respuesta);
                            $this->db->update('respuestas', $form);
                        } else {
                            // no id so insert
                            $this->db->insert('respuestas', $form);
                        }

                        // all went ok back to list
                        redirect('/datos/respuestas_list');

            } // check if validation failed

        } // check if form has been submitted
		$data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();


        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
            // Not submitted load an empty view
            $this->load->view('respuestas_form', $data);
    }
////////////////////////////////////////Registrar fallas//////////////////////////////////
	function registro_fallas()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

       // load the view
       $this->load->view('registro_fallas',$data);

	}
////////////////////////////////////////Registrar fallas//////////////////////////////////
	function registro_fallas2()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$falla=$_POST['falla'];
		$titulo=$_POST['titulo'];
		$fecha=$_POST['fecha'];
		$hora=$_POST['hora'];
		$usuario=$_POST['usuario'];
        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
		$data['falla']=$falla;
		$data['titulo']=$titulo;
		$data['fecha']=$fecha;
		$data['hora']=$hora;
		$data['usuario']=$usuario;

		$data['rs_consulta'] = $this->system_model->registro_fallas($falla,$titulo,$fecha,$hora,$usuario);
       // load the view
       $this->load->view('registro_fallas2',$data);

	}

////////////////////////////////////////Respuestas//////////////////////////////////
	function consultar_fallas()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();


        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/consultar_fallas';
       $config['total_rows'] = $this->db->count_all('fallas');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->system_model->get_fallas($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('consultar_fallas',$data);

	}

////////////////////////////////////////Cambiar estatus fallas//////////////////////////////////
	function cambiar_falla()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

		$id=$this->uri->segment(3);

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
		$data['rs'] = $this->system_model->cambiar_falla($id);

       // load the view
       $this->load->view('cambiar_estatus_falla',$data);

	}

////////////////////////////////////////Reportar eventos ocurridos//////////////////////////////////
	function reportar_evento()
	{
       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;
         }
         else
         {
             $data['logeado'] = false;
         }
	   $id_pregunta=$this->uri->segment(3);
	   $fecha=date("Y-m-d");
	   $usuario=$data['username'];
	   $this->system_model->reportar_fallas($id_pregunta,$fecha,$usuario);
       // load the view
       $this->load->view('reportar_falla',$data);
	}


////////////////////////////////////////Reporte de fallas//////////////////////////////////
	function reporte_fallas()
	{
       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();

        if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;
         }
         else
         {
             $data['logeado'] = false;
         }
	   $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/reporte_fallas';
       $config['total_rows'] = $this->db->count_all('reporte_fallas');
       $config['per_page'] = '20';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   //$data['rs_consulta'] = $this->system_model->get_fallas($config['per_page'],$this->uri->segment(3));
	   $data['rs_consulta'] = $this->system_model->get_reporte_fallas($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('reporte_fallas',$data);
	}





















////////////////////////////////////////Proveedores//////////////////////////////////
	function proveedores_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		/*$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();
		*/

        /*if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }*/
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/proveedores_list';
       $config['total_rows'] = $this->db->count_all('proveedores');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->mantenimiento_model->get_proveedores($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('proveedores_list',$data);

	}

////////////////////////////////////////Materiales//////////////////////////////////
	function materiales_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		/*$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();
		*/

        /*if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }*/
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/materiales_list';
       $config['total_rows'] = $this->db->count_all('materiales');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->mantenimiento_model->get_materiales($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('materiales_list',$data);

	}


////////////////////////////////////////Herramientas//////////////////////////////////
	function herramientas_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		/*$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();
		*/

        /*if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }*/
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/herramientas_list';
       $config['total_rows'] = $this->db->count_all('herramientas');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->mantenimiento_model->get_herramientas($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('herramientas_list',$data);

	}

////////////////////////////////////////Equipos//////////////////////////////////
	function equipos_list()
	{

       $data['title'] = "Sistema Experto CIDA";
       $data['heading'] = "Sistema diagn&oacute;stico de fallas";
       // Check if user is logged in or not
		/*$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();
		*/

        /*if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }*/
         $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/equipos_list';
       $config['total_rows'] = $this->db->count_all('equipos');
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   $data['total_rows'] = $config['total_rows'];
	   $data['rs_consulta'] = $this->mantenimiento_model->get_equipos($config['per_page'],$this->uri->segment(3));
       // load the view
       $this->load->view('equipos_list',$data);

	}




















////////////////////////////////////////Principal//////////////////////////////////
	function principal()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Sistema de Colecci&oacute;n de Datos Observacionales";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
         $this->load->model('scdobs_model');
	   $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);
       // load the view
       $this->load->view('principal',$data);

	}

	function instancias_objetos()
	{

       $data['title'] = "Observatorio Virtual CIDA";
       $data['heading'] = "Tabla de Instancias de Objetos.";
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

	   $start1=$this->uri->segment(3);
       $start2=$this->uri->segment(4);
       $start3=$this->uri->segment(5);
	   $desde=$start3."-".$start2."-".$start1;
       $data['start_date']=$start1."/".$start2."/".$start3;

	   $start4=$this->uri->segment(6);
       $start5=$this->uri->segment(7);
       $start6=$this->uri->segment(8);
	   $hasta=$start6."/".$start5."/".$start4;
	   $data['end_date']=$start4."/".$start5."/".$start6;

       // load pagination class
       $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/instancias_objetos';
       $config['total_rows'] = $this->db->count_all('instancias_objeto');
       $config['per_page'] = '50';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('ovirtual_model');
       $data['results'] = $this->ovirtual_model->get_instancias_objeto($config['per_page'],$desde,$hasta);
       $data['objeto'] = false;
       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Fecha','Num observaciÃ³n','ID Objeto','QNX','CCD','Frame','Pox X','Pos Y','Num Pix','Menor','Mayor','Theta','Fwhm','Max Valor','Cielo','Ruido','Magnitud Instrum','Error Instrum','PSF','Error PSF','INF','HJD','CHI','Sharp','Flag','Mapp','eMapp','Xapp','Yapp','Xpsf','Ypsf','Skyapp','Skypsf','Asc Recta','DeclinaciÃ³n');
       // load the view
       $this->load->view('datos_view', $data);
       //$this->load->view('instancias_view', $data);

	}

	function objeto()
	{

       $data['title'] = "Observatorio Virtual CIDA";
       $data['heading'] = "Tabla de Objetos.";

       // load pagination class
       $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/objeto';
       $config['total_rows'] = $this->db->count_all('objetos');
       $config['per_page'] = '50';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('ovirtual_model');
       $data['results'] = $this->ovirtual_model->get_objeto($config['per_page'],$this->uri->segment(3));

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Objeto','Asc Recta Prom','Asc Recta Error','Dec Prom','Dec Error','Imagen','Variable','Num instancias');
	   $data['objeto'] = true;
       // load the view
       $this->load->view('datos_view', $data);
       //$this->load->view('instancias_view', $data);
	}

	function instancias(){

	   $data['title'] = "Observatorio Virtual CIDA";
       $data['heading'] = "Consulta Avanzada de Observaciones";

       if( empty($_POST['start_date']) or empty($_POST['end_date']) )
       {

       	  $data['start_date'] = '01/02/2006';
          $data['end_date'] = '01/02/2006';

       	  $data['start_date_h'] = '01/02/2006 00:00:00';
          $data['end_date_h'] = '01/02/2006 23:59:59';

       } else {

          $data['start_date'] = $_POST['start_date'];
          $data['end_date'] = $_POST['end_date'];

          $data['start_date_h']=substr($_POST['start_date'],6,4).'-'.substr($_POST['start_date'],3,2).'-'.substr($_POST['start_date'],0,2)." 00:00:00";
	      $data['end_date_h']=substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)." 23:59:59";

       }
 		//Obtener nro de instancias a objetos por fecha desde a fecha hasta
	   $this->load->model('ovirtual_model');
	   $data['nro_reg'] =$this->ovirtual_model->get_instancias($data['start_date_h'],$data['end_date_h']);

		//Obtener nro de observaciones por fecha desde a fecha hasta
	   $data['nro_reg2'] =$this->ovirtual_model->get_observaciones($data['start_date_h'],$data['end_date_h']);

		//Obtener nro de objetos
	   $data['nro_reg3'] =$this->ovirtual_model->get_objetos();

	   if ($data['nro_reg']!=0 and $data['nro_reg2']!=0 and $data['nro_reg3']!=0){
	     $data['mostrar'] = true;
	   } else {
	 	 $data['mostrar'] = false;
	   }
       $this->load->view('instancias_view', $data);
    }

//////////////////////////////////////// Consulta Noches de Observacion///////////////////////////////////
    function consulta_noches(){

	   $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Consulta de Noches de Observaci&oacute;n";

		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

       if(empty($_POST['start_date']) or empty($_POST['end_date']))
       {
      	   $start1=$this->uri->segment(3);
	       $start2=$this->uri->segment(4);
	       $start3=$this->uri->segment(5);
		   $desde=$start3."-".$start2."-".$start1;
	       $data['start_date']=$start1."/".$start2."/".$start3;

		   $start4=$this->uri->segment(6);
	       $start5=$this->uri->segment(7);
	       $start6=$this->uri->segment(8);
		   $hasta=$start6."-".$start5."-".$start4;
		   $data['end_date']=$start4."/".$start5."/".$start6;

           $data['start_date_h']=$desde." 00:00:00";
	       $data['end_date_h']=$hasta." 23:59:59";
       } else {
          $data['start_date'] = $_POST['start_date'];
          $data['end_date'] = $_POST['end_date'];

          $data['start_date_h']=substr($_POST['start_date'],6,4).'-'.substr($_POST['start_date'],3,2).'-'.substr($_POST['start_date'],0,2)." 00:00:00";
	      $data['end_date_h']=substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)." 23:59:59";

      }

       $this->load->library('pagination');

       $config['uri_segment'] = 9;
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';

       $config['base_url'] = base_url().'index.php/datos/consulta_noches/'.$data['start_date'].'/'.$data['end_date'];
       //$config['base_url'] = base_url().'index.php/datos/consulta_noches/';
       $this->load->model('scdobs_model');
       $config['total_rows'] = $this->scdobs_model->get_noches_num($data['start_date_h'],$data['end_date_h']);
       $data['num_noches']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);

       //load the model and get results
       $data['resultados'] = $this->scdobs_model->get_noches($data['start_date_h'],$data['end_date_h'],$config['per_page'],$this->uri->segment(9));
	   $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       //$this->load->library('table');
       //$this->table->set_heading('Fecha','Comentario','CÃºpula Vent','Refrig Vent','Elect Vent','Teles Vent');

       // load the view
       $this->load->view('datos/consulta_noches_view', $data);

    }
//////////////////////////////////////// Consulta de Observaciones///////////////////////////////////
	function observaciones()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla de Observaciones";
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         // Load library
		$this->load->library('DX_Auth');

		// bloque todo y deja a admin y los que tengan acceso
		$this->dx_auth->check_uri_permissions();

		// Check if user is logged in or not
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
       $config['base_url'] = base_url().'index.php/datos/observaciones';
       $config['total_rows'] = $this->db->count_all('observations_id_view');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');

       $data['results'] = $this->scdobs_model->get_observaciones($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       //$this->load->library('table');
       //$this->table->set_heading('Fecha','No','Proyecto','Tipo','Filtro 1','Filtro 2','Filtro 3','Filtro 4','FCh','FP','P','PO','Expos','UT_I','UT_F','Declin_Sig','Declin_Deg','Declin_Min','Declin_Sec','RA_I','RA_F','HA','HADir','Wind','WindDir','ChillT','DomeT','DomeH','ColA','ColB','ColC','ColD','Comments');

       // load the view
       $this->load->view('datos/general_view', $data);
	}



//////////////////////////////////////// Consulta de Observaciones Ventana emergente///////////////////////////////////
	function observacion2()
	{
	   date_default_timezone_set('America/Caracas');
       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Datos de Observaci&oacute;n";
       // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

	   $data['ObsNo'] = $this->uri->segment(3);
	   $data['Fecha']=date_format(date_create($this->uri->segment(4)),'Y-m-d');
	   $data['pag'] = $this->uri->segment(5);
       $config['base_url'] = base_url().'index.php/datos/observacion2';
       $parametros["ObsNo ="]=$data['ObsNo'];
       $parametros["Date ="]=$data['Fecha'];
       $this->load->model('scdobs_model');

       $data['results'] = $this->scdobs_model->get_observacion2($parametros);

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       $this->load->view('datos/observacion_view2', $data);



	}

//////////////////////////////////////// Generar archivo ASCII de consulta///////////////////////////////////
	function archivo()
	{
	   date_default_timezone_set('America/Caracas');
       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Datos de Observaci&oacute;n";
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

       /////////////////////
       $cadena=$this->uri->segment(3);
		$parametros="";

			if($cadena!=""){

			$cadena_separa = explode(".",$cadena);

			for($i=0;$i<count($cadena_separa);$i++){
				$parametro=substr($cadena_separa[$i],0,2);
				if ($parametro=="f1"){
					$data['start_date'] = substr($cadena_separa[$i],2,12);
					$data['start_date']=date_format(date_create($data['start_date']),'Y-m-d');
					$parametros["Date >="]=$data['start_date'];
				}
				if ($parametro=="f2"){
					$data['end_date'] = substr($cadena_separa[$i],2,12);
					$data['end_date']=date_format(date_create($data['end_date']),'Y-m-d');
					$parametros["Date <="]=$data['end_date'];
				}
				if ($parametro=="pr"){
					$data['project'] = substr($cadena_separa[$i],2,5);
					$parametros['id_project =']=$data['project'];
				}
				if ($parametro=="ti"){
					$data['type' .
							''] = substr($cadena_separa[$i],2,5);
					$parametros['type =']=$data['type'];
				}
				if ($parametro=="l1"){
					$data['filtro1'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_1 =']=$data['filtro1'];
				}
				if ($parametro=="l2"){
					$data['filtro2'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_2 =']=$data['filtro2'];
				}
				if ($parametro=="l3"){
					$data['filtro3'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_3 =']=$data['filtro3'];
				}
				if ($parametro=="l4"){
					$data['filtro4'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_4 =']=$data['filtro4'];
				}
			}
		}
		if (($data['role_name']!="Admin") and ($data['role_name']!="Cato") and empty($data['project'])){
		 	$parametros['Id_Principal =']=$data['id_principal'];
		}

		//$data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);


       ///////////////
	   //echo "Start: ",$data['start_date'] = date_format(date_create($this->uri->segment(3)),'Y-m-d');
	   //echo "end: ",$data['end_date'] = date_format(date_create($this->uri->segment(4)),'Y-m-d');
	   //$data['Fecha']=date_format(date_create($this->uri->segment(4)),'Y-m-d');
	   $data['pag'] = $this->uri->segment(4);
       $config['base_url'] = base_url().'index.php/datos/archivo';
       //$parametros["Date >="]=$data['start_date'];
       //$parametros["Date <="]=$data['end_date'];
       $this->load->model('scdobs_model');

       $data['results'] = $this->scdobs_model->get_archivo($parametros);
       $this->load->view('datos/archivo_view2', $data);
	}

	//////////////////////////////////////// Generar archivo ASCII de consulta///////////////////////////////////
	function archivo2()
	{
	   date_default_timezone_set('America/Caracas');
       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Datos de Observaci&oacute;n";
		// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

       /////////////////////
       $cadena=$this->uri->segment(3);
		$parametros="";

			if($cadena!=""){

			$cadena_separa = explode(".",$cadena);

			for($i=0;$i<count($cadena_separa);$i++){
				$parametro=substr($cadena_separa[$i],0,2);
				if ($parametro=="f1"){
					$data['start_date'] = substr($cadena_separa[$i],2,12);
					$data['start_date']=date_format(date_create($data['start_date']),'Y-m-d');
					$parametros["Date >="]=$data['start_date'];
				}
				if ($parametro=="f2"){
					$data['end_date'] = substr($cadena_separa[$i],2,12);
					$data['end_date']=date_format(date_create($data['end_date']),'Y-m-d');
					$parametros["Date <="]=$data['end_date'];
				}
				if ($parametro=="pr"){
					$data['project'] = substr($cadena_separa[$i],2,5);
					$parametros['id_project =']=$data['project'];
				}
				if ($parametro=="ti"){
					$data['type' .
							''] = substr($cadena_separa[$i],2,5);
					$parametros['type =']=$data['type'];
				}
				if ($parametro=="l1"){
					$data['filtro1'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_1 =']=$data['filtro1'];
				}
				if ($parametro=="l2"){
					$data['filtro2'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_2 =']=$data['filtro2'];
				}
				if ($parametro=="l3"){
					$data['filtro3'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_3 =']=$data['filtro3'];
				}
				if ($parametro=="l4"){
					$data['filtro4'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_4 =']=$data['filtro4'];
				}
			}
		}
		if (($data['role_name']!="Admin") and ($data['role_name']!="Cato") and empty($data['project'])){
		 	$parametros['Id_Principal =']=$data['id_principal'];
		}


       ///////////////
	   //echo "Start: ",$data['start_date'] = date_format(date_create($this->uri->segment(3)),'Y-m-d');
	   //echo "end: ",$data['end_date'] = date_format(date_create($this->uri->segment(4)),'Y-m-d');
	   //$data['Fecha']=date_format(date_create($this->uri->segment(4)),'Y-m-d');
	   $data['pag'] = $this->uri->segment(4);
       $config['base_url'] = base_url().'index.php/datos/archivo';
       //$parametros["Date >="]=$data['start_date'];
       //$parametros["Date <="]=$data['end_date'];
       $this->load->model('scdobs_model');


       $data['results'] = $this->scdobs_model->get_archivo($parametros);

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       $this->load->view('datos/archivo_view3', $data);
	}

//////////////////////////////////////// Consulta de Observaciones por noche Ventana emergente///////////////////////////////////
	function observacion_noche()
	{
	   date_default_timezone_set('America/Caracas');
       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Observaciones de la noche del ";
	   $data['Fecha']=date_format(date_create($this->uri->segment(3)),'Y-m-d');
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

// load pagination class
       $config['uri_segment'] = 4;
       $this->load->library('pagination');
       $config['base_url'] = base_url().'index.php/datos/observacion_noche/'.$data['Fecha'];
       $parametros["Date ="]=$data['Fecha'];
	   $data['pag']=$this->uri->segment(4);
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

	   $this->load->model('scdobs_model');

       $config['total_rows'] = $this->scdobs_model->get_observacion_noche_num($parametros);
       //$config['total_rows'] = $this->db->count_all('observations');
       $data['total_rows']=$config['total_rows'];
       $this->pagination->initialize($config);
       $data['results'] = $this->scdobs_model->get_observacion_noche($data['Fecha'],$config['per_page'],$this->uri->segment(4));
       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);
       $this->load->view('datos/observacion_noche', $data);
	}
//////////////////////////////////////// Consulta Avanzada de Observaciones///////////////////////////////////
	function observaciones2()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Consulta de Observaciones";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

       if(empty($_POST['start_date']) or empty($_POST['end_date']))
       {

      	   $start1=$this->uri->segment(3);
	       $start2=$this->uri->segment(4);
	       $start3=$this->uri->segment(5);
		   $desde=$start3."-".$start2."-".$start1;
	       $data['start_date']=$start1."/".$start2."/".$start3;

		   $start4=$this->uri->segment(6);
	       $start5=$this->uri->segment(7);
	       $start6=$this->uri->segment(8);

		   $hasta=$start6."-".$start5."-".$start4;
		   $data['end_date']=$start4."/".$start5."/".$start6;

           $data['start_date_h']=$desde." 00:00:00";
	       $data['end_date_h']=$hasta." 23:59:59";
       } else {
          $data['start_date'] = $_POST['start_date'];
          $data['end_date'] = $_POST['end_date'];

          $data['start_date_h']=substr($_POST['start_date'],6,4).'-'.substr($_POST['start_date'],3,2).'-'.substr($_POST['start_date'],0,2)." 00:00:00";
	      $data['end_date_h']=substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)." 23:59:59";

      }
     if (empty($_POST['proyecto'])){
      	   $data['project']=$this->uri->segment(9);

      }else{
      	  $data['project']=$_POST['proyecto'];

      }

	   echo "proyecto: ",$data['project'];

       $this->load->model('scdobs_model');
       $data['filtros'] = $this->scdobs_model->get_filtros_select();
       $data['proyectos'] = $this->scdobs_model->get_proyectos_select();
       $data['tipos'] = $this->scdobs_model->get_tipos_select();
       $data['observador'] = $this->scdobs_model->get_observadores_select();
       $data['cielo'] = $this->scdobs_model->get_cielo_select();



       	if ($data['start_date']!="" and $data['end_date']!=""){
       		$cadena=$data['start_date'].'/'.$data['end_date']."/";
       	}

  		/*if ($data['project']!=""){
  			$cadena=$cadena.$data['project']."/";
  		}*/
  		//echo $cadena;

		//$config['uri_segment'] = $this->uri->segment(9);
		$config['uri_segment'] = 9;

        $this->load->library('pagination');

		$config['total_rows'] = $this->scdobs_model->get_observaciones_avanzada_num($data['start_date_h'],$data['end_date_h'],$data['project']);
        $config['per_page'] = '10';
        $config['first_link'] = 'Primero';
        $config['last_link'] = '&Uacute;ltimo';
        $config['base_url'] = base_url().'index.php/datos/observaciones2/'.$cadena;
        //$config['base_url'] = base_url().'index.php/datos/observaciones2/';


	     $data['num_observaciones']=$config['total_rows'];


       //$data['resultados'] = $this->scdobs_model->get_noches($data['start_date_h'],$data['end_date_h'],$config['per_page'],$this->uri->segment(9));
       //$data['num_noches']=$config['total_rows'];

       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

	   $data['resultados'] = $this->scdobs_model->get_observaciones_avanzada($data['start_date_h'],$data['end_date_h'],$data['project'],$config['per_page'],$this->uri->segment(9));

	   $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);
       //$data['resultados'] = $this->scdobs_model->get_observaciones_avanzada($data['start_date_h'],$data['end_date_h'],$data['project'],$config['per_page'],$this->uri->segment(10));
	   $this->pagination->initialize($config);

       $this->load->view('observaciones2_view', $data);

	}


//////////////////////////////////////// Consulta Avanzada de Observaciones///////////////////////////////////
	function consulta_control_form()
	{

        // Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }
      $this->load->model('scdobs_model');
      // si es admin o cato usar model todo sino mostrar model con filtro di_principal

	   if (($data['role_name']=="Cato")or ($data['role_name']=="Admin")){
	   		$data['proyectos']= $this->scdobs_model->get_proyectos_select();
	   }else{
	   if ($data['role_name']=="Investigador"){
	   		$data['proyectos'] = $this->scdobs_model->get_proyectos_principal_select($data['id_principal']);
	   }
	   }

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Consulta de Observaciones";

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       $data['filtros'] = $this->scdobs_model->get_filtros_select();
       //$data['proyectos'] = $this->scdobs_model->get_proyectos_select();
       $data['tipos'] = $this->scdobs_model->get_tipos_select();
       $data['observador'] = $this->scdobs_model->get_observadores_select();
       $data['cielo'] = $this->scdobs_model->get_cielo_select();

        $this->load->view('datos/consulta_form', $data);

	}



//////////////////////////////////////// Consulta Avanzada de Observaciones///////////////////////////////////
	function consulta_control()
	{
	   $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Consulta de Observaciones";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

         if ($this->dx_auth->is_logged_in())
         {
             $data['logeado'] = true;

         }
         else
         {
             $data['logeado'] = false;
         }

	   $cadena=$this->uri->segment(3);
		$parametros="";

		if($cadena!=""){

			$cadena_separa = explode(".",$cadena);

			for($i=0;$i<count($cadena_separa);$i++){
				$parametro=substr($cadena_separa[$i],0,2);
				if ($parametro=="f1"){
					$data['start_date'] = substr($cadena_separa[$i],2,12);
					$data['start_date_h']=substr($data['start_date'],6,4).'-'.substr($data['start_date'],3,2).'-'.substr($data['start_date'],0,2)." 00:00:00";
					$parametros["Date >="]=$data['start_date_h'];
				}
				if ($parametro=="f2"){
					$data['end_date'] = substr($cadena_separa[$i],2,12);
					$data['end_date_h']=substr($data['end_date'],6,4).'-'.substr($data['end_date'],3,2).'-'.substr($data['end_date'],0,2)." 00:00:00";
				    $parametros["Date <="]=$data['end_date_h'];
				}
				if ($parametro=="pr"){
					$data['project'] = substr($cadena_separa[$i],2,5);
					$parametros['id_project =']=$data['project'];
				}
				if ($parametro=="ti"){
					$data['type'] = substr($cadena_separa[$i],2,5);
					$parametros['type =']=$data['type'];
				}
				if ($parametro=="l1"){
					$data['filtro1'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_1 =']=$data['filtro1'];
				}
				if ($parametro=="l2"){
					$data['filtro2'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_2 =']=$data['filtro2'];
				}
				if ($parametro=="l3"){
					$data['filtro3'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_3 =']=$data['filtro3'];
				}
				if ($parametro=="l4"){
					$data['filtro4'] = substr($cadena_separa[$i],2,5);
					$parametros['Filter_4 =']=$data['filtro4'];
				}
			}
		}else{
			if(!empty($_POST['start_date']) or !empty($_POST['end_date'])){
				$data['start_date'] = $_POST['start_date'];
		        $data['end_date'] = $_POST['end_date'];
				$data['start_date_h']=substr($_POST['start_date'],6,4).'-'.substr($_POST['start_date'],3,2).'-'.substr($_POST['start_date'],0,2)." 00:00:00";
			    $data['end_date_h']=substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)." 23:59:59";
				$cadena="f1".$data['start_date'].'.'."f2".$data['end_date'];
				$parametros["Date >="]=$data['start_date_h'];
				$parametros["Date <="]=$data['end_date_h'];
			 }
			 if(!empty($_POST['proyecto'])){
			 	$data['project'] = $_POST['proyecto'];
			 	$cadena=$cadena.'.'."pr".$data['project'];
			 	$parametros['Id_Project =']=$data['project'];
			 }
			 if(!empty($_POST['filtro1'])){
			 	$data['filtro1'] = $_POST['filtro1'];
			 	$cadena=$cadena.'.'."l1".$data['filtro1'];
			 	$parametros['Filter_1 =']=$data['filtro1'];
			 }
			 if(!empty($_POST['filtro2'])){
			 	$data['filtro2'] = $_POST['filtro2'];
			 	$cadena=$cadena.'.'."l2".$data['filtro2'];
			 	$parametros['Filter_2 =']=$data['filtro2'];
			 }
			 if(!empty($_POST['filtro3'])){
			 	$data['filtro3'] = $_POST['filtro3'];
			 	$cadena=$cadena.'.'."l3".$data['filtro3'];
			 	$parametros['Filter_3 =']=$data['filtro3'];
			 }
			 if(!empty($_POST['filtro4'])){
			 	$data['filtro4'] = $_POST['filtro4'];
			 	$cadena=$cadena.'.'."l4".$data['filtro4'];
			 	$parametros['Filter_4 =']=$data['filtro4'];

			 }
			 if(!empty($_POST['tipo'])){
			 	$data['type'] = $_POST['tipo'];
			 	$cadena=$cadena.'.'."ti".$data['type'];
			 	$parametros['type =']=$data['type'];
			 }
		}
		if (($data['role_name']!="Admin")  and ($data['role_name']!="Cato") and empty($data['project'])){
		 	$parametros['Id_Principal =']=$data['id_principal'];
		}

       	$config['uri_segment'] = 4;
        $this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/datos/consulta_control/'.$cadena."/";
		$config['per_page'] = '10';
        $config['first_link'] = 'Primero';
        $config['last_link'] = '&Uacute;ltimo';
		$config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
		$this->load->model('scdobs_model');
		$config['total_rows'] = $this->scdobs_model->get_observaciones_avanzada_num($parametros);
	    $cadena_consulta=$cadena.".".$config['per_page'].".".$this->uri->segment(4);
	    $data['num_observaciones']=$config['total_rows'];
        $data['resultados'] = $this->scdobs_model->get_observaciones_avanzada($parametros,$config['per_page'],$this->uri->segment(4));

        $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);
		$this->pagination->initialize($config);
		$this->load->view('datos/consulta_view', $data);
	}

/////////////////////////////////////// Consulta ///////////////////////////////////
	function proyectos2()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Datos de proyectos";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/proyectos2';
       $config['total_rows'] = $this->db->count_all('projects');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');

       $data['results'] = $this->scdobs_model->get_proyectos2($config['per_page'],$this->uri->segment(3));

       // load the HTML Table Class
       //$this->load->library('table');
       //$this->table->set_heading('ID','DescripciÃ³n','Inicio','FIn','Colaborador');

       // load the view
	   $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);
       //date_default_timezone_set('America/Caracas');

       $this->load->view('datos/proyectos_view2', $data);
	}


/////////////////////////////////////// Consulta de Proyectos///////////////////////////////////
	function proyectos()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla de Proyectos";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/proyectos';
       $config['total_rows'] = $this->db->count_all('projects');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');

       $data['results'] = $this->scdobs_model->get_proyectos2($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Descripci&oacute;nnn','Inicio','Fin','Investigador');

       // load the view

       //date_default_timezone_set('America/Caracas');

       $this->load->view('datos/proyectos_view', $data);
	}



//////////////////////////////////////// Consulta de Filtros//////////////////////////////////
	function filtros()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla de Filtros";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/filtros';
       $config['total_rows'] = $this->db->count_all('filters');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_filtros($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Filtro');

       // load the view
       $this->load->view('datos/filtros_view', $data);

	}

//////////////////////////////////////// Consulta de Filtros//////////////////////////////////
	function filtros2()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Datos de Filtros";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/filtros2';
       $config['total_rows'] = $this->db->count_all('filters');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_filtros2($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Filtro');

       // load the view
       $this->load->view('datos/filtros_view2', $data);

	}

//////////////////////////////////////// Consulta de Dedos de la Camara (Finger)//////////////////////////////////
	function dedos()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla de Dedos de la C&aacute;mara";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/dedos';
       $config['total_rows'] = $this->db->count_all('fingers');
       $data['total_rows']=$config['total_rows'];
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['per_page'] = '10';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_dedos($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Dedo');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Consulta de Instituciones//////////////////////////////////
	function instituciones()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla de Instituciones";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/dedos';
       $config['total_rows'] = $this->db->count_all('institutions');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
	   $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_instituciones($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Instituci&oacute;n');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}


//////////////////////////////////////// Razones del Tiempo Perdido//////////////////////////////////
	function reason()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tabla Razones del Tiempo Perdido";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/reason';
       $config['total_rows'] = $this->db->count_all('reasonstimelost');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_reason($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Raz&oacute;n');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Comentarios del Cielo//////////////////////////////////
	function cielo()
	{

       $data['title'] = "SCDObsCIDA";
       $data['heading'] = "Comentarios del Cielo";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/cielo';
       $config['total_rows'] = $this->db->count_all('sky');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_cielo($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('ID','Comentario');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Seriales de Cintas//////////////////////////////////
	function seriales()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Seriales de Cintas";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/seriales';
       $config['total_rows'] = $this->db->count_all('tapesserials');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_seriales($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Serial','Ubicaci&oacute;n');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}


//////////////////////////////////////// Tipos de Observaciones//////////////////////////////////
	function tiposobservacion()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tipos de Observaciones";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/tiposobservacion';
       $config['total_rows'] = $this->db->count_all('types');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_tiposobservacion($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Conjunto','Id','Tipo de Observaci&oacute;n','Exposici&oacute;n por Defecto');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}


//////////////////////////////////////// Tipos de Actividades//////////////////////////////////
	function tiposactividad()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tipos de Actividad";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/tiposactividad';
       $config['total_rows'] = $this->db->count_all('typesofactivity');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_tiposactividad($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Id','Tipo de Actividad');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}


//////////////////////////////////////// Direcciones del Viento//////////////////////////////////
	function direccionviento()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Direcciones del Viento";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/direccionviento';
       $config['total_rows'] = $this->db->count_all('winddirs');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_direccionviento($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Id','Direcci&oacute;n');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Vientos//////////////////////////////////
	function vientos()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Vientos";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/vientos';
       $config['total_rows'] = $this->db->count_all('winds');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_vientos($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Id','Viento');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Tipos Colaboradores//////////////////////////////////
	function tiposcolaboradores()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Tipos de Colaboradores";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/tiposcolaboradores';
       $config['total_rows'] = $this->db->count_all('workertypes');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_tiposcolaboradores($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Id','Tipo de Colaborador');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}

//////////////////////////////////////// Colaboradores//////////////////////////////////
	function colaboradores()
	{

       $data['title'] = "SCDObs CIDA";
       $data['heading'] = "Colaboradores";
// Check if user is logged in or not
		$data['role_name'] = $this->dx_auth->get_role_name();
		$data['username'] = $this->dx_auth->get_username();
		$data['id_principal'] = $this->dx_auth->get_user_id_principal();

		$data['title'] = "SCDObs CIDA";

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
       $config['base_url'] = base_url().'index.php/datos/colaboradores';
       $config['total_rows'] = $this->db->count_all('workforce');
       $data['total_rows']=$config['total_rows'];
       $config['per_page'] = '10';
       $config['first_link'] = 'Primero';
       $config['last_link'] = '&Uacute;ltimo';
       $config['full_tag_open'] = '<p>';
       $config['full_tag_close'] = '</p>';

       $this->pagination->initialize($config);
	   //load the model and get results
       $this->load->model('scdobs_model');
       $data['results'] = $this->scdobs_model->get_colaboradores($config['per_page'],$this->uri->segment(3));

       $data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       // load the HTML Table Class
       $this->load->library('table');
       $this->table->set_heading('Instituci&oacute;n','Id','Apellido','Nombre','Tipo de Colaborador');

       // load the view
       $this->load->view('datos/datos_view', $data);

	}


	function genera_consulta(){
		$data['title'] = "Observatorio Virtual CIDA";
       $data['heading'] = "Generar consulta SQL de Observaciones";

       if(empty($_POST['start_date']) or empty($_POST['end_date']))
       {

       	  $data['banfecha']=false;
       	  $data['start_date'] = '01/02/2006';
          $data['end_date'] = '01/02/2006';

       	  $data['start_date_h'] = '2006-02-01';
          $data['end_date_h'] = '2006-02-01';

       } else {

          $data['banfecha']=true;
          $data['start_date'] = $_POST['start_date'];
          $data['end_date'] = $_POST['end_date'];

          $data['start_date_h']=substr($_POST['start_date'],6,4).'-'.substr($_POST['start_date'],3,2).'-'.substr($_POST['start_date'],0,2)."";
	      $data['end_date_h']=substr($_POST['end_date'],6,4).'-'.substr($_POST['end_date'],3,2).'-'.substr($_POST['end_date'],0,2)."";

       }

       if(empty($_POST['asc_recta']) or empty($_POST['asc_recta2']) or empty($_POST['declinacion']) or empty($_POST['declinacion2']))
       {
	      $data['asc_recta'] = 0;
          $data['asc_recta2'] = 0;
          $data['declinacion'] = 0;
          $data['declinacion2'] = 0;
          $data['bandatos']=false;

       } else {
          $data['asc_recta'] = $_POST['asc_recta'];
          $data['asc_recta2'] = $_POST['asc_recta2'];
          $data['declinacion'] = $_POST['declinacion'];
          $data['declinacion2'] = $_POST['declinacion2'];
          $data['bandatos']=true;
      }
      if (empty($_POST['consulta'])){
      	$data['consulta']='fecha';
      }
      else{
      	$data['consulta']=$_POST['consulta'];
      }

	  if (empty($_POST['tabla'])){
      	$data['tabla']='observaciones';
      }
      else{
      	$data['tabla']=$_POST['tabla'];
      }

//////////////// Verificar tabla y asignar nombre de campo segun tabla
	   if ($data['tabla']=='observaciones'){
			$asc='ra_inicial';
		   	$dec='dec_central';
	   }
	   if ($data['tabla']=='objetos'){
			$asc='asc_recta_prom';
		   	$dec='dec_prom';
	   }
	   if ($data['tabla']=='instancias_objeto'){
			$asc='asc_recta';
		   	$dec='declinacion';
	   }
	   		$data['mostrar'] = true;
///////////////// Verificar tipo de consulta, por fecha, por asc y dec, o por ambas
	   if ($data['consulta']=='fecha'){
//	   		$data['mostrar'] = true;
	     	$data['sql'] = 'SELECT * FROM '.$data['tabla'].' WHERE fecha>='."'".$data['start_date_h']."'".' and fecha<='."'".$data['end_date_h']."'".'';
	   } else {
	 	 	$data['mostrar'] = false;
	   }

	   if ($data['consulta']=='asc'){
		   	$data['mostrar'] = true;
	     	$data['sql'] = 'SELECT * FROM '.$data['tabla'].' WHERE '.$asc.'>='.$data['asc_recta'].' and '.$asc.'<='.$data['asc_recta2'].' and '.$dec.'>='.$data['declinacion'].' and '.$dec.'<='.$data['declinacion2'].'';
	   } else {
//	 	 	$data['mostrar'] = false;
	   }

	   if ($data['consulta']=='ambas'){
		   	$data['mostrar'] = true;
	     	$data['sql'] = 'SELECT * FROM '.$data['tabla'].' WHERE fecha>='."'".$data['start_date_h']."'".' and fecha<='."'".$data['end_date_h']."'".' and '.$asc.'>='.$data['asc_recta'].' and '.$asc.'<='.$data['asc_recta2'].' and '.$dec.'>='.$data['declinacion'].' and '.$dec.'<='.$data['declinacion2'].'';
	   } else {
//	 	 	$data['mostrar'] = false;
	   }

		$data['investigador'] = $this->scdobs_model->get_investigador($data['id_principal']);

       $this->load->view('genera_consulta_view', $data);
	}


    function crea_archivo(){
    	//$num_observacion=$_GET['num_observacion'];

    	$start1=$this->uri->segment(3);
	    $start2=$this->uri->segment(4);
	    $start3=$this->uri->segment(5);
		$desde=$start3."-".$start2."-".$start1;
	    //$data['start_date']=$start1."/".$start2."/".$start3;

	    $start4=$this->uri->segment(6);
	    $start5=$this->uri->segment(7);
	    $start6=$this->uri->segment(8);
		$hasta=$start6."/".$start5."/".$start4;

		$num_observacion=$this->uri->segment(9);

		$correo="jean.suescun@cida.ve";
		//$data['end_date']=$start4."/".$start5."/".$start6;

    	//$desde=$_GET['desde'];
    	//$hasta=$_GET['hasta'];
		//$correo=$_GET['correo'];

		$fecha_actual=date("d-m-Y");
		$nombrearchivo = "archivo_".$fecha_actual."_".rand().".txt";
		//$ruta="/home/jean/myCode/php/ovirtual/system/application/controllers/archivos/";
		$ruta="/var/www/html/ovirtual/archivosDownload/";
		$nombrecompleto=$ruta.$nombrearchivo;
		//$consulta=$objempleado->consultarinstancias1($num_observacion,$fecha);
		$this->load->model('ovirtual_model');
        $query = $this->ovirtual_model->get_observaciones_todos();
        $ar=fopen($nombrecompleto,"w") or
		die("Problemas en la creacion");
		//fputs($ar,"Numero de Observacion: $num_observacion \t Fecha: $desde \r\n");
		fputs($ar," Fecha \t  Num_observacion \t Hora inicio \t Ra_inicial \t Dec_central \t Num_cuadros \t Id_calidad\r\n");
		foreach ($query->result() as $fila)
		{
		     $num_observacion=$fila->num_observacion;
		     $fecha=$fila->fecha;
		     $hora_inicio=$fila->hora_inicio;
		     $ra_inicial=$fila->ra_inicial;
		     $dec_central=$fila->dec_central;
		     $num_cuadros=$fila->num_cuadros;
		     $id_calidad=$fila->id_calidad;
		     fputs($ar," $fecha  \t  $num_observacion  \t  $hora_inicio  \t  $ra_inicial  \t  $dec_central  \t  $num_cuadros  \t  $id_calidad \r\n");
		}
		  $asunto="Consulta BDVar";
		  $cuerpo="http://localhost/ovirtual/archivosDownload/?f=".$nombrearchivo;
		  mail($correo,$asunto,$cuerpo,"FROM: CIDA");
		  echo $nombrecompleto;
   }


}
