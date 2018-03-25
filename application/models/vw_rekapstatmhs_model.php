<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vw_rekapstatmhs_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('vw_rekapstatmhs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('tahunmsmhs asc','thnsmsstat_mhs desc');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();        
      }
      return $hsl; 
   }  

   function stattostr($kd)
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

    function getdtchart($mythnsem)
    {
       $data = $this->getdata('thnsmsstat_mhs="'.$mythnsem->getthnsem().'" and statstat_mhs=1');
       $tmparr=($this->numrows>0) ? array_map(function ($row){ return array('label'=>$row['tahunmsmhs'],'y'=>intval($row['rekapstat']));},$data) : array();
       $chartdata[] = array('type'=>"column",'dataPoints'=>$tmparr);
  
       return $chartdata;  
   }

   function getdtchart1($mythnsem)
   {
    
  $data = $this->getdata('statstat_mhs=1');
  $chartdata=array();
  $tmp=array(); 
  $thnarr=array();
  $chartdata=array();
  if($this->numrows>0){
    
    $thn_arr=array_unique(array_column($data, 'tahunmsmhs'));
    asort($thn_arr);  
    
    $thn_stat_arr=array_unique(array_column($data, 'thnsmsstat_mhs'));
    arsort($thn_stat_arr);
    
    array_walk($thn_arr,function ($angkatan,$key) use (&$tmp,$thn_stat_arr){              
      array_walk($thn_stat_arr,function ($thn,$key1) use (&$tmp,$angkatan){
              $tmp[$angkatan][$thn]=0;        
          }); 
    });
        
    array_walk($data,function ($row,$key) use (&$tmp){$tmp[$row['tahunmsmhs']][$row['thnsmsstat_mhs']]=$row['rekapstat'];});
                
    array_walk($tmp,function ($arrrekap,$angkatan) use (&$chartdata){
         
       $angk=array();      
       array_walk($arrrekap, function ($rekap,$semester) use (&$angk){       
         $angk[]=array('label'=>"$semester",'y'=>intval($rekap)); 
         });      
      
          $tmp_chart=array('type'=>"stackedBar",'showInLegend'=>'true','name'=>"$angkatan",'dataPoints'=>$angk);    
          $chartdata[]=$tmp_chart;      
    }); 
  }
       
     return $chartdata; 
   }

   function getdtchart2($mythnsem)
   {
      
  $data = $this->getdata('');
  $chartdata=array();
  $tmp=array(); 
  $thnarr=array();
  if($this->numrows>0){
        
    $stat_arr=array_unique(array_column($data, 'statstat_mhs'));
    asort($stat_arr);  
    
    $thn_stat_arr=array_unique(array_column($data, 'thnsmsstat_mhs'));
    arsort($thn_stat_arr);
    
    
    array_walk($stat_arr,function ($stat,$key) use (&$tmp,$thn_stat_arr){             
      array_walk($thn_stat_arr,function ($thn,$key1) use (&$tmp,$stat){
              $tmp[$stat][$thn]=0;        
          }); 
    });
    
    array_walk($data,function ($row,$key) use (&$tmp){$tmp[$row['statstat_mhs']][$row['thnsmsstat_mhs']]+=$row['rekapstat'];});
    
     array_walk($tmp,function ($arrrekap,$stat) use (&$chartdata){
         $angk=array();      
       array_walk($arrrekap, function ($rekap,$semester) use (&$angk){       
         $angk[]=array('label'=>"$semester",'y'=>intval($rekap)); 
         });
      
          $tmp_chart=array('type'=>"stackedBar",'showInLegend'=>'true','name'=>"'".$this->stattostr($stat)."'",'dataPoints'=>$angk);    
          $chartdata[]=$tmp_chart;      
    }); 
  }
       
     return $chartdata; 
   }

   

}