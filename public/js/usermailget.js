function isemailidfn(id, flagcheck)
{
    if ($(id).val().trim() == '')
    {
        $(id).addClass('textbox-error');
        if (flagcheck == 0)
            $(id).focus();
        flagcheck = 1;
    }
    else
    {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test($(id).val().trim()) == false)
        {
            $(id).addClass('textbox-error');
            if (flagcheck == 0)
                $(id).focus();
            flagcheck = 1;
        }
        else
        {
            $(id).removeClass('textbox-error');
        }
    }
    return flagcheck;
}

jQuery(document).ready(function() {

    //$('.getusermailid').trigger("click");

    jQuery("#getuseremailidbtn").click(function() {
        var flag = 0;
        flag = isemailidfn('#useremailid', flag);
        if (flag == 1)
            return false;

        var formdata = $('#getuseremailid').serializeArray();
        $('#getuseremailid-process').show();
        $.ajax({
            type: 'POST',
            url: $('#getuseremailid').attr('action'),
            data: formdata,
            success: function(data) {
                if (data == 'updateddone')
                    window.location.reload(true);

            }
        });
        return false;
    });

});
