<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$box=array('class'=>'');
$header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));                  

$body2='<div id="ketkrs"></div><div id="data1">'.$lst_krs.'</div>'; 

$frm = new html_form();
$button = '<div id="btn">';
if($hak==1){
      $button.=$frm->addInput('submit',"ambil","Ambil Mtk. Baru",array('class'=>'btn btn-info pull-left','id'=>'ambil')).
      $frm->addInput('submit',"ulang","Ulang Mtk.",array('class'=>'btn btn-info pull-left','id'=>'ulang')).
      $frm->addInput('submit',"edit","Edit Kelas",array('class'=>'btn btn-info pull-left','id'=>'edit')).
      $frm->addInput('submit',"hapus","Hapus Mtk.",array('class'=>'btn btn-info pull-left','id'=>'hapus'));
} 
$button .= $frm->addInput('submit',"ctkexcel","Cetak ke Excel",array('class'=>'btn btn-info pull-left','id'=>'ctkexcel')).
           $frm->addInput('submit',"ctkpdf","Cetak ke PDF",array('class'=>'btn btn-info pull-left','id'=>'ctkpdf')).
           $frm->addInput('submit',"Close","Close",array('class'=>'btn btn-info pull-right','id'=>'close')).'</div>';

$header_box['title']='Kartu Rencana Studi (KRS) : '.$nm.' ('.$nim.')';
$tempbox= new box($box,$header_box,$body2,$button); 
echo $tempbox->display();
?>    



 