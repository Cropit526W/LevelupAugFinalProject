function checkForm()
{
    let flag = false;
    $('.form').click(function ()
    {
       if (!flag)
       {
           $('.dropdown-form').slideDown();
       } else
       {
           $('.dropdown-form').slideUp();
       }
       flag = !flag;
    });
}

checkForm();