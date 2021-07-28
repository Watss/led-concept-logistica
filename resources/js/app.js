require('./bootstrap');

require('alpinejs');
require('./config-template/bootstrap');
require('./config-template/sidebar');
import feather from "feather-icons";

document.addEventListener("DOMContentLoaded", () => {
    feather.replace();
});

window.feather = feather;
