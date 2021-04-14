<?php
/*
 * Created on May 3, 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

  class system_model extends Model {
  function __construct(){
    parent::Model();
  }

//////////////////// VEHICULOS
  function get_vehiculos() {

   $query = $this->db->get('vehiculos');
   return $query->result();
  }

   function get_vehiculo_by_id($numero='0')
    {
        $this->db->where('numero', $numero);
        $query = $this->db->get('vehiculos');
        return $query->row();
    }

    function get_vehiculo_by_id_historial($numero='0')
    {
        $this->db->where('numero', $numero);
        $this->db->where('estado', "Accidentado");
        $query = $this->db->get('vehiculos_historial');
        return $query->result();
        //return $query->row();
    }
    function get_vehiculo_by_id_suspendido($numero='0')
    {
        $this->db->where('numero', $numero);
        $this->db->where('estado', "Suspendido");
        $query = $this->db->get('vehiculos_historial');
        return $query->result();
        //return $query->row();
    }

   function get_vehiculos_select() {
   $this->db->select('numero');
   $this->db->order_by('numero','ASC');
   $query = $this->db->get('vehiculos');
   $result=$query->result();
   foreach($result as $item){
   		$options[$item->numero]="&nbsp;".$item->numero."&nbsp;";
   }
   return $options;
  }

  function get_vehiculos_select_libres() {
   //consulta todos los vehiculos
   $this->db->select('numero');
   $this->db->order_by('numero','ASC');
   $this->db->where('estado', 'Activo');
   $query = $this->db->get('vehiculos');
   $result=$query->result();

   //consulta los vehiculos trabajando
   $this->db->select('numero_vehiculo');
   $this->db->order_by('numero_vehiculo','ASC');
   $query2 = $this->db->get('control');
   $result2=$query2->result();

   //Compara vehiculos trabajando contra todos los vehiculos
   foreach($result as $item){
   		$ban="no";
   		foreach($result2 as $item2){
   			if($item->numero==$item2->numero_vehiculo){
   				//$options[$item->numero]="&nbsp;".$item->numero."&nbsp;";
   				$ban="si";
   				break;
   			}
   		}
   		$options[""]="--SELECCIONE--";
   		if($ban=="no"){
   			$options[$item->numero]="&nbsp;".$item->numero."&nbsp;";
   		}
   }
   return $options;
  }

//////////////////// PERSONAS
  function get_personas() {
	$this->db->order_by("numero_vehiculo");
   	$query = $this->db->get('personas');
   	return $query->result();
  }

   function get_persona_by_id($cedula='0')
    {
        $this->db->where('cedula', $cedula);
        $query = $this->db->get('personas');
        return $query->row();
    }



///////////////////// CONTROL

  function get_control() {
   $this->db->order_by("codigo_punto");
   $this->db->order_by("orden_hora");
   $query = $this->db->get('control');
   return $query->result();
  }
  function get_control1() {
   $this->db->order_by("orden_hora");
   $query = $this->db->get('control');
   return $query->result();
  }
  function get_control_by_id($numero='0')
    {
        $this->db->where('numero_vehiculo', $numero);
        $query = $this->db->get('control');
        return $query->row();
    }


///////////////////// CARRERAS

  function get_carreras() {
   //$this->db->order_by("codigo_carrera","DESC");
   //$query = $this->db->get('carreras',$num,$offset);
   $sql="select carreras.codigo_carrera, carreras.numero_vehiculo, carreras.codigo_origen, carreras.codigo_destino, carreras.fecha_hora, personas.nombre from carreras, personas where conductor=cedula order by codigo_carrera DESC";
   $query=$this->db->query($sql);
   //$query = $this->db->get('preguntas',$num,$offset);

   return $query->result();
  }

  function get_conductores_select($numero_vehiculo) {
	// echo "estudipo";
  		/*$this->db->where('numero_vehiculo', $numero_vehiculo);
        $query = $this->db->get('carreras');*/

  		$this->db->select('*');
		$this->db->order_by('cedula', 'ASC');
		$query = $this->db->get_where('personas', array('numero_vehiculo ='=>$numero_vehiculo));
		$result = $query->result();
		return $result;
	}

	function get_conductores2_select($conductor) {
		$this->db->select('*');
		$query = $this->db->get_where('personas', array('cedula ='=>$conductor));
		$result = $query->result();
		//return $options;
		return $query->row();
	}

