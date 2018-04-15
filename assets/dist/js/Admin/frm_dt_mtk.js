 function call_ajax(url, data, dataType, callback) {
     var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data;
     vmyajax.dataType = dataType;
     vmyajax.success = callback;
     vmyajax.getdata();
 }

 function initdatatable(istrue, idx) {
     var vmydatatable = new mydatatable;
     vmydatatable.id = 'lst_prasyarat';
     vmydatatable.template = 1;
     vmydatatable.title = 1;
     vmydatatable.bPaginate = istrue;
     vmydatatable.bInfo = istrue;
     vmydatatable.bFilter = istrue;
     //vmydatatable.scrollX =true;
     vmydatatable.bAutoWidth = false;
     if (idx == 0) {
         vmydatatable.aoColumns = [{
             "sWidth": "1%"
         }, {
             "sWidth": "1%"
         }, {
             "sWidth": "10%"
         }];
     } else {
         vmydatatable.aoColumns = [{
             "sWidth": "1%"
         }, {
             "sWidth": "1%"
         }, {
             "sWidth": "10%"
         }, {
             "sWidth": "1%"
         }];
     }
     vmydatatable.settemplate();
     oTable = vmydatatable.create();
 }

 function initdatatable1() {
     var vmydatatable = new mydatatable;
     vmydatatable.id = 'lst_mtk';
     vmydatatable.template = 1;
     vmydatatable.title = 1;
     vmydatatable.bPaginate = true;
     vmydatatable.bInfo = true;
     vmydatatable.bFilter = true;
     vmydatatable.settemplate();
     vmydatatable.footerfilter();
     if (hak == 1) {
         vmydatatable.dom = "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>";
         vmydatatable.buttons = [{
             text: 'Input Matakuliah',
             action: function(e, dt, node, config) {
                 call_ajax("frm_dt_mtk", 'idx=1', 'html', get_call);
             }
         }];
     }
     vmydatatable.bAutoWidth = false;
     vmydatatable.aoColumns = [{
         "sWidth": "1%"
     }, {
         "sWidth": "1%"
     }, {
         "sWidth": "10%"
     }, {
         "sWidth": "1%"
     }, {
         "sWidth": "2%"
     }, {
         "sWidth": "1%"
     }, {
         "sWidth": "2%"
     }];
     vmydatatable.settemplate();
     vmydatatable.footerfilter();
     oTable = vmydatatable.create();
 }

 function close_click() {
     $("#close").click(function() {
         $("#modal").html('');
     });
 }

 function gen_call(data) {
     if (data.msg == '') {
         $("#modal").html('');
         get_dt_mtk();
     } else {
         $('#ketmtk').html(data.msg);
     }
 }

 function view_call(data) {
     $("#modal").html(data);
     initdatatable(false, 0);
     close_click();
 }

 function del_call(data) {
     $("#modal").html('');
     get_dt_mtk();
 }

 function del1_call(data) {
     $("#modal").html(data);
     initdatatable(false, 0);
     submit_button('delete_dt_mtk');
     close_click();
 }

 function get_call(data) {
     $("#modal").html(data);
     initdatatable(true, 1);
     $("#dtmtk").validate();
     submit_button("insert_dt_mtk");
 }

 function get1_call(data) {
     $("#data").html(data);
     initdatatable1();
 }

 function edit_call(data) {
     $("#modal").html(data);
     initdatatable(true, 1);
     $("#dtmtk").validate();
     submit_button("save_dt_mtk");
 }

 function submit_button(url_ajax) {
     $("#dtmtk").submit(function(e) {
         //prevent Default functionality
         e.preventDefault();
         if (url_ajax != "delete_dt_mtk") {
             var isvalid = $("#dtmtk").valid();
             if (isvalid) {
                 call_ajax(url_ajax, $("#dtmtk").serialize(), 'json', gen_call);
             }
         } else {
             call_ajax(url_ajax, $("#dtmtk").serialize(), 'html', del_call);
         }
     });
     close_click();
 }

 function get_dt_mtk() {
     $("#data").html(box);
     call_ajax("get_dt_mtk", '', 'html', get1_call);
 }

 function edit(kode) {
     call_ajax("frm_dt_mtk", 'idx=2' + '&kode=' + kode, 'html', edit_call);
 }

 function del(kode) {
     call_ajax("view_dt_mtk", 'idx=2' + '&kode=' + kode, 'html', del1_call);
 }

 function view(kode) {
     call_ajax("view_dt_mtk", 'idx=1' + '&kode=' + kode, 'html', view_call);
 }