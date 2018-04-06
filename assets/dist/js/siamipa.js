
function myajax() {
	this.type = 'post';
	this.cache = false;
	this.url = '';
	this.data = '';
	this.dataType = 'html';
	this.success = function (data) {};
	this.error   = function(jqXHR, textStatus, errorThrown) {}
	this.getdata = function () {
		var self = this;
		$.ajax({
			type : this.type,
			url : this.url,
			cache : this.cache,
			data : this.data,
			dataType : this.dataType,
			success : this.success,
			error   : this.error
		});
	};

}

function mychart() {
	this.title = {};
	this.subtitles = [];
	this.animationEnabled = true;
	this.toolTip = {};
	this.axisY = {};
	this.axisX = {};
	this.data = [];
	this.id = '';
	this.width = 920;
	this.height = 300;
	this.gambarchart = function () {
		$("#" + this.id).CanvasJSChart(this);
	};
}

function mydatatable() {
	var oTable;
	var asInitVals = new Array();
	this.id = '';
	this.template = 0;
	this.title = 0;
	this.bProcessing = true;
	this.bFilter = false;
	this.bSort = false;
	this.bPaginate = false;
	this.bInfo = false;
	this.idxdetail=0;
	this.fnDrawCallback = function (oSettings) {};
	this.aoColumnDefs = [];
	this.aaSortingFixed = [];
	this.aaSorting = [];
	this.dom = "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>";
	this.buttons = [];
	this.bProcessing = false;
    this.bServerSide = false;
    this.sAjaxSource = null;
	this.sServerMethod= null;
	this.fnServerParams=null;
	this.scrollX=false;
	this.oLanguage = {};
	this.src_open = 'details_open.png';
	this.src_close = 'details_close.png';
	this.settemplate = function () {
		switch (this.template) {
		case 1:
			var namatb = this.id;
			var title = this.title;
			var ss = this.bServerSide;
			this.fnDrawCallback = function (oSettings) {
				if (oSettings.aiDisplay.length == 0) {
					return;
				}

				var nTrs = $('#' + namatb + ' tbody tr');
				var iColspan = nTrs[0].getElementsByTagName('td').length;
				var sLastGroup = "";
				for (var i = 0; i < nTrs.length; i++) {				  	
					var iDisplayIndex = oSettings._iDisplayStart + i;
					if(ss){
					 var sGroup = oSettings.aoData[oSettings.aiDisplay[i]]._aData[0];	
					}else{
					 var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData[0];
					}
					if (sGroup != sLastGroup) {
						var nGroup = document.createElement('tr');
						var nCell = document.createElement('td');
						nCell.colSpan = iColspan;
						nCell.className = "group";
						nCell.innerHTML = sGroup;
						nGroup.appendChild(nCell);
						nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
						sLastGroup = sGroup;
					}
				}
			};
			this.aoColumnDefs = [{
					"bVisible" : false,
					"aTargets" : [0]}
			];
			this.aaSortingFixed = [[0, 'asc']];
			this.aaSorting = [[1, 'asc']];
			//this.sDom= 'lfr<"giveHeight"t>ip';
			this.oLanguage = {
				"sSearch" : "Search all columns:"
			};
			this.bFilter = true;
			this.bPaginate = true;
			this.bInfo = true;
			break;
		case 2:

			break;
		}
	};
    
	this.rowselected=function()
	{
		$("#" + this.id + " tbody tr").click(function (e) {
			if ($(this).hasClass('row_selected')) {
				$(this).removeClass('row_selected');
			} else {
				oTable.$('tr.row_selected').removeClass('row_selected');
				$(this).addClass('row_selected');
			}
		});
	};
	
	this.togle = function () {
		var nCloneTh = document.createElement('th');
		var nCloneTd = document.createElement('td');
		var src_open = this.src_open;
		var src_close = this.src_close;
		nCloneTd.innerHTML = '<img src="details_open.png">';
		nCloneTd.className = "center";

		$('#' + this.id + ' thead tr').each(function () {
			this.insertBefore(nCloneTh, this.childNodes[2]);
		});

		$('#' + this.id + ' tbody tr').each(function () {
			this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[2]);
		});

		var idxdetail = this.idxdetail;
		
		$('#' + this.id + ' tbody').on('click','td img', function () {
			var nTr = $(this).parents('tr')[0];
			if (oTable.fnIsOpen(nTr)) {

				this.src = src_open;
				oTable.fnClose(nTr);
			} else {

				this.src = src_close; 

				var aData = oTable.fnGetData(nTr);
				
				if(idxdetail>0){
					var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
						sOut += '<tr><td>SKS Konversi</td><td>:'+aData[9]+'</td></tr>';
						sOut += '<tr><td>NIM Asal</td><td>:'+aData[10]+'</td></tr>';
						sOut += '<tr><td>PT Asal</td><td>:'+aData[11]+'</td></tr>';
						
						sOut += '<tr><td>Jen. Asal</td><td>:'+aData[12]+'</td></tr>';
						
						sOut += '<tr><td>Prodi. Asal</td><td>:'+aData[13]+'</td></tr>';	
						
						sOut += '</table>';
				}else{					
					var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
					sOut += '<tr><td>Tempat Lahir</td><td>:' + aData[10] + '</td></tr>';
					sOut += '<tr><td>Tanggal Lahir</td><td>:' + aData[11] + '</td></tr>';
					sOut += '<tr><td>Jenis Kelamin</td><td>:' + aData[12] + '</td></tr>';

					sOut += '<tr><td>Kelas</td><td>:' + aData[13] + '</td></tr>';

					sOut += '<tr><td>Baru/Pindahan</td><td>:' + aData[14] + '</td></tr>';

					sOut += '<tr><td>Awal Masuk</td><td>:' + aData[15] + '</td></tr>';
					sOut += '<tr><td>Link Forlap</td><td>:' + aData[16] + '</td></tr>';
					sOut += '</table>';
                }
				oTable.fnOpen(nTr, sOut, 'details');
			}
		});
	};

	this.footerfilter = function () {
		$("tfoot input").keyup(function () {
			// Filter on the column (the index) of this element
			oTable.fnFilter(this.value, $("tfoot input").index(this));
		});

		/* Support functions to provide a little bit of 'user friendlyness' to the textboxes in
		 * the footer */

		$("tfoot input").each(function (i) {
			asInitVals[i] = this.value;
		});

		$("tfoot input").focus(function () {
			if (this.className == "search_init") {
				this.className = "";
				this.value = "";
			}
		});

		$("tfoot input").blur(function (i) {
			if (this.value == "") {
				this.className = "search_init";
				this.value = asInitVals[$("tfoot input").index(this)];
			}
		});
	};
	this.rowselect = function () {
		$("#" + this.id + " tbody tr").click(function (e) {
			if ($(this).hasClass('row_selected')) {
				$(this).removeClass('row_selected');
			} else {
				oTable.$('tr.row_selected').removeClass('row_selected');
				$(this).addClass('row_selected');
			}
		});
	};

	this.create = function () {
		oTable = $("#" + this.id).dataTable(this);
		return oTable;
	};
}
function myaccordion() {
	this.id = '';
	this.autoHeight = false;
	this.clearStyle = true;
	this.header = "h3";
	this.fillSpace = true;
	this.create = function () {
		$("#" + this.id).accordion(this);
	}
}