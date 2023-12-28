const request = require('request');
let methods = {};
let uriDrive = "http://localhost/rsparu/Curl/SyncKasir_C";
let i = 0;

let cdKasir = (callback) => {
    setTimeout(() => {
        syncKasir((result) => {
            console.log("sync kasir :", i += 1, result);
            cdKasir();
        });
    }, 5000);
};

module.exports = doSyncKasir = () => {
    console.log("test");
    cdKasir();
};

let syncKasir = (callback) => {
    request({
        url: uriDrive,
        json: true,
        timeout: 15000
    }, (err, res, json) => {
        // console.log("err : ", err);
        // console.log("res : ", res.body);
        // console.log("res code : ", res.statusCode);

        return callback(res.body);
    });
}

cdKasir();
