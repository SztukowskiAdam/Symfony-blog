var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

require('../images/slider1.jpg');
require('../images/slider2.jpg');
require('../images/slider3.jpg');



const deleteArticle = $('.delete-article');

deleteArticle.click(function () {
    const id = $(this).data('id');

    if(confirm("Jesteś pewnien, że chcesz usunąć artykuł o id: " + id +"?")) {
        $(document).load('/admin/delete/'+id);
        $(this).parent().parent().remove();
    }
});


$(document).ready(function() {
    // get current URL path and assign 'active' class
    var pathname = window.location.pathname;
    $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
})
