<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

   public $numrows;
   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('log');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        foreach($this->query->result_array() as $row)
        {
           $hsl[]=$row;
        }
      }
      return $hsl; 
   }  

   function islogin($user,$idx)
   {
     $data = $this->getdata("USER='".$user."' AND (NOT ISNULL(lg_time) AND DATE(lg_time)=DATE(NOW())) AND ISNULL(out_time) AND tg=".$idx);
     return $this->numrows>0;
   }

    public function insertdata($data)
   {        
     $this->db->insert('log',$data);
   }

    public function updatedata($data)
   {        
     $this->db->set('out_time', $data['out_time']);
     $this->db->where('season_id',$data['season_id']);
     $this->db->where('user',$data['user']);
     $this->db->update('log');
   }   

}