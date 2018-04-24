<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class js_css
{
  private $plugin_path;
  private $dist_path;
  private $bootstrap_path;
  private $img_path;
  private $js_css_data;
  private $cloudflare_path;
  
  
  function __construct()
	{
		$this->plugin_path=base_url().'assets/plugins/';
		$this->dist_path=base_url().'assets/dist/';
		$this->bootstrap_path=base_url().'assets/bootstrap/';
		$this->img_path=base_url().'assets/img/';
		$this->cloudflare_path='https://cdnjs.cloudflare.com/ajax/libs/';
    $this->datatble_button_path='https://cdn.datatables.net/buttons/1.5.1/';

        $this->js_css_data = array();

        $this->js_css_data['bootstrap']['css']=array(array('urut'=>0,'path'=>$this->bootstrap_path.'css/bootstrap.min.css'));
        $this->js_css_data['bootstrap']['js']=array(array('urut'=>2,'path'=>$this->bootstrap_path.'js/bootstrap.min.js'));

        $this->js_css_data['default']['css']=array(array('urut'=>1,'path'=>$this->dist_path.'css/AdminLTE.min.css'));
        $this->js_css_data['default']['js']=array(array('urut'=>1,'path'=>$this->plugin_path.'jQuery/jquery-2.2.3.min.js'),
                                                  array('urut'=>3,'path'=>$this->dist_path.'js/app.min.js'));
        
        $this->js_css_data['icon']['css']=
        array(array('urut'=>2,'path'=>$this->cloudflare_path.'font-awesome/4.5.0/css/font-awesome.min.css'),
        	    array('urut'=>3,'path'=>$this->cloudflare_path.'ionicons/2.0.1/css/ionicons.min.css'));

        $this->js_css_data['all_skin']['css']=array(array('urut'=>4,'path'=>$this->dist_path.'css/skins/_all-skins.min.css'));

        $this->js_css_data['icon_unibba']['icon']=$this->img_path.'unibba.ico';

        $this->js_css_data['validate']['js']=array(array('urut'=>4,'path'=>$this->cloudflare_path.'jquery-validate/1.17.0/jquery.validate.js'));
        $this->js_css_data['canvas']['js']=array(array('urut'=>5,'path'=>$this->plugin_path.'canvasjs/jquery.canvasjs.min.js'));
        $this->js_css_data['fastclick']['js']=array(array('urut'=>6 ,'path'=>$this->plugin_path.'fastclick/fastclick.js'));

        $this->js_css_data['datatables']['css']=array(
                                                    array('urut'=>5,'path'=>$this->plugin_path.'datatables/dataTables.bootstrap.css'),
                                                    array('urut'=>6,'path'=>$this->datatble_button_path.'css/buttons.dataTables.min.css'));
        $this->js_css_data['datatables']['js']=array(
                                                     array('urut'=>7,'path'=>$this->plugin_path.'datatables/jquery.dataTables.min.js'),
                                                     array('urut'=>8,'path'=>$this->plugin_path.'datatables/dataTables.bootstrap.min.js'),
                                                     array('urut'=>9,'path'=>$this->datatble_button_path.'js/dataTables.buttons.min.js'));
          
        $this->js_css_data['datepicker']['css']=array(array('urut'=>7,'path'=>$this->plugin_path.'datepicker/datepicker3.css'));
        $this->js_css_data['datepicker']['js']=array(array('urut'=>10,'path'=>$this->plugin_path.'datepicker/bootstrap-datepicker.js'));

        $this->js_css_data['input-mask']['js']=array(
                                                      array('urut'=>11,'path'=>$this->plugin_path.'input-mask/jquery.inputmask.js'),
                                                      array('urut'=>12,'path'=>$this->plugin_path.'input-mask/jquery.inputmask.date.extensions.js'),
                                                      array('urut'=>13,'path'=>$this->plugin_path.'input-mask/jquery.inputmask.extensions.js')
                                               );
       
	}

   private function ctk_css($path)
   {   	                   
        return '<link rel="stylesheet" href="'.$path.'">'.PHP_EOL;    
   }

   private function ctk_js($path)
   {
        return '<script src="'.$path.'"></script>'.PHP_EOL;  
   }

   private function ctk_icon($path)
   {
   	    return '<link rel="icon" href="'.$path.'" type="image/x-icon">'.PHP_EOL;
   }


   function display($js_css)
   {
   	 $lst_css=array();
     $lst_js=array();

     $txt='';
   	
     $js_css_arr=array_filter($this->js_css_data,
                            function ($var) use ($js_css) {
                               return in_array($var, $js_css);
                             },ARRAY_FILTER_USE_KEY);
                          
     array_walk($js_css_arr, 
                   function ($arr)use(&$lst_css,&$lst_js) {
                   if(isset($arr['css'])){
                       array_walk($arr['css'], function($arr)use(&$lst_css,&$lst_js){
                                           $lst_css[$arr['urut']]=$arr['path'];
                                         });
                   }
                   if(isset($arr['js'])){
                       array_walk($arr['js'], function($arr)use(&$lst_css,&$lst_js){
                                           $lst_js[$arr['urut']]=$arr['path'];
                                         });
                   }
                }
               );

   	 ksort($lst_js,1);
     ksort($lst_css,1);
     array_walk($lst_css, function($path)use(&$txt){$txt.=$this->ctk_css($path);});
     array_walk($lst_js, function($path)use(&$txt){$txt.=$this->ctk_js($path);});

     foreach ($this->js_css_data as $key => $js_css_arr) {
   	 	if(in_array($key, $js_css) and isset($js_css_arr['icon'])){
   	 	  	 $txt.=$this->ctk_icon($js_css_arr['icon']);   	 	   
   	  	}
   	 }
   	 return $txt;
   }	

}