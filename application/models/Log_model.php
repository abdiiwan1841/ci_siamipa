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
      $this->db->order_by('lg_time desc');
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();        
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

   function logintime($id)
   {
      $data = $this->getdata('season_id="'.$id.'" and (DATE(lg_time)=DATE(NOW()) AND ISNULL(out_time))AND (TIMESTAMPDIFF(MINUTE,lg_time,NOW())<30)');
       return ($this->numrows>0);
   } 

   function getlstlgn($tg)
   {
      
      $header = array(array('No','Log In Time','Log Out Time','User','IP Address','Alamat'));
      $tbstat = array("id" => "lst_lg",'width'=>'100%');
      
      $data = $this->getdata("tg=$tg");
      $isi_data = array();
      if($this->numrows>0)
      {  $i=1;
         foreach ($data as $row) {
             $tmp = array();
             $tmp[]=array($i++,array());
             $tmp[]=array($row['lg_time'],array());
             $tmp[]=array($row['out_time'],array());
             $tmp[]=array($row['user'],array());
             $tmp[]=array($row['net_id'],array());
             $tmp[]=array($row['alamat'],array()); 
             $isi_data[] = $tmp; 
         }  
      }
      $tbl = new mytable($tbstat,$header,$isi_data,'');
      return $tbl->display();
   }  

}