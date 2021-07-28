require('./bootstrap');

require('alpinejs');
import feather from "feather-icons";

document.addEventListener("DOMContentLoaded", () => {
    feather.replace();
});

window.feather = feather;
