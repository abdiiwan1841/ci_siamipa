function cancel_click()
  {
    $("#cancel").click(function () {
       edit(nim); 
    });
  }

  function btn_click(id,url, data, dataType, callback) {
    $(id).click(function () {
        call_ajax(url, data, dataType, callback);                   
    });
  }

  function btn1_click(id,id2,url, data, dataType, callback) {
    $(id).click(function () {
        $(id2).html(box);
        call_ajax(url, data, dataType, callback);                   
    });
  }

  function call_ajax(url, data, dataType, callback) {
     var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data;
     vmyajax.dataType = dataType;
     vmyajax.success = callback;
     vmyajax.getdata();
 }

 function gen_call(data) {
   get_dt_konversi(); 
   edit(nim);
 }

 function gen2(data,idx) {
   $("#data1").html(data.lst_mtk);
   $("#btn").html(data.btn);
   init_datatable('lst_mtk',idx);
   cancel_click();
 }

 function get_call(data) {
   $("#data").html(data);
   init_datatable('lst_mhs',1);
 }

 function edit1_call(data) {
         $("#frmedt").html(data);   
         init_datatable('lst_konversi',2);
         btn1_click("#add","#data1","add_mtk_konversi",'nim='+nim,'JSON',add_call);
         btn1_click("#edit","#data1","edit_mtk_konversi",'nim='+nim,'JSON',edit_call);
         btn1_click("#del","#data1","del_mtk_konversi",'nim='+nim,'JSON',del_call);
         btn1_click("#eksport","#data1","export_mtk_konversi",'nim='+nim,'html',gen_call);
 }

 function add_call(data) {
   gen2(data,3);
   btn_click("#save_add","insert_mtk_konversi", 'nim='+nim, 'html', gen_call);
 }

 function edit_call(data) {
   gen2(data,4);
   btn_click("#save_edit","update_mtk_konversi", 'nim='+nim, 'html', gen_call);
 }

 function del_call(data) {
   gen2(data,1);
   btn_click("#del","delete_mtk_konversi", 'nim='+nim, 'html', gen_call);
 }

  function pilih_mtk(kode)
  {
    
     if($('#mk_'+kode).is(':checked'))
     { 
       $("input[id^=nilaiA_"+kode+"]:radio").attr('disabled', false);
       $("input[id^=nilaiB_"+kode+"]:radio").attr('disabled', false);
       $("input[id^=nilaiC_"+kode+"]:radio").attr('disabled', false);
       $("input[id^=nilaiD_"+kode+"]:radio").attr('disabled', false);
       $("input[id^=nilaiE_"+kode+"]:radio").attr('disabled', false);
       cek=1;
     }else{
       $("input[id^=nilaiA_"+kode+"]:radio").attr('disabled', true);
       $("input[id^=nilaiA_"+kode+"]:radio").attr('checked', false);
       $("input[id^=nilaiB_"+kode+"]:radio").attr('disabled', true);
       $("input[id^=nilaiB_"+kode+"]:radio").attr('checked', false);
       $("input[id^=nilaiC_"+kode+"]:radio").attr('disabled', true);
       $("input[id^=nilaiC_"+kode+"]:radio").attr('checked', false);
       $("input[id^=nilaiD_"+kode+"]:radio").attr('disabled', true);
       $("input[id^=nilaiD_"+kode+"]:radio").attr('checked', false);
       $("input[id^=nilaiE_"+kode+"]:radio").attr('disabled', true);
       $("input[id^=nilaiE_"+kode+"]:radio").attr('checked', false);
       cek=0;
     }

     var vmyajax = new myajax();
     vmyajax.url = "pilih_mtk_konversi";
     vmyajax.data = 'kode='+kode+'&cek='+cek;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
        $("#jmlsks").html(data.jmlsks);
     }
     vmyajax.getdata();
  }

  function input_nilai(kode,nm)
  {
     var vmyajax = new myajax();
     vmyajax.url = "nilai_mtk_konversi";
     vmyajax.data = 'kode='+kode+'&nm='+nm;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
        
     }
     vmyajax.getdata();
  }

  function init_datatable(id,idx) {
          var vmydatatable = new mydatatable;
              vmydatatable.id = id;
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              vmydatatable.bPaginate = true;
              vmydatatable.bInfo = true;
              vmydatatable.bFilter= true;
              vmydatatable.bAutoWidth= false;
          switch(idx){    
           case 1 : vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "2%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                     
                                     ];break; 
           case 2 : vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "2%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}
                                     ];break;
            case 3 : vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "2%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}
                                     ];break;
            case 4 : vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "2%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}
                                     ]; break;                                                                                                                         
           }                          
              
              vmydatatable.settemplate();       
              vmydatatable.create();
  }




  function get_dt_konversi()
  {
     $("#data").html(box);
     call_ajax("get_dt_konversi", '', 'html', get_call);
  } 

 function edit(var_nim)
 {
     $("#frmedt").html(box);
     nim=var_nim;
     call_ajax("edt_dt_pindahan", 'nim='+nim, 'html', edit1_call);
 }