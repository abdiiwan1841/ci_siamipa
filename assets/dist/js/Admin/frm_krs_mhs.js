function init_tb(id, idx) {
    var vmydatatable = new mydatatable;
    vmydatatable.id = id;
    vmydatatable.template = 1;
    vmydatatable.title = 2;
    mydatatable.bAutoWidth = false;
    switch (idx) {
        case 1:
            vmydatatable.aoColumns = [{
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "10%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }];
            break;
        case 2:
            vmydatatable.aoColumns = [{
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "10%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }];
            break;
        case 3:
            vmydatatable.aoColumns = [{
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "10%"
            }, {
                "sWidth": "1%"
            }, {
                "sWidth": "1%"
            }];
            break;
    }
    vmydatatable.settemplate();
    vmydatatable.create();
}

function call_ajax(url, data, dataType, callback) {
    var vmyajax = new myajax();
    vmyajax.url = url;
    vmyajax.data = data;
    vmyajax.dataType = dataType;
    vmyajax.success = callback;
    vmyajax.getdata();
}

function akrs_call(data) {
    $("#akrs").html(data);
    init_tb("tb_krs", 1);
}

function atdkkrs_call(data) {
    $("#atdkkrs").html(data);
    init_tb("tb_krs1", 1);
}

function lkrs_call(data) {
    $("#lkrs").html(data);
    init_tb("tb_krs2", 1);
}

function ltdkkrs_call(data) {
    $("#ltdkkrs").html(data);
    init_tb("tb_krs3", 1);
}

function Mig_krs_call(data)
{
  get_akrs();
}

function Del_krs_call(data)
{
  get_akrs();  
}

function get_akrs() {
    $("#akrs").html(load);
    call_ajax("akrs", "", 'html', akrs_call);
}

function get_atdkkrs() {
    $("#atdkkrs").html(load);
    call_ajax("atdkkrs", "", 'html', atdkkrs_call);
}

function get_lkrs() {
    $("#lkrs").html(load);
    call_ajax("lkrs", "", 'html', lkrs_call);
}

function get_ltdkkrs() {
    $("#ltdkkrs").html(load);
    call_ajax("ltdkkrs", "", 'html', ltdkkrs_call);
}

function pilih_mtk(kode) {
    cek = 0;
    if ($('#mk_' + kode).is(':checked')) {
        cek = 1;
    }
    var vmyajax = new myajax();
    vmyajax.url = "pilih_mtk_krs";
    vmyajax.data = 'kode=' + kode + '&cek=' + cek;
    vmyajax.dataType = 'JSON';
    vmyajax.success = function success(data) {
        $("#jmlsks").html(data.jmlsks);
        $('#kls_' + kode).attr('disabled', true);
        if (cek == 1) {
            $('#kls_' + kode).attr('disabled', false);
        }
    }
    vmyajax.getdata();
}

function input_kls(kode) {
    kls = $('#kls_' + kode).val();
    var vmyajax = new myajax();
    vmyajax.url = "input_kls";
    vmyajax.data = 'kode=' + kode + '&kls=' + kls;
    vmyajax.dataType = 'JSON';
    vmyajax.success = function success(data) {}
    vmyajax.getdata();
}

function save_call(data) {
    if (data.msg != '') {
        $("#ketkrs").html(data.msg);
    } else {
        edit(nim);        
    }
}

function ambil_call(data) {
    $("#data1").html(data.lst_mtk);
    $("#btn").html(data.btn);
    init_tb("lst_mtk", 2);
    btn_ajax('save_ambil', "save_ambil", "nim=" + nim, 'json', save_call);
    btn_cancel();
}

function ulang_call(data) {
    $("#data1").html(data.lst_mtk);
    $("#btn").html(data.btn);
    init_tb("lst_mtk", 2);
    btn_ajax('save_ulang', "save_ulang", "nim=" + nim, 'json', save_call);
    btn_cancel();
}

function edit_call(data) {
    $("#data1").html(data.lst_mtk);
    $("#btn").html(data.btn);
    init_tb("lst_mtk", 3);
    btn_ajax('save_kelas', "save_kelas", "nim=" + nim, 'json', save_call);
    btn_cancel();
}

function hapus_call(data) {
    $("#data1").html(data.lst_mtk);
    $("#btn").html(data.btn);
    init_tb("lst_mtk", 3);
    btn_ajax('del_krs', "hapus_krs", "nim=" + nim, 'json', save_call);
    btn_cancel();
}

function btn_cancel() {
    $('#cancel').click(function() {
        edit(nim);
    });
}

function btn_ajax(idbtn, url, data, dataType, callback) {
    $('#' + idbtn).click(function() {
        call_ajax(url, data, dataType, callback);
    });
}