<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sum_mhs extends CI_Controller {

	public function filter()
  {
       if($this->input->is_ajax_request()){ 
          $nim = $this->input->post('nim');
          $nm = $this->Msmhs_model->getnm($nim)."($nim)";
          
          $sks_sem     = $this->sks_sem($nim);
          $jml_sks     = $this->jml_sks($nim);
          $hit_ipk     = $this->hit_ipk($nim);
          $riwayat_stat= $this->riwayat_stat($nim);
          $pos_keu     = $this->pos_keu($nim);
          $nD          = $this->mytb('D',$nim);
          $nE          = $this->mytb('E',$nim);
          $nT          = $this->mytb('T',$nim);
          $blm_amb     = $this->blm_amb($nim);

          echo json_encode(array('nm'=>$nm,
                                 'sks_sem'=>$sks_sem,
                                 'jml_sks'=>$jml_sks,
                                 'hit_ipk'=>$hit_ipk,
                                 'mstud'=>$riwayat_stat['mstud'],
                                 'rstat'=>$riwayat_stat['rstat'],
                                 'pos_keu'=>$pos_keu,
                                 'nilaiD'=>$nD['nilaiD'],
                                 'ulangD'=>$nD['ulangD'],
                                 'nilaiE'=>$nE['nilaiE'],
                                 'ulangE'=>$nE['ulangE'],
                                 'nilaiT'=>$nT['nilaiT'],
                                 'ulangT'=>$nT['ulangT'],
                                 'blm_amb'=>$blm_amb));

       }
  }

  private function format_bagi($a,$b)
    {
         return ($b!=0 ? number_format($a/$b, 2, '.', '') : '0.00');
    }

  private function sks_sem($nim)
  {
       
         $mythnsem = new mythnsem;

         $tbstat = array("id" => "tb_sks_sem",'width'=>'100%');
         $header = array(array(array('Semester',array('align'=>'center')),
                               array('SKS',array('align'=>'center')),
                               array('IPS',array('align'=>'center')),
                               array('IPK',array('align'=>'center'))));
         $data_table = array();

         $data = $this->Vw_tbtrnlptrnlmjnmtk_model->get_rekapkhs($nim);
          $i=1;
       
       if(!empty($data)){ 
        $tmpsms="";

        foreach($data[$nim] as $thnsms => $val){  
         
             $tmp=array();
             if($thnsms!='0000' ){
                  $tmp[]=array("Sem. ke - $i (".$mythnsem->gettxtthnsem($thnsms,'Sem. ').")",array());               
             }else{
                  $tmp[]=array("Konversi",array());
             }
             
              if($tmpsms==""){         
                $tmpsms=$thnsms;
              }else{
                $tmpsms=$tmpsms.','.$thnsms; 
              }
             
             $hsl=$this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($nim,$tmpsms);
             
             $tmp[]=array((integer) $val['jml_sks'],array('align'=>'right'));
             $tmp[]=array($this->format_bagi($val['jml_sksam'],$val['jml_sks']),array('align'=>'right'));       
             $tmp[]=array($this->format_bagi($hsl['jml_sksnm'],$hsl['jml_sks']),array('align'=>'right'));
             
             $i+=1;
                          
             $data_table[]=$tmp;              
        }
       }  
        
        if(empty($data_table))
        {
         $data_table[]=array(array('Tidak ada data',array('colspan'=>4)));
        }
          $tbl = new mytable($tbstat,$header,$data_table,"");
          return $tbl->display();  
  }

  private function jml_sks($nim){
       
         $tbstat = array("id" => "jml_sks",'width'=>'100%');
         $header = array(array('SKS Konversi','SKS yg Sudah Di ambil','SKS yg Belum Di ambil','Total SKS'));
         $data_table = array();

         $sks_konv = $this->Vw_tbtrnlptrnlmjnmtk_model->hitsks($nim,'00000');
         $sks_mbl  = $this->Vw_tbtrnlptrnlmjnmtk_model->sks_mbl($nim);
         $sks_nmbl = $this->Mtk_model->sksnmbl($nim);
         $sks_tot = $this->Mtk_model->hittotsks();

         $tmp=array();
         $tmp[]=array($sks_konv,array('align'=>'right'));
         $tmp[]=array($sks_mbl-$sks_konv,array('align'=>'right'));
         $tmp[]=array($sks_nmbl,array('align'=>'right'));
         $tmp[]=array($sks_tot,array('align'=>'right'));
         $data_table[]=$tmp;

         if(empty($data_table)){   
            $data_table[]=array(array('Tidak ada data',array('colspan'=>4)));
          }

          $tbl = new mytable($tbstat,$header,$data_table,"");
          return $tbl->display();  
  }

  private function hit_ipk($nim){
       
         $tbstat = array("id" => "hit_ipk",'width'=>'100%');
         $header = array(array('SKS Kumulatif','NM Kumulatif','IPK'));
         $data_table = array();

         $data = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($nim);

          $tmp=array();
          $tmp[]=array((integer) $data['jml_sks'],array('align'=>'right'));
          $tmp[]=array((integer) $data['jml_sksnm'],array('align'=>'right'));
          $tmp[]=array($this->format_bagi($data['jml_sksnm'],$data['jml_sks']),array('align'=>'right'));
          $data_table[]=$tmp;

          if(empty($data_table)){   
            $data_table[]=array(array('Tidak ada data',array('colspan'=>4)));
          }
          $tbl = new mytable($tbstat,$header,$data_table,"");
          return $tbl->display();  
  }

  private function pos_keu($nim){
       
         $tbstat = array("id" => "poskeu",'width'=>'100%');
         $header = array(array('Kewajiban','Transaksi','Kekurangan','Kelebihan'));
         $data_table = array();

         $data = $this->Vw_tbrekaptrkeumhs_model->getdata("nimhsmsmhs='".$nim."'");

         if(!empty($data))
         {
          foreach($data as $row)
          {
           $tmp=array();
           $tmp[]=array(number_format($row['kewajiban'], 2, ',', '.') ,array('align'=>'right'));
           $tmp[]=array(number_format($row['tran'], 2, ',', '.'),array('align'=>'right'));
           $tmp[]=array(number_format($row['kewajiban']>$row['tran'] ? $kurang=$row['kewajiban']-$row['tran'] : $kurang=0.00 , 2, ',', '.'), array('align'=>'right'));
           $tmp[]=array(number_format($row['kewajiban']<$row['tran'] ? $lebih=$row['tran']-$row['kewajiban'] : $lebih=0.00 , 2, ',', '.'), array('align'=>'right'));
           $data_table[]=$tmp;
           
          }
        }

         
         if(empty($data_table)){   
            $data_table[]=array(array('Tidak ada data',array('colspan'=>4)));
          }
     
          $tbl = new mytable($tbstat,$header,$data_table,"");
          return $tbl->display();  
  }

  private function riwayat_stat($nim){
       
         
         $data1 = $this->Stat_mhs_model->getRStatMhs($nim); 

         $tbstat = array("id" => "mstud",'width'=>'100%');
         $header = array(array('Semester Awal','Semester Akhir','Batas Studi','Toleransi Semester Akhir','Toleransi Batas Studi'));
         $data_table = array();
         
         if(isset($data1[$nim])){
            $tmp=array();
            $tmp[]=array($data1[$nim]['sawal'], array());
            $tmp[]=array($data1[$nim]['sakhir'], array());
            $tmp[]=array($data1[$nim]['bstd'], array());
            $tmp[]=array($data1[$nim]['tsakhir'], array());
            $tmp[]=array($data1[$nim]['tbstd'], array());
            $data_table[]=$tmp;
          }  

         if(empty($data_table)){   
            $data_table[]=array(array('Tidak ada data',array('colspan'=>4)));
          }

         $tbl = new mytable($tbstat,$header,$data_table,"");
         $table['mstud']=$tbl->display();         


         $tbstat = array("id" => "rstat",'width'=>'100%');
         $header = array(array('No','Semester','Status'));
         $data_table = array();

         if(!empty($data1))
         {      
           $i=1;
           $txtstat='Aktif';
           foreach($data1[$nim]['rstat'] as $row)
           {                
              if(!in_array($txtstat,array('Lulus','Keluar'))){  
                $tmp=array();
                $tmp[]=array($i, array());     
                $tmp[]=array($row['txt'], array());     
                $tmp[]=array($row['txtstat'], array());
                $txtstat=$row['txtstat'];
                $data_table[]=$tmp;
                $i=$i+1;
              }  
           }    
         }

         if(empty($data_table)){   
            $data_table[]=array(array('Tidak ada data',array('colspan'=>3)));
          }
     
         $tbl = new mytable($tbstat,$header,$data_table,"");
         $table['rstat']=$tbl->display(); 

         return $table; 
  }

     private function ismrhitl($iswp,$data)
     {
       if($iswp=='p'){
        return "<font color='red'><i>".$data."</i></font>";
        }
       else{
         return "$data";      
       }
     }

  private function mytb($nl,$nim)
    {
         $mythnsem = new mythnsem;
         $tbstat = array("id" => "nilai$nl",'width'=>'100%');
         $header = array(array("Kode","Matakuliah","SKS","HM","NM"));
         $data_table = array();
         
         $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->getdata("nimhstrnlm='$nim' and nlakhtrnlm='$nl'");

         if(!empty($data1)){
              $thn='';
              foreach($data1 as $row){   
                        if($thn=='' or $thn!=$row['thsmstrnlm']){     
                         $tmp=array();
                         $tmp[]=array($mythnsem->gettxtthnsem($row['thsmstrnlm']),array('colspan'=>5));
                         $thn=$row['thsmstrnlm'];
                         $data_table[]=$tmp;
                        } 

                         $tmp=array();
                         $tmp[]=array($row['kdkmktrnlm'],array());
                         $tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
                         $tmp[]=array($this->ismrhitl($row['wp'],$row['sksmktbkmk']),array());                
                         $tmp[]=array($row['nlakhtrnlm'],array());
                         $tmp[]=array($row['bobottrnlm'],array());               
                         $data_table[]=$tmp; 
                       }                    
          }

         if(empty($data_table)){  
           $data_table[]=array(array('Tidak ada data',array('colspan'=>5)));
          }
          
         $tbl = new mytable($tbstat,$header,$data_table,"");
         $table["nilai$nl"]=$tbl->display();           
         
         $tbstat = array("id" => "ulang$nl",'width'=>'100%');
         $data_table = array();

         $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->buildkhs_ulang($nim,$nl);

         if(!empty($data1)){
              $thn='';
              foreach($data1 as $row){   
                           
                         if($thn=='' or $thn!=$row['thsmstrnlm']){     
                         $tmp=array();
                         $tmp[]=array($mythnsem->gettxtthnsem($row['thsmstrnlm']),array('colspan'=>5));
                         $thn=$row['thsmstrnlm'];
                         $data_table[]=$tmp;
                         } 
                         $tmp=array();
                         $tmp[]=array($row['kdkmktrnlm'],array());
                         $tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
                         $tmp[]=array($this->ismrhitl($row['wp'],$row['sksmktbkmk']),array());                
                         $tmp[]=array($row['nlakhtrnlm'],array());
                         $tmp[]=array($row['bobottrnlm'],array());               
                         $data_table[]=$tmp; 
                       }                    
          }
         
         if(empty($data_table)){  
           $data_table[]=array(array('Tidak ada data',array('colspan'=>5)));
          }
         $tbl = new mytable($tbstat,$header,$data_table,"");
         $table["ulang$nl"]=$tbl->display();
         return $table;    
          
    }

  private function blm_amb($nim){
       
         $tbstat = array("id" => "tb_blm_amb",'width'=>'100%');
         $header = array(array('Semester','Kode','Matakuliah','SKS'));
         $data_table = array();

         $where = "(kdkmktbkmk NOT IN (SELECT DISTINCT kdkmktrnlm FROM trnlm_trnlp WHERE nimhstrnlm='$nim' and nlakhtrnlm!='K')) AND (kdkmktbkmk NOT LIKE 'MATP%')";
         $data=$this->Mtk_model->getdata($where);

         if(!empty($data)){           
             foreach($data as $row){       
                  $tmp=array();
                  $tmp[]=array('Semester '.$row['semestbkmk'],array());
                  $tmp[]=array($row['kdkmktbkmk'],array());
                  $tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
                  $tmp[]=array($this->ismrhitl($row['wp'],$row['sksmktbkmk']), array());       
                  $data_table[]=$tmp; 
              }
          }

         
     
          $tbl = new mytable($tbstat,$header,$data_table,"");
          return $tbl->display();  
  }


  public function datatable_ajax()
  {
    echo json_encode($this->ss_viewdata($this->input->post()));
  }

  private function ss_viewdata($param)
  {
     
     $array_nmtb = array('sumaktif1'=>1,'sumaktif2'=>1,'sumnonaktif'=>6,'sumcuti'=>2,'sumlulus'=>5,'sumkeluar'=>4);
     
     $mythnsem = new mythnsem;
     $TA = $mythnsem->getthnsem();    
     
     $totalrecords=0;
     $totaldisplayrecords=0;     
     
     $data = $this->Stat_mhs_model->getData('statstat_mhs='.$array_nmtb[$param['namatb']].' and thnsmsstat_mhs='.$TA);
     $totalrecords = empty($data) ? 0 : count($data);     
     $totaldisplayrecords=$totalrecords;
     
    if($param['namatb']!='sumaktif1' and $param['namatb']!='sumaktif2' and $param['sSearch'] == ""){  
     $this->Stat_mhs_model->setpageno(((intval($param['iDisplayStart']))/intval($param['iDisplayLength']))+1);
     $this->Stat_mhs_model->setrows_per_page(intval($param['iDisplayLength']));
     $data = $this->Stat_mhs_model->getData('statstat_mhs='.$array_nmtb[$param['namatb']].' and thnsmsstat_mhs='.$TA);   
    } 
         
     $output = array(
      "sEcho" => intval($param['sEcho']),
      "iTotalRecords" => $totalrecords,
      "iTotalDisplayRecords" => $totaldisplayrecords,
      "aaData" => array()
    );
     
     
     if(!empty($data))  
     {
            
      $jml_data=0;
      $display_data=0;
      $jml_filter=0;
      
      $cari=$param['sSearch'];
      
      $is_included = function ($arr,$cari){
                      $tmp = array_filter($arr,function($val) use ($cari) {
                                return preg_match("/".$cari."/i",$val);
                             });
                      return !empty($tmp);    
                     };
      
      $add_data = function($param,&$data_arr,$tmp_row,$jml_data,&$display_data,&$jml_filter,$cari,$is_masuk){
        
        $jml_filter+= ($is_masuk) ? 1 : 0;          
          
          if(($display_data<$param['iDisplayLength']) and ((($cari == "") ? $jml_data :$jml_filter-1 )>=$param['iDisplayStart'])){ 
             
             if(($cari == "") or $is_masuk){  
               $data_arr[] = $tmp_row;
               $display_data++;
             }
          }       
        
        return 1;
      };
      
      $sumaktif1=function ($ipk){ return $ipk>2.75; };
      $sumaktif2=function ($ipk){ return $ipk<=2.75; };
      
      foreach($data as $row)
            {
        $tmp_row = array();
        
        $ipk =0;
        if( ($cari=='') or ($display_data<$param['iDisplayLength'])){
          $tmp_data = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row["nimstat_mhs"].'"');
          $tmp_row[]='Angkatan '.$tmp_data[0]['tahunmsmhs'];
          $tmp_row[]=$tmp_data[0]['nimhsmsmhs'];
          $tmp_row[]=$tmp_data[0]['nmmhsmsmhs'];
          $tmp_row[]=$tmp_data[0]['shiftmsmhs']=="R" ? "Reguler" : "Non Reguler";
                  
          $hsl = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($row["nimstat_mhs"]);
          $ipk =$this->format_bagi($hsl['jml_sksnm'],$hsl['jml_sks']);// $this->vtrans->sks_mbl!=0 ? $this->vtrans->sks_nm/$this->vtrans->sks_mbl :0.00; 
           
          $tmp_row[]='<div align="right">'.(integer) $hsl['jml_sks'].'</div>';
          $tmp_row[]='<div align="right">'.number_format($ipk, 2, '.', '').'</div>';
          
          $arr_stat_mhs = $this->Stat_mhs_model->getRStatMhs($row["nimstat_mhs"]);
          $tmp_row[]=$arr_stat_mhs[$row["nimstat_mhs"]]['tbstd'];
          
          $dt_keu = $this->Vw_tbrekaptrkeumhs_model->getdata("nimhsmsmhs='".$row["nimstat_mhs"]."'");
          $rwkeu=$dt_keu[0];                   
          $tmp_row[]='<div align="right">'.number_format($rwkeu['kewajiban']>$rwkeu['tran'] ? $kurang=$rwkeu['kewajiban']-$rwkeu['tran'] : $kurang=0.00).'</div>';
        }           
          if($array_nmtb[$param['namatb']]==1){
            $tmp=${$param['namatb']}($ipk);
            if($tmp)
            {         
              $jml_data+=$add_data($param,$output['aaData'],$tmp_row,$jml_data,$display_data,$jml_filter,$cari,$is_included($tmp_row,$cari));
              
            }           
              }else{  
                       
             if($cari == ""){               
              $output['aaData'][] = $tmp_row;
               }else{             
              $jml_data+=$add_data($param,$output['aaData'],$tmp_row,$jml_data,$display_data,$jml_filter,$cari,$is_included($tmp_row,$cari));
               
              }            
              
            }         
      }      
       
       if($param['namatb']=='sumaktif1' or $param['namatb']=='sumaktif2'){
              $output['iTotalRecords']=$jml_data;
              $output['iTotalDisplayRecords']= ($param['sSearch'] == "") ? $jml_data : $jml_filter;
       }else{
         if($param['sSearch']!=''){
           $output['iTotalDisplayRecords']=$jml_filter;
         }
       }
     
     }    
    
         return $output;     
    } 


  public function ambilkelas()
	{
       if($this->input->is_ajax_request()){ 
          $thn = $this->input->post('thnmsmshs');
          $data=$this->Msmhs_model->getKelas($thn);

          foreach($data as $row)
          {

           if($row['shiftmsmhs']=='R'){
               echo"<option value='$row[shiftmsmhs]'>$row[shiftmsmhs] - Reguler</option>";
             }else{ 
               echo"<option value='$row[shiftmsmhs]'>$row[shiftmsmhs] - Non Reguler </option>";
            }
  
          }

       }
	}

	public function ambilnm()
	{
	  if($this->input->is_ajax_request()){ 	
		$thn = $this->input->post('thnmsmshs');
		$kls = $this->input->post('kelas');
    $data=$this->Msmhs_model->getMhs($thn,$kls);

		foreach($data as $row)
        {
          echo "<option value='$row[nimhsmsmhs]'>$row[nimhsmsmhs] - $row[nmmhsmsmhs]</option>";
        }
    }
	}            
  

}