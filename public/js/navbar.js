$(document).ready(function () {
    $(".navbar-toggle").click(function(e){
        
    $("i", this).toggleClass("fa-chevron-left fa-times");
        $(this).toggleClass("open");
        $(".navbar").toggleClass("open");
        e.preventDefault();
    });
    
});