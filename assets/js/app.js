var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

require('../images/slider1.jpg');
require('../images/slider2.jpg');
require('../images/slider3.jpg');
require('../images/image1.png');
require('../images/image2.jpg');
require('../images/image3.jpg');
require('../images/image4.jpg');
require('../images/archiwum1.png');

$(document).ready(function() {
    // get current URL path and assign 'active' class
    var pathname = window.location.pathname;
    $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
})
