let mtd = {};
let drive = require('./getFileDrive'),
	  my_sql = require('./tarikMang'),
	  u = 0;


let cd = (callback) => {
    setTimeout(() => {
	  // u++;
	  // console.log(u);
	  sinkron();
    }, 600000);
};

module.exports = sinkron = () => {
    let driveCount = 0,
		driveData = [],
		arrRmDrive = [],
		my_sqlCount = 0,
		my_sqlData = [],
		arrRmMysql = [];

    drive.data.ambilDataDrive((result) => {
	  if (result.data.length == 0) {
		cd();
	  }
	  else {
		driveCount = result.data.length;
		driveData = result.data;
		driveData.forEach(d => {
		    arrRmDrive.push(d.norm);
		});

		doingSomething(driveCount, driveData, arrRmDrive);
	  }
    });
};

let doingSomething = (driveCount, driveData, arrRmDrive) => {
    generateSQLSave(arrRmDrive, driveData, (result) => {
	  if (result === true) {
		cd();
	  }
    });
};

let tidakKetemu = (a1, a2) => {
    let a = [], diff = [];

    for (var i = 0; i < a1.length; i++) {
	  a[a1[i]] = true;
    }

    for (var i = 0; i < a2.length; i++) {
	  if (a[a2[i]]) {
		delete a[a2[i]];
	  }
	  else {
		a[a2[i]] = true;
	  }
    }

    for (var k in a) {
	  diff.push(k);
    }
//    console.log(diff);

    return diff;
};


let generateSQLSave = (arrInsert, driveData, callback) => {
    let b = [];
//    console.log(arrInsert);
    let str = "INSERT INTO m_rm_poli_tb values ";
    for (var i = 0; i < arrInsert.length; i++) {
	  b = driveData.find(d => d.norm == arrInsert[i]);
	  if (i < arrInsert.length - 1) {
		str += "('" + b.norm + "','" + b.nama + "','" + b.desa + "','" + b.kabupaten + "','" + b.rakEkor + "','" + b.jenisTb + "'), ";
	  }
	  else {
		str += "('" + b.norm + "','" + b.nama + "','" + b.desa + "','" + b.kabupaten + "','" + b.rakEkor + "','" + b.jenisTb + "')";
	  }
//        diff.push();
    }
//    console.log(str);
    my_sql.data.query(str, (result) => {
	  return callback(result);
    });
//    console.log(driveData.find(d => d.gsx$norm.$t === '001010'));
};

//exports.data = mtd;