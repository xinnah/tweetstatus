
jQuery(document).ready(function () {
    var generateForm = function (responsedata) {
        var f = document.createElement("form");
        f.setAttribute('method', "POST");
        f.setAttribute('action', responsedata.redirect);

        var i = document.createElement("input"); //input element, text
        i.setAttribute('type', "hidden");
        i.setAttribute('name', "tags");
        i.setAttribute('value', "planid=" + responsedata.plan + ",userid=" + responsedata.userid);

        var h = document.createElement("input"); //input element, text
        h.setAttribute('type', "hidden");
        h.setAttribute('name', "contact_email");
        h.setAttribute('value', responsedata.email);

        var s = document.createElement("input"); //input element, Submit button
        s.setAttribute('type', "submit");
        s.setAttribute('value', "Submit");

        f.appendChild(i);
        f.appendChild(h);
        f.appendChild(s);

        document.getElementsByTagName('body')[0].appendChild(f);

        return f;
    }

    $('#login_form').on('submit', function (e) {
        e.preventDefault();
        $('#login_form #action').val('login');
        var email = $('#login_form #email').val();
        var password = $('#login_form #password').val();
        if (email == '') {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
            return false;
        }
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
            return false;
        }
        if (password == '') {
            sweetAlert('Oops...', 'Enter password.', 'error');
            return false;
        }
        var formdata = $('#login_form').serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax_handle.php',
            data: formdata,
            success: function (response) {
                var responsedata = $.parseJSON(response);
                if (responsedata.status == 1) {
                    if (responsedata.message == 'plansubscribed') {
                        window.location.href = "plan.php";
                        return false;
                    }
                    if (typeof responsedata.plan != 'undefined') {
                        var f = generateForm(responsedata);
                        f.submit();
                    } else {
                        window.location.href = responsedata.redirect;
                        return false;
                    }
                } else {
                    sweetAlert('Oops...', responsedata.message, 'error');
                    return false;
                }
            }
        });
    });

    $('#registration_form').on('submit', function (e) {
        e.preventDefault();
        $('#registration_form #action').val('signup');
        var email = $('#registration_form #email').val();
        var password = $('#registration_form #password').val();
        var first_name = $('#registration_form #first_name').val();
        var last_name = $('#registration_form #last_name').val();
        var passwordrepeat = $('#registration_form #confirm_password').val();
        if (email == '') {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
            return false;
        }
        if (first_name == '') {
            sweetAlert('Oops...', 'Enter first name.', 'error');
            return false;
        }
        if (last_name == '') {
            sweetAlert('Oops...', 'Enter last name.', 'error');
            return false;
        }
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
            return false;
        }
        if (password == '') {
            sweetAlert('Oops...', 'Enter password.', 'error');
            return false;
        }
        if (passwordrepeat == '') {
            sweetAlert('Oops...', 'Enter password.', 'error');
            return false;
        }
        if (password != passwordrepeat) {
            sweetAlert('Oops...', 'Password does not match the confirm password', 'error');
            return false;
        }
        var formdata = $('#registration_form').serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax_handle.php',
            data: formdata,
            success: function (response) {
                var responsedata = $.parseJSON(response);
                if (responsedata.status == 1) {
                    if (typeof responsedata.plan != 'undefined') {
                        var f = generateForm(responsedata);
                        f.submit();
                    } else {
                        window.location.href = 'dashboard.php';
                    }
                } else {
                    sweetAlert('Oops...', responsedata.message, 'error');
                    return false;
                }
            }
        });
    });

    $('#resetpass_form').on('submit', function (e) {
        e.preventDefault();
        $('#action').val('reset-password');
        var email = $('#email').val();
        if (email == '') {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
        }
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            sweetAlert('Oops...', 'Enter a valid email address.', 'error');
            return false;
        }
        var formdata = $('#resetpass_form').serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax_handle.php',
            data: formdata,
            success: function (response) {
                var responsedata = $.parseJSON(response);
                if (responsedata.status == 1) {
                    location.reload();
                } else {
                    sweetAlert('Oops...', responsedata.message, 'error');
                    return false;
                }
            }
        });
    });
});