$(document).ready(function() {
    $('.slider-wrapper').each(function () { //process every slider
        let obj = $(this);
        $(obj).append("<div class='nav'></div>");
        $(obj).find("li").each(function () {
            $(obj).find(".nav").append("<span rel='"+$(this).index()+"'></span>"); //add navigation
            $(this).addClass("slider-wrapper"+$(this).index());
        });
        $(obj).find("span").first().addClass("on"); //do an active first element of menu
    });
});

function mySlider(obj, sl) {  //slider function
    let ul = $(sl).find("ul");  //find block
    let bl = $(sl).find("li.slider-wrapper" + obj); //find any element of block
    let step = $(bl).width();   //object width
    $(ul).animate({marginLeft: "-" + step*obj}, 500);   //speed of slides
}

$(document).on("click", ".slider-wrapper .nav span", function () {
    let sl = $(this).closest(".slider-wrapper");    //find which block click was
    $(sl).find("span").removeClass("on");   //remove an active element
    $(this).addClass("on"); //do an active current element
    let obj = $(this).attr('rel');  //find its number
    mySlider(obj, sl);  //slides
    return false;
});


