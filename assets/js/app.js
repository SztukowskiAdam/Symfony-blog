var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

require('../images/slider1.jpg');
require('../images/slider2.jpg');
require('../images/slider3.jpg');
require('../images/1.jpg');
require('../images/2.jpg');
require('../images/3.jpg');
require('../images/4.jpg');
require('../images/5.jpg');



$(document).ready(function() {
    // get current URL path and assign 'active' class
    var pathname = window.location.pathname;
    $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
})
