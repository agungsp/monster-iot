window._ = require("lodash");

// Jquery & Bootstrap
window.Popper = require("popper.js").default;
window.$ = window.jQuery = require("jquery");
require("bootstrap");
// import 'bootstrap';


// Axios
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

// Sweet Alert
window.Swal = require("sweetalert2");

// Moment Js
window.moment = require("moment");

// Leaflet
require("leaflet");

// Datatables
// require('datatables.net/js/jquery.dataTables');
require('datatables.net-bs5/js/dataTables.bootstrap5.js');
