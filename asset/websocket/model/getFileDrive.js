const request = require('request');
let methods = {};
let uriDrive = "http://spreadsheets.google.com/feeds/list/1PiyzFNGSZz3NFaeaq-VvC-TH6j6uTx3GrNV6apHmKNg/od6/public/values?alt=json";
let options = {json: true};


methods.ambilDataDrive = (callback) => {
    let countData = 0;
    let arrData = [];
    let objData = new Object();

//    countData = 0;
    request({
	  url: uriDrive,
	  json: true,
	  timeout: 15000
    }, (error, res, json) => {
	  if (error) {
		objData.data = arrData;
	  }
	  else {
//              console.log(json.feed.entry);
		json.feed.entry.forEach(r => {
		    var data = new Object();
		    data.norm = r.gsx$norm.$t;
		    data.nama = r.gsx$namalengkap.$t;
		    data.desa = r.gsx$desa.$t;
		    data.kabupaten = r.gsx$kabupaten.$t;
		    data.rakEkor = r.gsx$rakekor.$t;
		    data.jenisTb = r.gsx$jenistb.$t;
		    arrData.push(data);
		});
		objData.data = arrData;

//	  console.log(arrData);
	  }
	  return callback(objData);
    });
};


exports.data = methods;