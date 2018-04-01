<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $judul;?></h4>
      </div>
      <form id="dtmtk" action="" method="post" >  
      <div class="modal-body">
        <div id="ketmtk"></div>
         
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

                    $box=array('class'=>'box-primary');
                    $header_box = array('class'=>'','title'=>'Data Matakuliah');
                    
                    $tempbox=new box($box,$header_box,$body); 
                    echo $tempbox->display();      

                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,array(array($lstsyarat)));                 
                       

                    $header_box = array('class'=>'','title'=>'Prasyarat Matakuliah');
                    $body = $divrowcol->display();
                    $tempbox=new box($box,$header_box,$body); 
                    echo $tempbox->display();

         ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>           
      </div>
    </form>