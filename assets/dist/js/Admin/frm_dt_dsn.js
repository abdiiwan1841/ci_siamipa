 function call_ajax(url, data, dataType, callback) {
     var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data;
     vmyajax.dataType = dataType;
     vmyajax.success = callback;
     vmyajax.getdata();
 }

 function call_ajax_1(url, data1, dataType, idx) {
     var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data1;
     vmyajax.dataType = dataType;
     vmyajax.success = function success(data) {
         $("#modal").html(data);
         if (idx <= 2) {
             $("#dtdosen").validate();
         }
         submit_click(idx);
         close_click();
     }
     vmyajax.getdata();
 }

 function gen_call(data) {
     if (data.msg == '') {
         $("#modal").html('');
         get_dt_dosen();
     } else {
         $('#ketdtdosen').html(data.msg);
     }
 }

 function del_call(data) {
     $("#modal").html('');
     get_dt_dosen();
 }

 function view_call(data) {
     $("#modal").html(data);
     close_click();
 }

 function close_click() {
     $("#close").click(function() {
         $("#modal").html('');
     });
 }

 function submit_click(idx) {
     $("#dtdosen").submit(function(e) {
         //prevent Default functionality
         e.preventDefault();
         if (idx <= 2) {
             var isvalid = $("#dtdosen").valid();
             if (isvalid) {
                 if (idx == 1) {
                     call_ajax("insert_dt_dosen", $("#dtdosen").serialize(), 'json', gen_call);
                 } else {
                     call_ajax("save_dt_dosen", $("#dtdosen").serialize(), 'json', gen_call);
                 }
             }
         } else {
             call_ajax("delete_dt_dosen", $("#dtdosen").serialize(), 'html', del_call);
         }
     });
 }

 function edit(kode) {
     call_ajax_1("frm_dt_dosen", 'idx=2' + '&kode=' + kode, 'html', 2);
 }

 function del(kode) {
     call_ajax_1("view_dt_dosen", 'idx=2' + '&kode=' + kode, 'html', 3);
 }

 function view(kode) {
     call_ajax("view_dt_dosen", 'idx=1' + '&kode=' + kode, 'html', view_call);
 }

 function init_datatable() {
     var vmydatatable = new mydatatable;
     vmydatatable.id = 'lst_dsn';
     vmydatatable.template = 0;
     vmydatatable.title = 0;
     vmydatatable.bPaginate = true;
     vmydatatable.bInfo = true;
     vmydatatable.bFilter = true;
     vmydatatable.settemplate();
     vmydatatable.footerfilter();
     if (hak == 1) {
         vmydatatable.dom = "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>";
         vmydatatable.buttons = [{
             text: 'Input Data Dosen',
             action: function(e, dt, node, config) {
                 call_ajax_1("frm_dt_dosen", 'idx=1', 'html', 1);
             }
         }];
     }
     vmydatatable.bAutoWidth = false;
     vmydatatable.aoColumns = [{
         "sWidth": "1%"
     }, {
         "sWidth": "5%"
     }, {
         "sWidth": "1%"
     }, {
         "sWidth": "1%"
     }, {
         "sWidth": "2%"
     }, {
         "sWidth": "2%"
     }, {
         "sWidth": "2%"
     }, {
         "sWidth": "2%"
     }];
     vmydatatable.settemplate();
     vmydatatable.footerfilter();
     oTable = vmydatatable.create();
 }

 function get_call(data) {
     $("#data").html(data);
     init_datatable();
 }

 function get_dt_dosen() {
     $("#data").html(box);
     call_ajax("get_dt_dosen", '', 'html', get_call);
 }