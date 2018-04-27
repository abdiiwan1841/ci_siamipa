<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_mhs extends CI_Controller {

	public function transkrip()
	{
		if($this->input->is_ajax_request()){ 
          
          $hak=$this->session->userdata('hak');          
          $nim = $this->input->post('nim');
          $nm = $this->Msmhs_model->getnm($nim)."($nim)";
          $table = $this->Vw_tbtrnlptrnlmjnmtk_model->tb_transkrip($nim);

          echo json_encode(array('nm'=>$nm,'table'=>$table));
		}
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


  public function ctk_excel($vnim)
  {      
      $data1=$this->Msmhs_model->getdata("nimhsmsmhs='$vnim'");                  
      $data2 = $this->Vw_tbtrnlptrnlmjnmtk_model->getdatatrans("nimhstrnlm='$vnim' and nlakhtrnlm !='K'");         
                        
      $dt=$this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($vnim);
      $ipk =  $dt['jml_sksnm'] /$dt['jml_sks'];
      $sks =  $dt['jml_sks'];
          
                $tmp= dirname((dirname(dirname(__FILE__))))."/assets/cetak/Admin/transkrip/Transkrip Nilai - ".$vnim.".xls";
                $this->load->library('ctktrans');
                $this->ctktrans->buattrans($data1,$data2,$sks,$ipk);
                
                
                $filename="Transkrip Nilai - ".$vnim.".xls"; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $this->ctktrans->download();
                //$this->ctktrans->save($tmp);


                //$tmp= base_url()."/assets/cetak/Admin/transkrip/Transkrip Nilai - ".$vnim.".xls";     
                //echo $tmp;
           
  }

  public function ctk_pdf($vnim)
  {
   
       
      $tbl4 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_jdl",'cellpadding'=>'2'));
      $tbl4->addRow();      
      $img = '<img src="'.dirname(dirname(dirname((dirname(dirname(__FILE__)))))).'/assets/img/kop.jpg" alt="logo" width="100%" height="100%">';
      $tbl4->addCell($img,'data');
      $jdl = $tbl4->display().        
        '<br><br>'.
            '<center>'.
                  '<font face="Times New Roman" size="10pt">'.
                   '<b>TRANSKRIP NILAI</b>'.
              '</font>'.
        '</center><br><br>';
            
      
      $data=$this->Msmhs_model->getdata("nimhsmsmhs='$vnim'");
      foreach($data as $row){        
           $tbl2 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_mhs","width"=>"100%"));       
           $tbl2->addRow();     
            $tbl2->addCell('Nama','data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell($row['nmmhsmsmhs'],null,'data');
            $tbl2->addCell('Fakultas','data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell('Matematika dan IPA',null,'data');         
           $tbl2->addRow();     
            $tbl2->addCell('Tempat/Tanggal Lahir','data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell(trim($row['tplhrmsmhs'])." / ".date_format(date_create($row['tglhrmsmhs']),'d-m-Y'),null,'data');
            $tbl2->addCell('Program Studi','data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell('Matematika',null,'data');
           $tbl2->addRow();     
            $tbl2->addCell('NIM',null,'data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell($row['nimhsmsmhs'],null,'data');
            $tbl2->addCell('Program Pendidikan','data');
            $tbl2->addCell(':',null,'data');
            $tbl2->addCell('S1',null,'data');        
      }
          $header = array(
                          array(
                                 array('Matakuliah',array('rowspan'=>'2')),
                                 array('Kode',array('rowspan'=>'2')),
                                 array('SKS',array('rowspan'=>'2')),
                                 array('Nilai',array('colspan'=>'3')),
                                 array('Matakuliah',array('rowspan'=>'2')),
                                 array('Kode',array('rowspan'=>'2')),
                                 array('SKS',array('rowspan'=>'2')),
                                 array('Nilai',array('colspan'=>'3'))
                               ),
                          array(
                                 array('HM',array()),
                                 array('AM',array()),
                                 array('NM',array()),
                                 array('HM',array()),
                                 array('AM',array()),
                                 array('NM',array())
                               )
                          );
        $tbstat = array("id" => "tb_mtk","width"=>"100%",'border'=>'1','cellpadding'=>'2');
              
        $data = $this->Vw_tbtrnlptrnlmjnmtk_model->getdatatrans("nimhstrnlm='$vnim' and nlakhtrnlm !='K'");
          
        $i=1;
        $j=1;
        $cnt = 1;
        $jml_data = count($data);
      if(!empty($data)){ 

      foreach ($data as $row) 
        {
          $sks = $row['sksmktbkmk'];  
          $am = $row['bobottrnlm'];
          $nm = $sks*$am;
              
          if($cnt<=(($jml_data/2)+($jml_data%2==0 ? 0:1))){                                  
             $data_tmp['nama'] = $row['nakmktbkmk'];
             $data_tmp['kd']   = $row['kdkmktrnlm'];            
             $data_tmp['sks']  = $row['sksmktbkmk'];
             $data_tmp['HM']   = $row['nlakhtrnlm'];
             $data_tmp['AM']   = $row['bobottrnlm'];
             $data_tmp['NM']   = $nm;
             $data_kiri[] = $data_tmp;
             $i++;
          }else{
              if($cnt>(($jml_data/2)+($jml_data%2==0 ? 0:1)) and $cnt<=$jml_data){
                 $data_tmp['nama'] = $row['nakmktbkmk'];
                 $data_tmp['kd']   = $row['kdkmktrnlm'];            
                 $data_tmp['sks']  = $row['sksmktbkmk'];
                 $data_tmp['HM']   = $row['nlakhtrnlm'];
                 $data_tmp['AM']   = $row['bobottrnlm'];
                 $data_tmp['NM']   = $nm;
                 $data_kanan[] = $data_tmp;
                 $j++;
              } 
            }
            
           $cnt++;
           
          }
          
      }
      
      $isi_data=array();
            
      for ($k=1;$k<=($i-1);$k++)
      {
         
           
           $tmp=array();
           $data_tmp=$data_kiri[$k-1];

           $tmp[]=array($data_tmp['nama'],array());
           $tmp[]=array($data_tmp['kd'],array());    
           $tmp[]=array($data_tmp['sks'],array());  
           $tmp[]=array($data_tmp['HM'],array());
           $tmp[]=array($data_tmp['AM'],array());
           $tmp[]=array($data_tmp['NM'],array());    
                
          if($k<=($j-1))
          {    
             $data_tmp=$data_kanan[$k-1];
            
             $tmp[]=array($data_tmp['nama'],array());
             $tmp[]=array($data_tmp['kd'],array());    
             $tmp[]=array($data_tmp['sks'],array());  
             $tmp[]=array($data_tmp['HM'],array());
             $tmp[]=array($data_tmp['AM'],array());
             $tmp[]=array($data_tmp['NM'],array());       
          }else
           {
             $tmp[]=array('',array());
             $tmp[]=array('',array());   
             $tmp[]=array('',array());  
             $tmp[]=array('',array());
             $tmp[]=array('',array());
             $tmp[]=array('',array());             
            }         
        $isi_data[]=$tmp;
      }

       $tbl = new mytable($tbstat,$header,$isi_data,'');
           
       $dt = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($vnim);
       $ipk =  $dt['jml_sksnm'] /$dt['jml_sks'];
       $sks =  $dt['jml_sks'];
       
       $tbl3 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_ttd",'border'=>'1','width'=>'37%','cellpadding'=>'2'));
     
         $tbl3->addRow(); 
         $tbl3->addCell('TOTAL SKS',null,'data');
         $tbl3->addCell(':',null,'data');
         $tbl3->addCell(strval($sks),null,'data');       
         $tbl3->addRow(); 
         $tbl3->addRow(); 
         $tbl3->addCell('INDEX PRESTASI KUMULATIF (IPK)',null,'data');
         $tbl3->addCell(':',null,'data');
         $tbl3->addCell(number_format($ipk, 2, ',', ' '),null,'data');
              
      //$objPHPExcel->getActiveSheet()->setCellValue('K'.($max+3),'Baleendah, ____________ 20___');
      
      //$objPHPExcel->getActiveSheet()->setCellValue('M'.($max+5),'___________');
      //$objPHPExcel->getActiveSheet()->setCellValue('M'.($max+8),'___________');
      
            
      
       $html =
            '<html>'.
      '<style type="text/css">'.
      'table{font-family: Calibri; font-size: 8pt;}'.
      '</style>'.
      '<body>'.
       $jdl.$tbl2->display().             
       $tbl->display().
       //$tbl1->display().
      '<br>'.$tbl3->display().
      '<br>'.'<font face="Calibri" size="9pt">Dicetak dari Sistem Informasi Akademik FMIPA UNIBBA pada tanggal '.date("d-m-Y H:i:s").'</font>'.
            '</body>'.
      '</html>';          
      
      $tmp=dirname(dirname(dirname((dirname(dirname(__FILE__))))))."/assets/cetak/Admin/transkrip/Transkrip Nilai - ".$vnim.".pdf";
      
      $this->load->library('pdf');
      $filename="Transkrip Nilai - ".$vnim.".pdf";
      $this->pdf->load_html($html);
      $this->pdf->set_paper('a4', 'portrait');
      $this->pdf->render();
      $this->pdf->stream($filename);

       //   $output = $dompdf->output();
       
      
      //$tmp= base_url()."/assets/cetak/Admin/transkrip/Transkrip Nilai - ".$vnim.".pdf";     
      //   file_put_contents($tmp, $output);
      
    }
            
  

}