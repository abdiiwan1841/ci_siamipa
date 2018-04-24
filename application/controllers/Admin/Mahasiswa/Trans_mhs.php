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

  public function ctk_pdf()
  {
    if($this->input->is_ajax_request()){ 

      $vnim = $this->input->post('nim');
      $tbl4 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_jdl",'cellpadding'=>'2'));
     
          $tbl4->addRow();      
        $tbl4->addCell('<img src="../img/kop.jpg" alt="logo" width="100%" height="100%">','data');
            //$tbl4->addCell('<font face="Times New Roman" size="10pt">'.
                       //'<b>YAYASAN PENDIDIKAN BALE BANDUNG<br>'.
              //     'UNIVERSITAS BALE BANDUNG'.
               //  '</b>'.
                //   '</font>',null,'data');
     
          $jdl = $tbl4->display().        
        '<br><br>'.
            '<center>'.
                  '<font face="Times New Roman" size="10pt">'.
                   '<b>TRANSKRIP NILAI</b>'.
              '</font>'.
        '</center><br><br>';
            
      $dt_mhs = new dt_mhs;
      $data=$dt_mhs->getData($vnim);
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
          
      
       $tbl = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_mtk","width"=>"100%",'border'=>'1','cellpadding'=>'2'));
     
           $tbl->addRow(); 
           $tbl->addCell('Matakuliah',null,'header',array('rowspan'=>'2'));
           $tbl->addCell('Kode',null,'header',array('rowspan'=>'2'));   
           $tbl->addCell('SKS',null,'header',array('rowspan'=>'2'));   
           $tbl->addCell('NILAI',null,'header',array('colspan'=>'3'));
      
       $tbl->addCell('Matakuliah',null,'header',array('rowspan'=>'2'));
           $tbl->addCell('Kode',null,'header',array('rowspan'=>'2'));   
           $tbl->addCell('SKS',null,'header',array('rowspan'=>'2'));   
           $tbl->addCell('NILAI',null,'header',array('colspan'=>'3'));
      
      
       $tbl->addRow(); 
           $tbl->addCell('HM',null,'header');
           $tbl->addCell('AM',null,'header');   
           $tbl->addCell('NM',null,'header');  
                
       $tbl->addCell('HM',null,'header');
           $tbl->addCell('AM',null,'header');   
           $tbl->addCell('NM',null,'header');  
           
            
              
        $data = $this->vtrans->getData($vnim);          
          
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
      
            
      for ($k=1;$k<=($i-1);$k++)
      {
         
         $tbl->addRow();
        
                  
             $data_tmp=$data_kiri[$k-1];
            
           $tbl->addCell($data_tmp['nama'],null,'data');
           $tbl->addCell($data_tmp['kd'],null,'data');    
           $tbl->addCell($data_tmp['sks'],null,'data');  
           $tbl->addCell($data_tmp['HM'],null,'data');
           $tbl->addCell($data_tmp['AM'],null,'data');
           $tbl->addCell($data_tmp['NM'],null,'data');    
                
          if($k<=($j-1))
            {    
             $data_tmp=$data_kanan[$k-1];
            
             $tbl->addCell($data_tmp['nama'],null,'data');
             $tbl->addCell($data_tmp['kd'],null,'data');    
             $tbl->addCell($data_tmp['sks'],null,'data');  
             $tbl->addCell($data_tmp['HM'],null,'data');
             $tbl->addCell($data_tmp['AM'],null,'data');
             $tbl->addCell($data_tmp['NM'],null,'data');    
          }else
                      {
               $tbl->addCell('',null,'data');
             $tbl->addCell('',null,'data');   
             $tbl->addCell('',null,'data');  
             $tbl->addCell('',null,'data');
             $tbl->addCell('',null,'data');
             $tbl->addCell('',null,'data');             
            }         
        
      }

           
       $dt = $this->vtrans->hitipk($vnim);
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
      
      $tmp="../Admin/cetak/transkrip/Transkrip Nilai - ".$vnim.".pdf";
          
      $dompdf = new DOMPDF();
          $dompdf->load_html($html);
          $dompdf->set_paper('a4', 'portrait');
      $dompdf->render();
          $output = $dompdf->output();
          file_put_contents($tmp, $output);
      
      
      return $tmp;
      }     
    }
            
  

}