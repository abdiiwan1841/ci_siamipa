<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('staff');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   } 

   function isuserexist($user,$pass)
  {
     $where = "user_id='$user' AND pass='$pass'";   
     $this->getdata($where);
     return  $this->numrows>0;   
  }  

  function gethak($user)
  {
   $where = "user_id='$user'";  
   $data=$this->getdata($where);
     
   $hak =0;
   if($this->numrows>0)
   {
     foreach($data as $row)
     {
       $hak = $row['hak_akses'];
     }
   }
   
   return  $hak;   
  }

  function getnm($user)
  {
   $where = "user_id='$user'";  
   $data=$this->getdata($where);
     
   $hak =0;
   if($this->numrows>0)
   {
     foreach($data as $row)
     {
       $hak = $row['nm_user'];
     }
   }
   
   return  $hak;   
  }

}