const mysql = require('mysql');
const db = mysql.createConnection({
    host: "localhost",
    user: "kentoes",
    password: "Rahasia",
    database:"kentoesc_rs_paru"
});

module.exports = db;