<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stat_mhs_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('stat_mhs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('thnsmsstat_mhs,nimstat_mhs');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   }

   private function stattostr($kd)
   {
     switch($kd)
      {
      case 0 : return "Non Status";break;
      case 1 : return "Aktif";break;
      case 2 : return "Cuti";break;
      case 3 : return "DO";break;
      case 4 : return "Keluar";break;
      case 5 : return "Lulus";break;
      case 6 : return "Non Aktif";break;
      }   
   }

   private function stattocd($kd)
   {   
        switch($kd)
        {
        case 0 : return -1;break;
        case 1 : return "A";break;
        case 2 : return "C";break;
        case 3 : return "D";break;
        case 4 : return "K";break;
        case 5 : return "L";break;
        case 6 : return "N";break;
        }
   
   }

   public function getstatmhs($thnsms,$nim,$idx=0)
   {
     $data = $this->getdata("thnsmsstat_mhs='$thnsms' and nimstat_mhs='$nim'");
     
     $stat = $this->numrows==0 ? 0 : $data[0]['statstat_mhs']; 
     switch ($idx) {
        case 0 :
          return $this->stattostr($stat);
          break;
        case 1 :
          return $this->stattocd($stat);
          break;  
        
        default:
           return $stat;
          break;
      } 

   }

   public function getAngkatan($thn)
   {    
      $this->db->select('tahunmsmhs');
      $this->db->from('stat_mhs');
      $this->db->join('msmhs','nimstat_mhs=nimhsmsmhs');
      $this->db->where("thnsmsstat_mhs in ($thn)");      
      $this->db->group_by("tahunmsmhs");      
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }      
       
     return $hsl;
   }

  public function getjmlmhs_jmlstat($thnsms,$thn,$kls)
   {    
   
   $hitung=function ($stat) use ($thnsms,$thn,$kls)
       {
         $this->db->select("thnsmsstat_mhs,tahunmsmhs,shiftmsmhs,SUM(IF(kdjekmsmhs='L',1,0)) AS jmlL,SUM(IF(kdjekmsmhs='P',1,0)) AS jmlP,count(statstat_mhs) as jml");
         $this->db->from("stat_mhs");
         $this->db->join("msmhs","nimstat_mhs=nimhsmsmhs");
         $this->db->group_by("thnsmsstat_mhs,tahunmsmhs,shiftmsmhs");
         
         $txt_where = "thnsmsstat_mhs='$thnsms' and tahunmsmhs='$thn' and shiftmsmhs='$kls'";
         $txt_where .=($stat!='T') ? "and statstat_mhs=$stat":'';          
         $this->db->where($txt_where);
         $this->query = $this->db->get();
         
         $this->numrows = $this->query->num_rows();
         if($this->query->num_rows()>0)
         {
           $data=$this->query->result_array();
           return array('L'=>$data[0]['jmlL'],'P'=>$data[0]['jmlP'],'jml'=>$data[0]['jml']);
         }else{
           return array('L'=>0,'P'=>0,'jml'=>0);
         }
       }; 
   
   $jml = array();     
   $jml['T']=$hitung('T');     
   $jml['1']=$hitung(1);
   $jml['2']=$hitung(2);
   $jml['3']=$hitung(3);
   $jml['4']=$hitung(4);
   $jml['5']=$hitung(5);
   $jml['6']=$hitung(6);
     
   return $jml;
   }

   public function insertdata($data)
   {
      $this->db->insert('stat_mhs',$data);
   }

}