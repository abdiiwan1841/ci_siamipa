 function call_ajax(url, data, dataType, callback) {
     var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data;
     vmyajax.dataType = dataType;
     vmyajax.success = callback;
     vmyajax.getdata();
 }

 function init_datatable() {
     //$("#lst_mhs").dataTable();
     var vmydatatable = new mydatatable;
     vmydatatable.id = 'lst_mhs';
     vmydatatable.template = 1;
     vmydatatable.title = 2;
     vmydatatable.bPaginate = true;
     vmydatatable.bInfo = true;
     vmydatatable.bFilter = true;
     if (hak == 1) {
         vmydatatable.dom = "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>";
         vmydatatable.buttons = [{
             text: 'Input Data Mahasiswa',
             action: function(e, dt, node, config) {
                 call_ajax("frm_dt_mhs", 'idx=1', 'html', inner_get_call);
             }
         }];
     }
     vmydatatable.settemplate();
     vmydatatable.footerfilter();
     oTable = vmydatatable.create();
 }

 function close_click() {
     $("#close").click(function() {
         $("#modal").html('');
     });
 }

 function gen_call() {
     if (data.msg == '') {
         $("#modal").html('');
         get_dt_mhs();
     } else {
         $('#ketdtmhs').html(data.msg);
     }
 }

 function inner_get_call(data) {
     $("#modal").html(data);
     $('#datepicker').datepicker({
         format: 'dd-mm-yyyy',
         autoclose: true
     });
     $("[data-mask]").inputmask();
     $("#dtmhs").validate();
     submit_button("insert_dt_mhs");
 }

 function get_call(data) {
     $("#data").html(data);
     init_datatable();
 }

 function inner_del_call(data) {
     $("#modal").html('');
     get_dt_mhs();
 }

 function del_call(data) {
     $("#modal").html(data);
     submit_button("delete_dt_mhs");
     close_click();
 }

 function edit_call(data) {
     $("#modal").html(data);
     $('#datepicker').datepicker({
         format: 'dd-mm-yyyy',
         autoclose: true
     });
     $("[data-mask]").inputmask();
     $("#dtmhs").validate();
     submit_button('save_dt_mhs');
 }

 function view_call(data) {
     $("#modal").html(data);
     close_click();
 }

 function submit_button(url_ajax) {
     $("#dtmhs").submit(function(e) {
         //prevent Default functionality
         e.preventDefault();
         if (url_ajax != 'delete_dt_mhs') {
             var isvalid = $("#dtmhs").valid();
             if (isvalid) {
                 call_ajax(url_ajax, $("#dtmhs").serialize(), 'json', gen_call);
             }
         } else {
             call_ajax(url_ajax, $("#dtmhs").serialize(), 'html', inner_del_call);
         }
     });
     close_click();
 }

 function get_dt_mhs() {
     $("#data").html(box);
     call_ajax("get_dt_mhs", '', 'html', get_call);
 }

 function edit(nim) {
     call_ajax("frm_dt_mhs", 'idx=2' + '&nim=' + nim, 'html', edit_call);
 }

 function del(nim) {
     call_ajax("view_dt_mhs", 'idx=2' + '&nim=' + nim, 'html', del_call);
 }

 function view(nim) {
     call_ajax("view_dt_mhs", 'idx=1' + '&nim=' + nim, 'html', view_call);
 }