<?php
/*
 * Created on May 3, 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

  class administrator_model extends Model {
  function __construct(){
    parent::Model();
  }

  function get_users($num, $offset)
  {
    $this->db->select('users.id,username,nombres,apellidos,email,name');
    $this->db->order_by('users.id', 'ASC');
    $this->db->from('users');
    $this->db->join('roles', 'roles.id = users.role_id');
    //$this->db->join('workforce', 'workforce.id = users.Id_Principal');
    $this->db->limit($num, $offset);
    $query = $this->db->get();
    return $query;
  }

  function get_user_by_id($id='0')
  {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
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

  function drop_menu_investigadores()
  {
      $this->db->select('id,lastn,firstn');
      $this->db->order_by('lastn', 'ASC');
      $query=$this->db->get('workforce');
      $result = $query->result();
      $drop_menu_example_cats = array();
          $options[''] = 'Sin ID' ;
      foreach($result as $item){
        $options[$item->id] = $item->lastn.", ". $item->firstn;
      }
      return $options;
    }

    function drop_menu_roles()
    {
      $this->db->select('id,name');
      $this->db->order_by('name', 'ASC');
      $query=$this->db->get('roles');
      $result = $query->result();
      $drop_menu_example_cats = array();
      //$options[''] = 'seleccione uno' ;
      foreach($result as $item){
        $options[$item->id] = $item->name;
      }
      return $options;
    }

}

?>
