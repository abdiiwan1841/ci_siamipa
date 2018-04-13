<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      
      <form id="dtmtk" action="" method="post" >  
     <?php 
         $row = array('jml'=>1);
         $col = array('jml'=>2,'class'=>array('col-md-6','col-md-6'));

         $from = new html_form(); 
         $attr = array('class'=>'form-control',
                        'id'=>'kdkmk',
                        'placeholder'=>'Kode ...',
                        'data-msg'=>'Kode Harus Diisi !!!',
                        'required'=>'required',
                        'width'=>'100%');
         
         $body = $from->addInput('hidden',"old_kode",$kdkmktbkmk,null);

         $input = $from->addInput('text','kdkmk',$kdkmktbkmk,$attr); 
         $form_group = new form_group('Kode',$input);
         $kode= $form_group->display();

         $attr['id']='nama'; 
         $attr['placeholder']='Nama ...';
         $attr['data-msg']='Nama Harus Diisi !!!';
                  
         $input = $from->addInput('text','nama',$nakmktbkmk,$attr); 
         $form_group = new form_group('Nama',$input);
         $nama= $form_group->display();
         
         $divrowcol = new div_row_col($row,$col,array(array($kode,$nama)));
         $body .=  $divrowcol->display(); 


         $attr['id']='skstmtbkmk'; 
         unset($attr['placeholder']);
         $attr['data-msg']='SKS Tatap Muka Diisi !!!';
                  
         $input = $from->addInput('text','skstmtbkmk',$skstmtbkmk,$attr); 
         $form_group = new form_group('SKS Tatap Muka',$input);
         $sks1= $form_group->display();

         $attr['id']='sksprtbkmk';
         $attr['data-msg']='SKS Praktikum Diisi !!!';
                  
         $input = $from->addInput('text','sksprtbkmk',$sksprtbkmk,$attr); 
         $form_group = new form_group('SKS Praktikum',$input);
         $sks2= $form_group->display();

         $attr['id']='skslptbkmk';
         $attr['data-msg']='SKS Lapangan Diisi !!!';
                  
         $input = $from->addInput('text','skslptbkmk',$skslptbkmk,$attr); 
         $form_group = new form_group('SKS Lapangan',$input);
         $sks3= $form_group->display();

         $col = array('jml'=>3,'class'=>array('col-md-4','col-md-4','col-md-4'));
         $divrowcol = new div_row_col($row,$col,array(array($sks1,$sks2,$sks3)));
         $body .=  $divrowcol->display();


         $attr['id']='sem';
         $attr['data-msg']='Semester Dipilih !!!';         
         $input = $from->addSelectList("sem",array('01'=>'01','02'=>'02','03'=>'03','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08'),true,$semestbkmk,null,$attr);
         $form_group = new form_group('Semester',$input);
         $sem1 = $form_group->display(); 

         $attr['id']='wp';
         $attr['data-msg']='Wajib/Pilihan Dipilih !!!';
         $input = $from->addSelectList("wp",array('w'=>'Wajib','p'=>'Pilihan'),true,$wp,null,$attr);
         $form_group = new form_group('Wajib/Pilihan',$input);
         $wp1= $form_group->display();
         
         $col = array('jml'=>2,'class'=>array('col-md-6','col-md-6'));
         $divrowcol = new div_row_col($row,$col,array(array($sem1,$wp1)));
         $body .=  $divrowcol->display(); 

         $attr['id']='kdprtk';
         unset($attr['required']);
         unset($attr['data-msg']);

         $input = $from->addSelectList("kdprtk",$lstprtk,true,$kdprtk,null,$attr);
         $form_group = new form_group('Kode Praktikum',$input);
         $body .=  $form_group->display(); 

         $attr['id']='kddsn';
         $input = $from->addSelectList("kddsn",$lstkddsn,true,$nodostbkmk,null,$attr);
         $form_group = new form_group('Dosen Pengampu',$input);
         $body .=  $form_group->display(); 

                    $content[] = array('<div id="ketmtk"></div>');

                    $box=array('class'=>'box-primary');
                    $header_box = array('class'=>'','title'=>'Data Matakuliah');
                    
                    $tempbox=new box($box,$header_box,$body); 
                    $content[] = array($tempbox->display());      

                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,array(array($lstsyarat)));                 
                       

                    $header_box = array('class'=>'','title'=>'Prasyarat Matakuliah');
                    $body = $divrowcol->display();
                    $tempbox=new box($box,$header_box,$body); 
                    $content[] = array($tempbox->display());

                    $row = array('jml'=>3);
                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,$content); 
                    $body2 = $divrowcol->display();

                    $box=array('class'=>'');
                    $header_box = array('class'=>'with-border','title'=>$judul,'tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

                    $button = $from->addInput('button',"Close","Close",array('class'=>'btn btn-default pull-right','id'=>'close')).$from->addInput('submit',"Save","Save",array('class'=>'btn btn-primary pull-right','id'=>'save'));

                    $tempbox=new box($box,$header_box,$body2,$button); 
                    echo $tempbox->display();
         ?>      
    </form>