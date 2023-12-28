/* 
 * Developed By Kent-Os
 * Each line should be prefixed with  * 
 */

/* 
 * global base_uri
 * global $uname
 * global $kd_poli
 * global $aliases
 * global $name
 * global $user_access
 * global socket
 * global $tensiIO
 * global uri_suara
 * global teks
 */

let base_uri;
let bi = window.location.host.split(".");
if (bi[(bi.length) - 1] == "com" || bi[(bi.length) - 1] == "net" || bi[(bi.length) - 1] == "xyz") {
    base_uri = window.location.origin + "/";
} else {
    base_uri = window.location.origin + "/dev-rsparu/";
}

const $uname = $('#uname').val();
const $kd_poli = $('#kd_poli').val();
const $aliases = $('#aliases').val();
const $name = $('#name').val();
const $user_access = JSON.parse($('#user_access').val());
let socket;
let $tensiIO;
let loc = window.location.host;
let _src_icon = '<i class="fa fa-spinner fa-pulse fa-2x"></i>';
let _statXhr = "";
let uri_suara;
let teks;
