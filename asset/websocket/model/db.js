const mysql = require('mysql');
//const db = mysql.createConnection({
const db = mysql.createPool({
    connectionLimit:50,
    host: "localhost",
    user: "kentoes",
    password: "enter",
    database:"rs_paru"
});

module.exports = db;