///////////////////// CONSULTAS

  function get_consultas($numero_vehiculo,$fecha_desde,$fecha_hasta) {
   //$this->db->order_by("codigo_carrera","DESC");
   //$query = $this->db->get_where('carreras', array('numero_vehiculo ='=>$numero_vehiculo,'fecha_hora >='=>$fecha_desde,'fecha_hora <='=>$fecha_hasta));

   $sql="select carreras.codigo_carrera, carreras.numero_vehiculo, carreras.codigo_origen, carreras.codigo_destino, carreras.fecha_hora, personas.nombre from carreras, personas where conductor=cedula and carreras.numero_vehiculo=$numero_vehiculo and fecha_hora>='$fecha_desde' and fecha_hora<='$fecha_hasta' order by codigo_carrera DESC";
   $query=$this->db->query($sql);
   //$query = $this->db->get('carreras');

   //$query = $this->db->get('preguntas',$num,$offset);

   return $query->result();
  }


////////////////////ACCIDENTADOS
  function get_vehiculos_accidentados() {
   $this->db->where('estado', 'Accidentado');
   $query = $this->db->get('vehiculos');
   return $query->result();
  }

////////////////////SUSPENDIDOS
  function get_vehiculos_suspendidos() {
   $this->db->where('estado', 'Suspendido');
   $query = $this->db->get('vehiculos');
   return $query->result();
  }


