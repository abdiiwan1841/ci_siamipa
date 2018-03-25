<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vw_rekapkeu_model extends CI_Model {

   public $numrows;

   public function getdata($tb,$where='',$orderby='')
   {      
      $this->db->select('*');
      $this->db->from($tb);
      if(!empty($where)){
        $this->db->where($where);      
      }
      if(!empty($orderby)){  
       $this->db->order_by($orderby);
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

  function getdtchart()
   {
          
    $data = $this->getData('vw_rekapkeu1','','thn,bln');
    
    $chartdata=array();   
    
    if($this->numrows>0){
      $tmp=array(); 
      
      $thn_arr=array_unique(array_column($data, 'thn'));
        asort($thn_arr);  
    
        $bln_arr=array_unique(array_column($data, 'bln'));
        asort($bln_arr);
      
      array_walk($thn_arr,function ($thn,$key) use (&$tmp,$bln_arr){              
      array_walk($bln_arr,function ($bln,$key1) use (&$tmp,$thn){
              $tmp[$bln][$thn]=0;       
          }); 
        });
            
      array_walk($data,function ($row,$key) use (&$tmp){$tmp[$row['bln']][$row['thn']]=$row['tran'];});     
      
        array_walk($tmp,function ($arrrekap,$bln) use (&$chartdata){
       $nmbln = array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr', 5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agus',9=>'Sept',10=>'Okt',11=>'Nov',12=>'Des'); 
       $dt=array();    
         array_walk($arrrekap, function ($rekap,$thn) use (&$dt){      
         $dt[]=array('label'=>"$thn",'y'=>intval($rekap)); 
         });        
          $tmp_chart=array('type'=>"stackedBar",'showInLegend'=>'true','name'=>"$nmbln[$bln]",'dataPoints'=>$dt);   
          $chartdata[]=$tmp_chart;      
      }); 
    }
    return $chartdata;
   }
   
   function getdtchart1()
   {
     $data = $this->getdata('vw_rekapkeu2','','thn,tahunmsmhs');
    
   $chartdata=array();
   
   if($this->numrows>0){
     
      
      $ang_arr=array_unique(array_column($data, 'tahunmsmhs'));
        asort($ang_arr);
      
      $thn_arr=array_unique(array_column($data, 'thn'));
        asort($thn_arr);  
    
        
      array_walk($ang_arr,function ($ang,$key) use (&$tmp,$thn_arr){              
      array_walk($thn_arr,function ($thn,$key1) use (&$tmp,$ang){
              $tmp[$ang][$thn]=0;       
          }); 
        });
     
     array_walk($data,function ($row,$key) use (&$tmp){$tmp[$row['tahunmsmhs']][$row['thn']]=$row['tran'];}); 
     
     
     array_walk($tmp,function ($arrrekap,$ang) use (&$chartdata){
       
       $dt=array();    
         array_walk($arrrekap, function ($rekap,$thn) use (&$dt){      
         $dt[]=array('label'=>"$thn",'y'=>intval($rekap)); 
         });        
          $tmp_chart=array('type'=>"stackedBar",'showInLegend'=>'true','name'=>"$ang",'dataPoints'=>$dt);   
          $chartdata[]=$tmp_chart;      
      });  
   }   
   
   return $chartdata;
   }
   
   function getdtchart2()
   {
     $data = $this->getdata('vw_rekapkeu3','','thn,kd');
   
   $chartdata=array();
   
   if($this->numrows>0){
             
      $thn_arr=array_unique(array_column($data, 'thn'));
        asort($thn_arr);
      
      $aku_arr=array_unique(array_column($data, 'nm'));
        asort($aku_arr);  
    
       
      array_walk($aku_arr,function ($aku,$key) use (&$tmp,$thn_arr){              
      array_walk($thn_arr,function ($thn,$key1) use (&$tmp,$aku){
              $tmp[$aku][$thn]=0;       
          }); 
        }); 
       
      array_walk($data,function ($row,$key) use (&$tmp){$tmp[$row['nm']][$row['thn']]=$row['tran'];}); 
       
      array_walk($tmp,function ($arrrekap,$aku) use (&$chartdata){
       
       $dt=array();    
         array_walk($arrrekap, function ($rekap,$thn) use (&$dt){      
         $dt[]=array('label'=>"$thn",'y'=>intval($rekap)); 
         });        
          $tmp_chart=array('type'=>"stackedBar",'showInLegend'=>'true','name'=>"$aku",'dataPoints'=>$dt);   
          $chartdata[]=$tmp_chart;      
      });        
      
   }   
   return $chartdata;
   }

   

}