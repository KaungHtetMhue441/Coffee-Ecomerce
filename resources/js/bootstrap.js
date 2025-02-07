import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap's JS
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import swal from 'sweetalert';
window.swal = swal;
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css'; // Import Flatpickr's CSS file

// Now you can use Flatpickr throughout your project
window.flatpickr = flatpickr;

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';  // Import Toastr CSS
window.toastr = toastr;

import $ from 'jquery';

window.$ = window.jQuery = $;