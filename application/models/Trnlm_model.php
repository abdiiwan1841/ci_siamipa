<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class trnlm_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('trnlm');
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

   public function getnm($sem,$nim,$kd)
   {
     $data = $this->getdata("nimhstrnlm='$nim' and thsmstrnlm='$sem' and kdkmktrnlm='$kd'");
     $txt='';
     if($this->numrows>0){
       $txt=$data[0]['nlakhtrnlm'];
     }
     return $txt;
   }

  function getriwayatsks($thn,$nim)
  {
    
    $select = 'thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestbkmk,wp';
    $from  = 'trnlm INNER JOIN tbkmk ON kdkmktrnlm=kdkmktbkmk';

    $sql ="select sum(sksmktbkmk) as jml from (select $select from $from) a where thsmstrnlm='$thn' and nimhstrnlm='$nim' and kdkmktrnlm not like 'MATP%'";    
    $query = $this->db->query($sql);
    $data = $query->result_array();
    
    $jml_sks=0;
    if(!empty($data))
    {      
        $jml_sks=$data[0]['jml']; 
    }
    
    return $jml_sks;
  }

  function getmtk1($thnsms,$nim)
  { 
    $select = 'thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestbkmk,wp,semestrnlm,kelastrnlm,tgl_input';
    $from  = 'trnlm INNER JOIN tbkmk ON kdkmktrnlm=kdkmktbkmk';    

    $sql  = "select thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestrnlm,kelastrnlm,semestbkmk,wp,tgl_input from (select $select from $from) a where thsmstrnlm='$thnsms' and nimhstrnlm='$nim' order by semestbkmk,kdkmktrnlm";
    
    $query = $this->db->query($sql);
    $data = $query->result_array();
    return $data;     
  } 


}