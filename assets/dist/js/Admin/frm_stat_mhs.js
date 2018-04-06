var oTable; 

  function initdatatable()
  {
    vmydatatable = new mydatatable;
    vmydatatable.id = 'lst_stat';
    vmydatatable.template = 1;
    vmydatatable.title = 2;
    vmydatatable.settemplate();
    oTable = vmydatatable.create();
  }

  function call_ajax(url,data,dataType,callback)
  {
    var vmyajax = new myajax();
     vmyajax.url = url;
     vmyajax.data = data;
     vmyajax.dataType = dataType;
     vmyajax.success = callback;
     vmyajax.getdata();
  }

  function filter_call(data)
  {
          $("#data").html(data.stat);
          $("#data1").html(data.sum);
          $("#txt").html(data.txt);
          $("#txt1").html(data.txt);
          $("#btn").html('');
          
          initdatatable();   

          vmydatatable = new mydatatable;
          vmydatatable.id = 'lst_summary';
          vmydatatable.bFilter = true;
          vmydatatable.bPaginate = true;
          vmydatatable.bInfo = true;
          vmydatatable.create();
  }

  function add_call(data)
  {
          $("#data").html(data.form);
          $("#btn").html(data.btn);
          initdatatable();
          btn_click("add_save","insert_stat_mhs");
  }

  function edit_call(data)
  {
          $("#data").html(data.form);
          $("#btn").html(data.btn);
          initdatatable();
          btn_click("edit_save","save_stat_mhs");
  }

  function delete_call(data)
  {
          $("#data").html(data.form);
          $("#btn").html(data.btn);
          initdatatable();
          btn_click("del_save","delete_stat_mhs");
  }

  function gen_call(data)
  {
    filter();
  }

  function btn_click(id_button,url_ajax)
  {
          $("#"+id_button).click(function () {
            $("#btn").html('');
            var sem = $("#sem").val();
            call_ajax(url_ajax,$(":input",oTable.fnGetNodes()).serialize()+"&sem=" + sem,'html',gen_call);             
          });
  } 