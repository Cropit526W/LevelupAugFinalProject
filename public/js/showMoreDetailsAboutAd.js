function showMoreDetailsAboutAd ()
{
    let flag = false;
    $('.detailsAboutAd-wrapper').click(function () {
        if (!flag){
            $('.detailsAboutAd').slideDown();
        }else {
            $('.detailsAboutAd').slideUp();
        }
        flag = false;
    });
}

showMoreDetailsAboutAd();