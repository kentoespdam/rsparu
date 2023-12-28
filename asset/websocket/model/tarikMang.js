
const db = require('./db');
let methods = {};

let sql = "";



methods.ambilData = (callback) => {
    let arrData = [];

    db.getConnection((err, conn) => {
	  if (err)
		console.log("error : " + err + "__" + conn);


	  sql = "SELECT * FROM m_rm_poli_tb";
	  conn.query(sql, (err, result, fields) => {

		if (err) {
		    console.log(err);
		}

		result.forEach(d => {
		    arrData.push(d);
		});
		conn.release();
		return callback(arrData);
	  });
    });
};

methods.query = (sql, callback) => {
//    console.log(sql);
    db.getConnection((err, conn) => {
	  if (err)
		console.log("error : " + err + "__" + conn);
	  
	  conn.query("TRUNCATE m_rm_poli_tb", (e, r) => {
//		conn.release();
	  });
	  conn.query(sql, (error, result) => {
		console.log("data berhasil disimpan");
//		console.log(result);
		conn.release();

		if (error)
		    throw error;
		return callback(true);
	  });
    });
};

methods.update = (data) => {

};

methods.cari = (data) => {

};

exports.data = methods;