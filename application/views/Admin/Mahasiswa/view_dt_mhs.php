<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

     
      <form id="dtmhs" action="" method="post" >  
     
         <?php              
              $from = new html_form();
              echo $from->addInput('hidden',"nim",$nimhsmsmhs,null);
              $desc = new desc($view);                   
              $content[] = array($desc->display('dl-horizontal')); 


                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,$content); 
                    $body2 = $divrowcol->display();

                    $box=array('class'=>'');
                    $header_box = array('class'=>'with-border','title'=>$judul,'tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

                    $button = $from->addInput('button',"Close","Close",array('class'=>'btn btn-default pull-right','id'=>'close'));
                 if(($hak==1) and ($idx==2) ){
                    $button .= $from->addInput('submit',"Delete","Delete",array('class'=>'btn btn-primary pull-right','id'=>'delete'));
                  }   

                    $tempbox=new box($box,$header_box,$body2,$button); 
                    echo $tempbox->display();


         ?>      
    </form>