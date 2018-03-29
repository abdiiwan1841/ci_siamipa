<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $judul;?></h4>
      </div>
      <form id="dtdosen" action="" method="post" >  
      <div class="modal-body">
        <div id="ketdtdosen"></div>
         
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
         
         echo $from->addInput('hidden',"old_kode",$Kode,null);

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
         echo $divrowcol->display();   


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
         echo $divrowcol->display(); 

         $attr['id']='smawl'; 
         $attr['placeholder']='Honor Ngajar ...';

         $input = $from->addSelectList("smawl",$lst,true,$smawl,null,$attr);
         $form_group = new form_group('Awal Ngajar',$input);
         echo $form_group->display();
                 

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
         echo $divrowcol->display();
        

         $attr['id']='link_forlap'; 
         $attr['placeholder']='Link Forlap ...';
         
         $input = $from->addInput('text','link_forlap',$link_forlap,$attr); 
         $form_group = new form_group('Link Forlap',$input);
         echo $form_group->display();

        

         ?>


        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>           
      </div>
    </form>