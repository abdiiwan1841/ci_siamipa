<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpoll_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tbmpoll');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('thsmsmpoll,nimhsmpoll');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }    
      return $hsl; 
   }

   public function insertdata($data)
   {
      $this->db->insert('tbmpoll',$data);
   }


 }