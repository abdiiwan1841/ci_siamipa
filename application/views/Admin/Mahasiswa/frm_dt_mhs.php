<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      
      <form id="dtmhs" action="" method="post" >  
         
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
         
         $txt = $from->addInput('hidden',"old_nim",$nimhsmsmhs,null);

         $input = $from->addInput('text','nim',$nimhsmsmhs,$attr); 
         $form_group = new form_group('NIM',$input);
         $nim= $form_group->display();

         $attr['id']='nama'; 
         $attr['placeholder']='Nama ...';
         $attr['data-msg']='Nama Harus Diisi !!!';
         $attr['style']='text-transform:uppercase;';
         $attr['onkeyup']='javascript:this.value=this.value.toUpperCase();';
         
         $input = $from->addInput('text','nama',$nmmhsmsmhs,$attr); 
         $form_group = new form_group('Nama',$input);
         $nama= $form_group->display();
         
         $divrowcol = new div_row_col($row,$col,array(array($nim,$nama)));
         $txt.= $divrowcol->display();  


         $attr['id']='alamat'; 
         $attr['placeholder']='Alamat ...';
         
         unset($attr['data-msg']);
         unset($attr['style']);
         unset($attr['onkeyup']);
         unset($attr['required']);
         
         $input = $from->addInput('text','alamat',$almmsmhs,$attr); 
         $form_group = new form_group('Alamat',$input);
         $txt.=$form_group->display(); 

         $attr['id']='tlp'; 
         $attr['placeholder']='Nomor Telpon ...';
         
         $input = $from->addInput('text','tlp',$tlpmsmhs,$attr); 
         $form_group = new form_group('Nomor Telpon',$input);
         $tlp=$form_group->display();            

         $attr['id']='email'; 
         $attr['placeholder']='e-mail ...';
         
         $input = $from->addInput('text','email',$emailmsmhs,$attr); 
         $form_group = new form_group('e-mail',$input);
         $email = $form_group->display(); 
         
         $divrowcol = new div_row_col($row,$col,array(array($tlp,$email)));
         $txt.=$divrowcol->display();  


         $attr['id']='agama'; 
         $attr['placeholder']='agama ...';

         $input = $from->addSelectList("agama",array('0'=>'Islam','1'=>'Kristen Protestan','2'=>'Kristen Katolik','3'=>'Hindu','4'=>'Budha'),true,intval($agamamsmhs),null,$attr);
         $form_group = new form_group('Agama',$input);
         $agama = $form_group->display(); 

         $attr['id']='status'; 
         $attr['placeholder']='status ...';

         $input = $from->addSelectList("status",array('0'=>'Lajang','1'=>'Menikah'),true,intval($statmsmhs),null,$attr);
         $form_group = new form_group('Status Pernikahan',$input);
         $status= $form_group->display();

         $divrowcol = new div_row_col($row,$col,array(array($agama,$status)));
         $txt.=$divrowcol->display(); 

         $attr['id']='penddk'; 
         $attr['placeholder']='Pendidikan Terakhir ...';
         
         $input = $from->addInput('text','penddk',$smamsmhs,$attr); 
         $form_group = new form_group('Pendidikan Terakhir',$input);
         $txt.=$form_group->display();  

         
         $col = array('jml'=>3,'class'=>array('col-md-4','col-md-4','col-md-4'));

         $attr['id']='kelamin';      
         $attr['placeholder']='';    
         $input = $from->addSelectList("kelamin",array('L'=>'L - Laki-Laki','P'=>'P - Perempuan'),true,$kdjekmsmhs,null,$attr);
         $form_group = new form_group('Jenis Kelamin',$input);
         $jk=$form_group->display();


         $attr['id']='tempat'; 
         $attr['placeholder']='Tempat Lahir ...';
         
         $input = $from->addInput('text','tempat',$tplhrmsmhs,$attr); 
         $form_group = new form_group('Tempat Lahir',$input);
         $input_tempat=$form_group->display();  

         $attr['id']='datepicker'; 
         $attr['placeholder']='Tanggal Lahir ...';
         $attr['data-inputmask']='"mask": "99-99-9999"';
         $attr['data-mask']='data-mask'; 
                                
         $input = $from->addInput('text','datepicker',$tglhrmsmhs,$attr); 
         $form_group = new form_group('Tanggal Lahir',$input);
         $input_tgl=$form_group->display();

         
         $divrowcol = new div_row_col($row,$col,array(array($jk,$input_tempat,$input_tgl)));
         $txt.=$divrowcol->display();


         $attr['id']='bp'; 
         $attr['placeholder']='';
         unset($attr['data-inputmask']);
         unset($attr['data-mask']); 
                                
         $input = $from->addSelectList("bp",array('0'=>'Baru','1'=>'Pindahan'),true,intval($bpmsmhs),null,$attr);
         $form_group = new form_group('Baru/Pindahan',$input);
         $bp=$form_group->display();
         

         $attr['id']='kelas';          
         $input = $from->addSelectList("kelas",array('R'=>'R - Reguler','N'=>'N - Non Reguler'),true,$shiftmsmhs,null,$attr);
         $form_group = new form_group('Kelas',$input);
         $kelas = $form_group->display();

         $attr['id']='thnmsk'; 
         $attr['placeholder']='Tahun Masuk ...';
         $attr['data-inputmask']='"mask": "9999"';
         $attr['data-mask']='data-mask';
         $attr['data-msg']='Tahun Masuk Harus Diisi !!!';
         $attr['required']='required';
         
         $input = $from->addInput('text','thnmsk',$tahunmsmhs,$attr); 
         $form_group = new form_group('Tahun Masuk',$input);
         $thn=$form_group->display();

         $attr['id']='sem'; 
         $attr['placeholder']='';
         unset($attr['data-inputmask']);
         unset($attr['data-mask']);         
         unset($attr['data-msg']);
         unset($attr['required']);
                                
         $input = $from->addSelectList("sem",array('1'=>'Ganjil','2'=>'Genap'),true,intval($smawlmsmhs),null,$attr);
         $form_group = new form_group('Masuk di Semester',$input);
         $sem= $form_group->display(); 
         
         $col = array('jml'=>4,'class'=>array('col-md-3','col-md-3','col-md-3','col-md-3'));
         $divrowcol = new div_row_col($row,$col,array(array($bp,$kelas,$thn,$sem)));
         $txt.= $divrowcol->display();

         $attr['id']='link_forlap'; 
         $attr['placeholder']='Link Forlap ...';
         
         $input = $from->addInput('text','link_forlap',$link_forlap,$attr); 
         $form_group = new form_group('Link Forlap',$input);
         $txt.= $form_group->display();

                    $content[] = array('<div id="ketdtmhs"></div>');
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