<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        
      <form id="dtdosen" action="" method="post" >  
      
        
         
         <?php 

         $row = array('jml'=>1);
         $col = array('jml'=>2,'class'=>array('col-md-6','col-md-6'));

         $from = new html_form(); 
         $attr = array('class'=>'form-control',
                        'id'=>'kode',
                        'placeholder'=>'Kode ...',
                        'data-msg'=>'Kode Harus Diisi !!!',
                        'required'=>'required',
                        'width'=>'100%');
         
         $txt = $from->addInput('hidden',"old_kode",$Kode,null);

         $input = $from->addInput('text','kode',$Kode,$attr); 
         $form_group = new form_group('Kode',$input);
         $kode= $form_group->display();

         $attr['id']='nama'; 
         $attr['placeholder']='Nama ...';
         $attr['data-msg']='Nama Harus Diisi !!!';
                  
         $input = $from->addInput('text','nama',$Nama,$attr); 
         $form_group = new form_group('Nama',$input);
         $nama= $form_group->display();
         
         $divrowcol = new div_row_col($row,$col,array(array($kode,$nama)));
         $txt .= $divrowcol->display();   


         $attr['id']='tstat'; 
         $attr['placeholder']='Status Dosen ...';
         unset($attr['required']);
         
         $input = $from->addSelectList("tstat",array('DTT'=>'DTT - Dosen Tidak Tetap','DTY'=>'DTY - Dosen Tetap Yayasan','DTYLP'=>'DTYLP - Dosen Tetap Yayasan Luar Prodi','LB'=>'LB - Dosen Luar Biasa'),true,$Tstat,null,$attr);
         $form_group = new form_group('Status Dosen',$input);
         $statdsn = $form_group->display(); 

         $attr['id']='hstat'; 
         $attr['placeholder']='Honor Ngajar ...';

         $input = $from->addSelectList("hstat",array('DTT'=>'DTT - Dosen Tidak Tetap','DTY'=>'DTY - Dosen Tetap Yayasan','DTYLP'=>'DTYLP - Dosen Tetap Yayasan Luar Prodi','LB'=>'LB - Dosen Luar Biasa'),true,$Hstat,null,$attr);
         $form_group = new form_group('Honor Ngajar',$input);
         $hnr= $form_group->display();

         $divrowcol = new div_row_col($row,$col,array(array($statdsn,$hnr)));
         $txt .= $divrowcol->display(); 

         $attr['id']='smawl'; 
         $attr['placeholder']='Honor Ngajar ...';

         $input = $from->addSelectList("smawl",$lst,true,$smawl,null,$attr);
         $form_group = new form_group('Awal Ngajar',$input);
         $txt .= $form_group->display();
                 

         $attr['id']='nidn1'; 
         $attr['placeholder']='NIDN ...';
         
         $input = $from->addInput('text','nidn1',$nidn,$attr); 
         $form_group = new form_group('NIDN',$input);
         $input_tempat=$form_group->display();  

         $attr['id']='nidn2'; 
         $attr['placeholder']='NIDN EPSBED ...';         
                                
         $input = $from->addInput('text','nidn2',$nidn_epsbed,$attr); 
         $form_group = new form_group('NIDN EPSBED',$input);
         $input_tgl=$form_group->display();

         
         $divrowcol = new div_row_col($row,$col,array(array($input_tempat,$input_tgl)));
         $txt .= $divrowcol->display();
        

         $attr['id']='link_forlap'; 
         $attr['placeholder']='Link Forlap ...';
         
         $input = $from->addInput('text','link_forlap',$link_forlap,$attr); 
         $form_group = new form_group('Link Forlap',$input);
         $txt .= $form_group->display();
                    
                    $content[] = array('<div id="ketdtdosen"></div>');
                    $content[] = array($txt);  

                    $row = array('jml'=>2);
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