////////////////////VIAJANDO
  function get_vehiculos_viajando() {
   $this->db->where('estado', 'De viaje');
   $query = $this->db->get('vehiculos');
   return $query->result();
  }










   function get_consulta_pregunta($id_pregunta)  {

    //$query = $this->db->get('preguntas');


	$sqlobjetos = "select count(*) as nro_reg3 from respuestas where id_pregunta='$id_pregunta'";
	$datos_objetos = $this->db->query($sqlobjetos);
    $resumen3 = $datos_objetos->result();

	foreach ($resumen3 as $row)
       {
            $data = $row->nro_reg3;
       }
	if($data==0){
		$query = $this->db->get_where('preguntas', array('id_padre ='=>$id_pregunta));
	}else{
		$query = $this->db->get_where('respuestas', array('id_pregunta ='=>$id_pregunta));
	}

    return $query->result();
  }


  function get_consulta_cadena($id_pregunta) {


	$separa=explode(".",$id_pregunta);
	$cadena=str_replace(".","",$id_pregunta);
	$len=strlen($cadena);
	$id_padre="";
	$cadena_completa="";
	$cont=0;
	$espacios="";
	for ($i = 0; $i <= $len-1; $i++) {
		if ($id_padre==""){
			$id_padre=$separa[$i];
		}else{
			$id_padre=$id_padre.".".$separa[$i];
		}
			$query = $this->db->get_where('preguntas', array('id_pregunta ='=>$id_padre));
			$consulta=$query->result();

			foreach ($consulta as $row){
				$cont=$cont+1;
				for ($j = 0; $j <= $cont; $j++) {
					$espacios=$espacios."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}

				$cadena_completa=$cadena_completa." <tr><td><font color='#000000' size='2'>".$espacios."/ ".anchor('/datos/consulta_pregunta/'.$row->id_pregunta, $row->id_pregunta."- ".$row->pregunta);
			}
		//$query = $this->db->get_where('preguntas', array('id_padre ='=>$id_pregunta));
	}

	/*foreach($result as $item){
          $options = $item->FirstN." ".$item->LastN;
		  $query = $this->db->get_where('preguntas', array('id_padre ='=>$id_pregunta));
    }
	*/
    return $cadena_completa;
  }

  function get_preguntas_list($num,$offset) {

    $query = $this->db->get('preguntas',$num,$offset);
    return $query->result();
  }

  function get_pregunta_by_id($id_pregunta='0')
    {
        $this->db->where('id_pregunta', $id_pregunta);
        $query = $this->db->get('preguntas');
        return $query->row();
    }

   function get_respuestas_list($num,$offset) {

    $query = $this->db->get('respuestas',$num,$offset);
    return $query->result();
  }
  function get_respuesta_by_id($id_respuesta='0')
    {
        $this->db->where('id_respuesta', $id_respuesta);
        $query = $this->db->get('respuestas');
        return $query->row();
    }


  function registro_fallas($falla,$titulo,$fecha,$hora,$usuario) {

    $this->db->insert('fallas', array('descripcion_falla'=>$falla,'titulo'=>$titulo,'fecha'=>$fecha,'hora'=>$hora,'usuario'=>$usuario));
    return;
  }

  function get_fallas($num,$offset) {

    $query = $this->db->get('fallas',$num,$offset);
    return $query->result();
  }

  function cambiar_falla($id) {
  	$estatus="Solucionado";
	$data=array('estatus'=>$estatus);
    $query = $this->db->where('id_falla',$id);
	$query = $this->db->update('fallas',$data);
    return;
  }

  function reportar_fallas($id_pregunta,$fecha,$usuario) {


	//$sql = "insert into reporte_fallas (id_pregunta,fecha,usuario) values('$id_pregunta','$fecha','$usuario')";
	//$this->db->query($sql);

    $query=$this->db->insert('reporte_fallas', array('id_pregunta'=>$id_pregunta,'fecha'=>$fecha,'usuario'=>$usuario));
	$query2=$this->db->delete('reporte_fallas', array('id_pregunta'=>'images'));
    return;
  }

  function get_reporte_fallas($num,$offset) {
	$sql = "select * from reporte_fallas as rf, preguntas as p where rf.id_pregunta=p.id_pregunta order by rf.id_pregunta";
	$query=$this->db->query($sql);
    //$query = $this->db->get('reporte_fallas',$num,$offset);
    return $query->result();
  }






  function get_personal($num,$offset) {

    $query = $this->db->get('personal',$num,$offset);
    return $query->result();
  }

  function get_proveedores($num,$offset) {

    $query = $this->db->get('proveedores',$num,$offset);
    return $query->result();
  }

  function get_materiales($num,$offset) {

    $query = $this->db->get('materiales',$num,$offset);
    return $query->result();
  }
  function get_herramientas($num,$offset) {

    $query = $this->db->get('herramientas',$num,$offset);
    return $query->result();
  }
  function get_equipos($num,$offset) {

    $query = $this->db->get('equipos',$num,$offset);
    return $query->result();
  }









	function get_observaciones($num, $offset) {

       $this->db->order_by("Date");
    	$query = $this->db->get('observations_id_view', $num, $offset);
    	return $query;
  }

  function get_observacion2($parametros) {
    	$query = $this->db->get_where('observations', $parametros);
    	return $query;
  }

  function get_archivo($parametros) {
  		$this->db->order_by("Date");
    	$query = $this->db->get_where('observations_id_view', $parametros);
    	return $query;
  }

  function get_observacion_noche($fecha, $num, $offset){

    	$query = $this->db->get_where('observations', array('Date ='=>$fecha), $num, $offset);
    	//$query = $this->db->get_where('observations', $fecha, $num, $offset);
    	return $query;
  }

  function get_observacion_noche_num($fecha) {

	//$this->db->select('*');
	//$this->db->select('Date');
	$this->db->from('observations');
	$this->db->where($fecha);
	return $this->db->count_all_results();

  }

  function get_observaciones_avanzada_num($parametros) {

	//$this->db->select('*');
	//$this->db->select('Date');
	$this->db->from('observations_id_view');
	$this->db->where($parametros);
	return $this->db->count_all_results();

  }

  function get_observaciones_avanzada($cadena,$num, $offset) {
    $query = $this->db->get_where('observations_id_view', $cadena,$num, $offset);
    return $query;
  }

  function get_investigador($id){
    	$this->db->select('LastN,FirstN');
        $query = $this->db->get_where('workforce', array('Id ='=>$id));
        $result = $query->result();
        foreach($result as $item){
          $options = $item->FirstN." ".$item->LastN;
        }
        return $options;
  }

  function get_proyectos($num, $offset) {

        $this->db->select('projects.Id,Description,Date_Begin,Date_End,LastN,FirstN');
        $this->db->from('projects');
        $this->db->join('workforce', 'workforce.id = projects.id_principal');
        $this->db->limit($num, $offset);
        $query = $this->db->get();

	return $query;

  }

  function get_proyectos2($num, $offset) {

        $this->db->from('projects_view');
        $this->db->limit($num, $offset);
        $query = $this->db->get();

	return $query;

  }

  function get_filtros2($num, $offset) {

        $this->db->from('filters');
        $this->db->limit($num, $offset);
        $query = $this->db->get();

	return $query;

  }


  function get_filtros($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('filters', $num, $offset);
    return $query;
  }

  function get_filtros_select() {
  		$this->db->select('Id,Filter');
        $this->db->order_by('Id', 'ASC');
        $query=$this->db->get('filters');
        $result = $query->result();
        $filtros = array();
        $options[''] = 'Seleccionar filtro' ;
        foreach($result as $item){
          $options[$item->Id] = $item->Filter;
        }
        return $options;
  }

  function get_proyectos_select() {
  		$this->db->select('Id,Description');
        $this->db->order_by('Description', 'ASC');
        $query=$this->db->get('projects');
        $result = $query->result();
        $proyectos = array();
        $options[''] = 'Seleccionar Proyecto' ;
        foreach($result as $item){
          $options[$item->Id] = $item->Description;
        }
        return $options;
  }
  function get_proyectos_principal_select($principal) {
  		//$this->db->order_by("fecha");
    	//$query = $this->db->get_where('observaciones', array('Id_Principal ='=>$principal));

  		$this->db->select('Id,Description');
        $this->db->order_by('Description');
        //$query=$this->db->get('projects');
        $query = $this->db->get_where('projects', array('Id_Principal ='=>$principal));
        $result = $query->result();
        $proyectos = array();
        $options[''] = 'Seleccionar Proyecto' ;
        foreach($result as $item){
          $options[$item->Id] = $item->Description;
        }
        return $options;
  }

  function get_observadores_select() {
  		$this->db->select('Id,LastN,FirstN');
        $this->db->order_by('LastN', 'ASC');
        $query=$this->db->get('workforce');
        $result = $query->result();
        $observadores = array();
        $options[''] = 'Seleccionar Observador' ;
        foreach($result as $item){
          $options[$item->Id] = $item->LastN.", ".$item->FirstN;
        }
        return $options;
  }

  function get_tipos_select() {
  		$this->db->select('Id,Type');
        $this->db->order_by('Type', 'ASC');
        $query=$this->db->get('types');
        $result = $query->result();
        $tipos = array();
        $options[''] = 'Seleccionar Tipo' ;
        foreach($result as $item){
          $options[$item->Id] = $item->Type;
        }
        return $options;
  }

  function get_cielo_select() {
  		$this->db->select('Id,SkyComment');
        $this->db->order_by('SkyComment', 'ASC');
        $query=$this->db->get('sky');
        $result = $query->result();
        $cielo = array();
        $options[''] = 'Seleccionar Comentario' ;
        foreach($result as $item){
          $options[$item->Id] = $item->SkyComment;
        }
        return $options;
  }


  function get_dedos($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('fingers', $num, $offset);
    return $query;
  }

  function get_instituciones($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('institutions', $num, $offset);
    return $query;
  }

  function get_reason($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('reasonstimelost', $num, $offset);
    return $query;
  }

  function get_cielo($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('sky', $num, $offset);
    return $query;
  }

  function get_seriales($num, $offset) {
    //$this->db->order_by("Serial");
    //$query = $this->db->get('tapesserials', $num, $offset);

    $this->db->select('Serial,Institution');
    $this->db->from('tapesserials');
    $this->db->join('institutions', 'institutions.id = tapesserials.location');
    $this->db->limit($num, $offset);
    $query = $this->db->get();
    return $query;
  }

  function get_tiposobservacion($num, $offset) {
    $this->db->order_by("Set");
    $query = $this->db->get('types', $num, $offset);
    return $query;
  }

  function get_tiposactividad($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('typesofactivity', $num, $offset);
    return $query;
  }

  function get_direccionviento($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('winddirs', $num, $offset);
    return $query;
  }

  function get_vientos($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('winds', $num, $offset);
    return $query;
  }

  function get_tiposcolaboradores($num, $offset) {
    $this->db->order_by("Id");
    $query = $this->db->get('workertypes', $num, $offset);
    return $query;
  }

  function get_colaboradores($num, $offset) {
    //$this->db->order_by("Institution");
    //$query = $this->db->get('workforce', $num, $offset);

    $this->db->select('institutions.Institution,workforce.Id,LastN,FirstN,workertypes.WorkerType');
    $this->db->from('workforce');
    $this->db->join('institutions', 'institutions.id = workforce.institution');
    $this->db->join('workertypes', 'workertypes.id = workforce.workertype');
    $this->db->limit($num, $offset);
    $query = $this->db->get();

    return $query;
  }

  function get_observacion($num,$offset,$desde,$hasta) {
  	//$sqlobservaciones = "select * from observaciones where fecha >='".$desde."' and fecha <='".$hasta."' order by fecha";
	//$query = $this->db->query($sqlobservaciones);
	$this->db->order_by("fecha");
    $query = $this->db->get_where('observaciones', array('fecha >='=>$desde,'fecha <='=>$hasta), $num, $offset);
    //$query = $this->db->get('observaciones', $num, $offset);
    //$this->db->order_by("time", "desc");
    //$query = $this->db->get('observaciones', $num, $offset);
    return $query;
  }

  function get_observaciones_todos() {

  	//$sqlobservaciones = "select * from observaciones where fecha >='".$desde."' and fecha <='".$hasta."' order by fecha";
	//$query = $this->db->query($sqlobservaciones);
	$this->db->order_by("fecha");
    $query = $this->db->get('observaciones');
    //$this->db->order_by("time", "desc");
    //$query = $this->db->get('observaciones', $num, $offset);
    return $query;
  }

  function get_instancias_objeto($num, $desde, $hasta) {
  	$sqlinstancias = "select * from instancias_objeto where fecha >='".$desde."' and fecha <='".$hasta."' order by fecha";
	$query = $this->db->query($sqlinstancias);

    //$this->db->order_by("time", "desc");
    //$query = $this->db->get('instancias_objeto', $num, $offset);
    return $query;
  }

  function get_objeto($num, $offset) {
    $this->db->order_by("id_objeto");
    $query = $this->db->get('objetos', $num, $offset);
    return $query;
  }

  function getTinToutDia($dia) {
    $this->db->select("time,tin,tout");
	$this->db->like('time', $dia.'%');

	return $this->db->get('instancias_objeto');
  }

  function getTinToutFecha($desde,$hasta) {
    $this->db->select("time,tin,tout");
	$this->db->like('time', $desde.'%');

	return $this->db->get('instancias_objeto');

  }

  function get_objetos() {
    $sqlobjetos = "select count(*) as nro_reg3 from objetos";
	$datos_objetos = $this->db->query($sqlobjetos);
    $resumen3 = $datos_objetos->result();

	foreach ($resumen3 as $row)
       {
            $data = $row->nro_reg3;
       }
    return $data;
  }

  /*function get_observaciones($desde,$hasta,$asc_recta,$asc_recta2,$declinacion,$declinacion2,$consulta) {
  	if ($consulta=='fecha'){
		$sqlobservaciones = "select count(*) as nro_reg2 from observaciones where fecha >='".$desde."' and fecha <='".$hasta."'";
		$datos_observaciones = $this->db->query($sqlobservaciones);
	    $resumen1 = $datos_observaciones->result();
  	}
  	if ($consulta=='asc'){
  		$sqlobservaciones = "select count(*) as nro_reg2 from observaciones where ra_inicial >='".$asc_recta."' and ra_inicial <='".$asc_recta2."' and dec_central >='".$declinacion."' and dec_central <='".$declinacion2."'";
		$datos_observaciones = $this->db->query($sqlobservaciones);
	    $resumen1 = $datos_observaciones->result();
  	}
  	if ($consulta=='ambas'){
  		$sqlobservaciones = "select count(*) as nro_reg2 from observaciones where fecha >='".$desde."' and fecha <='".$hasta."' and ra_inicial >='".$asc_recta."' and ra_inicial <='".$asc_recta2."' and dec_central >='".$declinacion."' and dec_central <='".$declinacion2."'";
		$datos_observaciones = $this->db->query($sqlobservaciones);
	    $resumen1 = $datos_observaciones->result();
  	}

	foreach ($resumen1 as $row)
       {
            $data = $row->nro_reg2;
       }    $sqlinstancias = "select count(*) as nro_reg from instancias_objeto where fecha >='".$desde."' and fecha <='".$hasta."'  ";
    $datos_resumen = $this->db->query($sqlinstancias);


    return $data;
  }*/

/*  function get_instancias($desde,$hasta) {
    $sqlinstancias = "select count(*) as nro_reg from instancias_objeto where fecha >='".$desde."' and fecha <='".$hasta."'  ";
    $datos_resumen = $this->db->query($sqlinstancias);
	$resumen = $datos_resumen->result();
	foreach ($resumen as $row)
       {
            $data = $row->nro_reg;
       }
    return $data;
  }
*/
  function get_noches($desde,$hasta,$num,$offset) {
     //    $sqlinstancias = "select * from obsnight where Date >='".$desde."' and Date <='".$hasta."' order by Date";
    //	$query = $this->db->query($sqlinstancias);
	//$query = $this->db->get_where('obsnight', array('Date >='=>$desde,'Date <='=>$hasta), $num, $offset);
	$query = $this->db->get_where('obsnight', array('Date >='=>$desde,'Date <='=>$hasta), $num, $offset);

    return $query;
  }
  function get_noches_num($desde,$hasta) {
    $sqlinstancias = "select count(*) as nro_reg from obsnight where Date >='".$desde."' and Date <='".$hasta."' order by Date";
    $datos_resumen = $this->db->query($sqlinstancias);

    $resumen = $datos_resumen->result();
	foreach ($resumen as $row)
       {
            $data = $row->nro_reg;
       }
    return $data;
  }

}

//http://jean/ovirtual/index.php/datos/instancias_objetos/21/12/1999/01/02/2006



?>
