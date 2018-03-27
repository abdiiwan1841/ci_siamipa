<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $judul;?></h4>
      </div>
      <form id="dtmhs" action="" method="post" >  
      <div class="modal-body">
        <div id="ketdtmhs"></div>
         
         <?php 
        
         $row = array('jml'=>1);
         $col = array('jml'=>2,'class'=>array('col-md-6','col-md-6'));

         $from = new html_form(); 
         $attr = array('class'=>'form-control',
                        'id'=>'nim',
                        'placeholder'=>'NIM ...',
                        'data-msg'=>'NIM Harus Diisi !!!',
                        'required'=>'required',
                        'width'=>'100%');

         $input = $from->addInput('text','nim','',$attr); 
         $form_group = new form_group('NIM',$input);
         $nim= $form_group->display();

         $attr['id']='nama'; 
         $attr['placeholder']='Nama ...';
         $attr['data-msg']='Nama Harus Diisi !!!';
         $attr['style']='text-transform:uppercase;';
         $attr['onkeyup']='javascript:this.value=this.value.toUpperCase();';
         
         $input = $from->addInput('text','nama','',$attr); 
         $form_group = new form_group('Nama',$input);
         $nama= $form_group->display();
         
         $divrowcol = new div_row_col($row,$col,array(array($nim,$nama)));
         echo $divrowcol->display();  


         $attr['id']='alamat'; 
         $attr['placeholder']='Alamat ...';
         
         unset($attr['data-msg']);
         unset($attr['style']);
         unset($attr['onkeyup']);
         unset($attr['required']);
         
         $input = $from->addInput('text','alamat','',$attr); 
         $form_group = new form_group('Alamat',$input);
         echo $form_group->display(); 

         $attr['id']='tlp'; 
         $attr['placeholder']='Nomor Telpon ...';
         
         $input = $from->addInput('text','tlp','',$attr); 
         $form_group = new form_group('Nomor Telpon',$input);
         $tlp=$form_group->display();            

         $attr['id']='email'; 
         $attr['placeholder']='e-mail ...';
         
         $input = $from->addInput('text','email','',$attr); 
         $form_group = new form_group('e-mail',$input);
         $email = $form_group->display(); 
         
         $divrowcol = new div_row_col($row,$col,array(array($tlp,$email)));
         echo $divrowcol->display();  


         $attr['id']='agama'; 
         $attr['placeholder']='agama ...';

         $input = $from->addSelectList("agama",array('0'=>'Islam','1'=>'Kristen Protestan','2'=>'Kristen Katolik','3'=>'Hindu','4'=>'Budha'),true,null,null,$attr);
         $form_group = new form_group('Agama',$input);
         $agama = $form_group->display(); 

         $attr['id']='status'; 
         $attr['placeholder']='status ...';

         $input = $from->addSelectList("status",array('0'=>'Lajang','1'=>'Menikah'),true,null,null,$attr);
         $form_group = new form_group('Status Pernikahan',$input);
         $status= $form_group->display();

         $divrowcol = new div_row_col($row,$col,array(array($agama,$status)));
         echo $divrowcol->display(); 

         $attr['id']='penddk'; 
         $attr['placeholder']='Pendidikan Terakhir ...';
         
         $input = $from->addInput('text','penddk','',$attr); 
         $form_group = new form_group('Pendidikan Terakhir',$input);
         echo $form_group->display();  

         
         $col = array('jml'=>3,'class'=>array('col-md-4','col-md-4','col-md-4'));

         $attr['id']='kelamin';      
         $attr['placeholder']='';    
         $input = $from->addSelectList("kelamin",array('L'=>'L - Laki-Laki','P'=>'P - Perempuan'),true,null,null,$attr);
         $form_group = new form_group('Jenis Kelamin',$input);
         $jk=$form_group->display();


         $attr['id']='tempat'; 
         $attr['placeholder']='Tempat Lahir ...';
         
         $input = $from->addInput('text','tempat','',$attr); 
         $form_group = new form_group('Tempat Lahir',$input);
         $input_tempat=$form_group->display();  

         $attr['id']='datepicker'; 
         $attr['placeholder']='Tanggal Lahir ...';
         $attr['data-inputmask']='"mask": "99-99-9999"';
         $attr['data-mask']='data-mask'; 
                                
         $input = $from->addInput('text','datepicker','',$attr); 
         $form_group = new form_group('Tanggal Lahir',$input);
         $input_tgl=$form_group->display();

         
         $divrowcol = new div_row_col($row,$col,array(array($jk,$input_tempat,$input_tgl)));
         echo $divrowcol->display();


         $attr['id']='bp'; 
         $attr['placeholder']='';
         unset($attr['data-inputmask']);
         unset($attr['data-mask']); 
                                
         $input = $from->addSelectList("bp",array('0'=>'Baru','1'=>'Pindahan'),true,null,null,$attr);
         $form_group = new form_group('Baru/Pindahan',$input);
         $bp=$form_group->display();
         

         $attr['id']='kelas';          
         $input = $from->addSelectList("kelas",array('R'=>'R - Reguler','N'=>'N - Non Reguler'),true,null,null,$attr);
         $form_group = new form_group('Kelas',$input);
         $kelas = $form_group->display();

         $attr['id']='thnmsk'; 
         $attr['placeholder']='Tahun Masuk ...';
         $attr['data-inputmask']='"mask": "9999"';
         $attr['data-mask']='data-mask';
         $attr['data-msg']='Tahun Masuk Harus Diisi !!!';
         $attr['required']='required';
         
         $input = $from->addInput('text','thnmsk','',$attr); 
         $form_group = new form_group('Tahun Masuk',$input);
         $thn=$form_group->display();

         $attr['id']='sem'; 
         $attr['placeholder']='';
         unset($attr['data-inputmask']);
         unset($attr['data-mask']);         
         unset($attr['data-msg']);
         unset($attr['required']);
                                
         $input = $from->addSelectList("sem",array('1'=>'Ganjil','2'=>'Genap'),true,null,null,$attr);
         $form_group = new form_group('Masuk di Semester',$input);
         $sem= $form_group->display(); 
         
         $divrowcol = new div_row_col($row,$col,array(array($kelas,$thn,$sem)));
         echo $divrowcol->display();

         $attr['id']='link_forlap'; 
         $attr['placeholder']='Link Forlap ...';
         
         $input = $from->addInput('text','link_forlap','',$attr); 
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