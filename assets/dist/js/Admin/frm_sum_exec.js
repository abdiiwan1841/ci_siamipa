function fgambarchart(idchart, idx) {
	var gambarchart = new mychart();
	gambarchart.axisX = {
		labelFontSize : 10
	};
	gambarchart.axisY = {
		title : "Jumlah",
		labelFontSize : 10,
		gridColor : "#B6B1A8",
		tickColor : "#B6B1A8",
		interlacedColor : "rgba(182,177,168,0.2)",
		interval : 5
	};

	if (idx > 1) {
		gambarchart.toolTip = {
			shared : true,
			content : function (e) {
				var str = '';
				var total = 0;
				var str3;
				var str2;
				for (var i = 0; i < e.entries.length; i++) {
					var str1 = "<span style= 'color:" + e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + "</span>: <strong>" + e.entries[i].dataPoint.y + "</strong>  orang<br/>";
					total = e.entries[i].dataPoint.y + total;
					str = str.concat(str1);
				}
				str2 = "";
				str3 = "<span style = 'color:Tomato '>Total:</span><strong> " + total + "</strong> orang<br/>";

				return (str2.concat(str)).concat(str3);
			}
		};
	}

	switch (idx) {
	case 1: {
			gambarchart.title.text = "Jumlah Mahasiswa Aktif";
			gambarchart.subtitles.push({
				text : "Semester Berjalan"
			});
			gambarchart.axisX.title = "Angkatan";

			break;
		}
	case 2: {

			gambarchart.title.text = "Jumlah Mahasiswa Aktif";
			gambarchart.subtitles.push({
				text : "20081 - sekarang"
			});
			gambarchart.axisX.title = "Semester";
			gambarchart.axisY.maximum = 75;
			break;
		}
	case 3: {
			gambarchart.title.text = "Status Mahasiswa";
			gambarchart.subtitles.push({
				text : "20081 - sekarang"
			});
			gambarchart.axisX.title = "Semester";
			break;
		}
	}

	var vmyajax = new myajax();
	vmyajax.url = "gambarchart";
	vmyajax.data = "idx=" + idx;
	vmyajax.dataType = 'json';
	vmyajax.success = function success(data) {
		gambarchart.id = idchart;
		gambarchart.data = data;
		gambarchart.gambarchart();
	}
	vmyajax.getdata();

}

function fgambarchart1(idchart, idx) {

	var gambarchart1 = new mychart();
	gambarchart1.axisX = {
		labelFontSize : 10
	};
	gambarchart1.axisY = {
		title : "Jumlah",
		labelFontSize : 10,
		gridColor : "#B6B1A8",
		tickColor : "#B6B1A8",
		interlacedColor : "rgba(182,177,168,0.2)",        
		maximum : 125000000	
	};

	gambarchart1.toolTip = {
		shared : true,
		content : function (e) {
			var str = '';
			var total = 0;
			var str3;
			var str2;
			for (var i = 0; i < e.entries.length; i++) {
				var str1 = "<span style= 'color:" + e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + "</span>: <strong>Rp. " + e.entries[i].dataPoint.y.toLocaleString() + "</strong><br/>";
				total = e.entries[i].dataPoint.y + total;
				str = str.concat(str1);
			}
			str2 = "";
			str3 = "<span style = 'color:Tomato '>Total:</span><strong>Rp. " + total.toLocaleString() + "</strong><br/>";

			return (str2.concat(str)).concat(str3);
		}
	};

	
	switch (idx) {
	case 4: {
			gambarchart1.title.text = "Jumlah Penerimaan Perbulan";
			gambarchart1.subtitles.push({
				text : "2008 - sekarang"
			});
			gambarchart1.axisX.title = "Tahun";

			break;
		}
	case 5: {

			gambarchart1.title.text = "Jumlah Penerimaan Perangkatan";
			gambarchart1.subtitles.push({
				text : "2008 - sekarang"
			});
			gambarchart1.axisX.title = "Tahun";
			
			break;
		}
	case 6: {
			gambarchart1.title.text = "Jumlah Penerimaan Perakun";
			gambarchart1.subtitles.push({
				text : "2008 - sekarang"
			});
			gambarchart1.axisX.title = "Tahun";
			break;
		}
	}
	
	
	var vmyajax1 = new myajax();
	vmyajax1.url = "gambarchart";
	vmyajax1.data = "idx=" + idx;
	vmyajax1.dataType = 'json';
	vmyajax1.success = function success(data) {
		gambarchart1.id = idchart;
		gambarchart1.data = data;
		gambarchart1.gambarchart();
	}
	vmyajax1.getdata();

}