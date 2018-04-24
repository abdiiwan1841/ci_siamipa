<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
require_once (dirname(dirname(__FILE__))."/third_party/PHPExcel.php");
require_once (dirname(dirname(__FILE__))."/libraries/Excel.php");

class Ctktrans extends Excel
{ 
   private $col_width_;
   private $jdl_;
   private $dt_mhs_;
   private $pagefooter;
   private $isitb_kiri;
   private $isitb_kanan;
   private $kotak_ipk;
   private $isi_ipk;
   private $kotak_ttd;

   function __construct()
   {
     parent::__construct();

     $this->col_width_=array('A'=>9.00,'B'=>28.00,'C'=>1,'D'=>7.14,'E'=>3.8,'F'=>3.8,'G'=>3.8,'H'=>3.8,'I'=>0.33,'J'=>31.00,'K'=>1,'L'=>7.14,'M'=>3.8,'N'=>3.8,'O'=>3.8,'P'=>3.8);

     $tmp_font = $this->build_font(true,'Times New Roman',10);
     $tmp_font1 = $this->build_font(true,'Calibri',9);

     $tmp_borders = $this->build_borders(PHPExcel_Style_Border::BORDER_MEDIUM,PHPExcel_Style_Border::BORDER_MEDIUM);
     $tmp_borders1 = $this->build_borders(PHPExcel_Style_Border::BORDER_NONE,PHPExcel_Style_Border::BORDER_MEDIUM);

     $this->jdl_=array(
     	                 array('add'=>'A11','txt'=>'TRANSKRIP NILAI','merge'=>true,'madd'=>'A11:O11','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
					     array('add'=>'A14','txt'=>'Nama','font'=>$tmp_font),
					     array('add'=>'A15','txt'=>'Tempat/Tanggal Lahir','font'=>$tmp_font),
					     array('add'=>'A16','txt'=>'NIM','font'=>$tmp_font),
					     array('add'=>'C14','txt'=>':','font'=>$tmp_font),
					     array('add'=>'C15','txt'=>':','font'=>$tmp_font),
					     array('add'=>'C16','txt'=>':','font'=>$tmp_font),
					     array('add'=>'J14','txt'=>'Fakultas','font'=>$tmp_font),
					     array('add'=>'J15','txt'=>'Program Studi','font'=>$tmp_font),
					     array('add'=>'J16','txt'=>'Program Pendidikan','font'=>$tmp_font),
					     array('add'=>'K14','txt'=>':','font'=>$tmp_font),
					     array('add'=>'K15','txt'=>':','font'=>$tmp_font),
					     array('add'=>'K16','txt'=>':','font'=>$tmp_font),
					     array('add'=>'L14','txt'=>'Matematika dan IPA','font'=>$tmp_font),
					     array('add'=>'L15','txt'=>'Matematika','font'=>$tmp_font),
					     array('add'=>'L16','txt'=>'S1','font'=>$tmp_font),
					     array('add'=>'A','row'=>17,'txt'=>'Matakuliah','merge'=>true,'mawl'=>'A','makh'=>'C','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'D','row'=>17,'txt'=>'Kode','merge'=>true,'mawl'=>'D','makh'=>'D','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'E','row'=>17,'txt'=>'SKS','merge'=>true,'mawl'=>'E','makh'=>'E','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'F','row'=>17,'txt'=>'NILAI','merge'=>true,'mawl'=>'F','makh'=>'H','mjml'=>0,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'F18','txt'=>'HM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'G18','txt'=>'AM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'H18','txt'=>'NM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'J','row'=>17,'txt'=>'Matakuliah','merge'=>true,'mawl'=>'J','makh'=>'K','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'L','row'=>17,'txt'=>'Kode','merge'=>true,'mawl'=>'L','makh'=>'L','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'M','row'=>17,'txt'=>'SKS','merge'=>true,'mawl'=>'M','makh'=>'M','mjml'=>1,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'N','row'=>17,'txt'=>'NILAI','merge'=>true,'mawl'=>'N','makh'=>'P','mjml'=>0,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'N18','txt'=>'HM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'O18','txt'=>'AM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'P18','txt'=>'NM','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders)
					   );

     $this->dt_mhs_ = array(
                             array('add'=>'D14','txt'=>'','font'=>$tmp_font1),
					         array('add'=>'D15','txt'=>'','font'=>$tmp_font1),
					         array('add'=>'D16','txt'=>'','font'=>$tmp_font1)
     	                   );

     $this->isitb_kiri=array(
     	                 array('add'=>'A','row'=>17,'txt'=>'','merge'=>true,'mawl'=>'A','makh'=>'C','mjml'=>0,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'D','row'=>17,'txt'=>'','font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'E','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'F','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'G','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'H','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders)					     
					   );
     
     $this->isitb_kanan=array(
     	                 array('add'=>'J','row'=>17,'txt'=>'','merge'=>true,'mawl'=>'J','makh'=>'K','mjml'=>0,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'L','row'=>17,'txt'=>'','font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'M','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'N','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'O','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders),
					     array('add'=>'P','row'=>17,'txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'borders'=>$tmp_borders)
					   );

    $this->kotak_ipk=array(
     	                 array('add'=>'A','row'=>17,'txt'=>'TOTAL SKS','font'=>$tmp_font1,'wborder'=>true,'wborders'=>$tmp_borders1,'wbrdawl'=>'A','wbrdakh'=>'D','wbrdjml'=>1),
					     array('add'=>'A','row'=>17,'txt'=>'INDEX PRESTASI KUMULATIF (IPK)','font'=>$tmp_font1),
					     array('add'=>'C','row'=>17,'txt'=>':','font'=>$tmp_font1),
					     array('add'=>'C','row'=>17,'txt'=>':','font'=>$tmp_font1)
					   );
     
    $this->isi_ipk=array(
     	                 array('add'=>'D','row'=>17,'txt'=>'','font'=>$tmp_font1),
					     array('add'=>'D','row'=>17,'txt'=>'','font'=>$tmp_font1)
					   );
    
    $this->kotak_ttd=array(
     	                 array('add'=>'K','row'=>17,'txt'=>'Baleendah, ____________ 20___','font'=>$tmp_font1),
					     array('add'=>'M','row'=>17,'txt'=>'___________','font'=>$tmp_font1),
					     array('add'=>'M','row'=>17,'txt'=>'___________','font'=>$tmp_font1)
					   );



     $this->pagefooter='&L&5Dicetak dari Sistem Informasi Akademik FMIPA UNIBBA pada tanggal : '.date("d-m-Y H:i:s").' &R&5dicetak ulang : &D &T';

     


   } 

   function buattrans($dt_mhs,$dt_nilai,$sks_tot,$ipk)
   {
      $this->setActiveSheetIndex(0);
      $this->insert_image('A1',0,0,800,dirname(dirname(dirname(__FILE__))).'/assets/img/kop.jpg');
      $this->setColumnWidth($this->col_width_);
      $this->tulis_data($this->jdl_);

      foreach($dt_mhs as $row){
		    $this->dt_mhs_[0]['txt']=$row['nmmhsmsmhs'];
		    $this->dt_mhs_[1]['txt']=trim($row['tplhrmsmhs'])." / ".date_format(date_create($row['tglhrmsmhs']),'d-m-Y');
		    $this->dt_mhs_[2]['txt']=$row['nimhsmsmhs'];
	  }

	  $this->tulis_data($this->dt_mhs_);

              $i=19;
			  $j=19;
			  $cnt = 1;
			  $jml_data = count($dt_nilai);
			if(!empty($dt_nilai)){ 

			foreach ($dt_nilai as $row) 
			  {
                 	$sks = $row['sksmktbkmk'];	
					$am = $row['bobottrnlm'];
					$nm = $sks*$am;
              
   			            if($cnt<=(($jml_data/2)+($jml_data%2==0 ? 0:1))){                      					   
					       
					       $this->isitb_kiri[0]['row']=$i;
					       $this->isitb_kiri[0]['txt']=$row['nakmktbkmk'];

					       $this->isitb_kiri[1]['row']=$i;
					       $this->isitb_kiri[1]['txt']=$row['kdkmktrnlm'];
                           
                           $this->isitb_kiri[2]['row']=$i;
					       $this->isitb_kiri[2]['txt']=$row['sksmktbkmk']; 
                           
                           $this->isitb_kiri[3]['row']=$i;
					       $this->isitb_kiri[3]['txt']=$row['nlakhtrnlm']; 

                           $this->isitb_kiri[4]['row']=$i;
					       $this->isitb_kiri[4]['txt']='=IF(F'.$i.'="A",4,IF(F'.$i.'="B",3,IF(F'.$i.'="C",2,IF(F'.$i.'="D",1,0))))' ;//$row['bobottrnlm'];

					       $this->isitb_kiri[5]['row']=$i;
				           $this->isitb_kiri[5]['txt']="=E$i * G$i";//$nm; 
                           
                           $this->tulis_data($this->isitb_kiri);

					   	$i++;
						}else{
						   if($cnt>(($jml_data/2)+($jml_data%2==0 ? 0:1)) and $cnt<=$jml_data){
						   
						   $this->isitb_kanan[0]['row']=$j;
					       $this->isitb_kanan[0]['txt']=$row['nakmktbkmk'];

					       $this->isitb_kanan[1]['row']=$j;
					       $this->isitb_kanan[1]['txt']=$row['kdkmktrnlm'];
                           
                           $this->isitb_kanan[2]['row']=$j;
					       $this->isitb_kanan[2]['txt']=$row['sksmktbkmk']; 
                           
                           $this->isitb_kanan[3]['row']=$j;
					       $this->isitb_kanan[3]['txt']=$row['nlakhtrnlm']; 

                           $this->isitb_kanan[4]['row']=$j;
					       $this->isitb_kanan[4]['txt']='=IF(N'.$j.'="A",4,IF(N'.$j.'="B",3,IF(N'.$j.'="C",2,IF(N'.$j.'="D",1,0))))' ;//$row['bobottrnlm'];

					       $this->isitb_kanan[5]['row']=$j;
				           $this->isitb_kanan[5]['txt']="=M$j * O$j";//$nm;
                           
                           $this->tulis_data($this->isitb_kanan);
								$j++;
							}	
						}
						
					 $cnt++;
					 
			    }
			    
			}
            
            if($i>$j){
			    $max=$i+1;
            }else{
                $max=$j+1;
			}

			$this->kotak_ipk[0]['row']=$max;
			$this->kotak_ipk[1]['row']=$max+1;
			$this->kotak_ipk[2]['row']=$max;
			$this->kotak_ipk[3]['row']=$max+1;

            $this->tulis_data($this->kotak_ipk);

            $this->isi_ipk[0]['row']=$max;
			$this->isi_ipk[1]['row']=$max+1;

			$this->isi_ipk[0]['txt']='=sum(E19:E'.$i.',M19:M'.$j.')';//strval($sks_tot);
			$this->isi_ipk[1]['txt']='=sum(H19:H'.$i.',P19:P'.$j.')/sum(E19:E'.$i.',M19:M'.$j.')';//number_format($ipk, 2, ',', ' ');
            
            $this->tulis_data($this->isi_ipk);

            $this->kotak_ttd[0]['row']=$max+1;
			$this->kotak_ttd[1]['row']=$max+3;
			$this->kotak_ttd[2]['row']=$max+6;

            $this->tulis_data($this->kotak_ttd);

      $this->setPageSetup(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT,PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL,true,false,100,0,0,true);
	  
	  $margin = 0 / 2.54;
	  $this->setMargin($margin,$margin,$margin,$margin);
	  $this->setFooter($this->pagefooter);

   }

}