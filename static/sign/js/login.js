let SnippetLogin = function () {
    let login = $('#m_login');
    let displaySignUpForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');
        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }
    let displaySignInForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');
        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }
    let displayForgetPasswordForm = function () {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');
        login.addClass('m-login--forget-password');
        login.find('.m-login__forget-password').animateClass('flipInX animated');
    }
    let handleFormSwitch = function () {
        $('#m_login_forget_password').click(function (e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });
        $('#m_login_forget_password_cancel').click(function (e) {
            e.preventDefault();
            displaySignInForm();
        });
        $('#m_login_signup').click(function (e) {
            e.preventDefault();
            displaySignUpForm();
        });
        $('#m_login_signup_cancel').click(function (e) {
            e.preventDefault();
            displaySignInForm();
        });
    }
    let handleSignInFormSubmit = function () {
        $(".m-register-form input").on('keyup', function (e) {
            let validator = $('.m-register-form').validate();
            validator.form();
        });
        $('#m_login_signin_submit').click(function (e) {
            e.preventDefault();
            let btn = $(this);
            let form = $(this).closest('form');
            form.validate();
            if (!form.valid()) {
                return;
            }
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            setTimeout(function () {
                form.submit();
                return;
            }, 500);
        });
    }
    let handleSignUpFormSubmit = function () {
        $('#m_login_signup_submit').click(function (e) {
            e.preventDefault();
            if ($('#signup_error').val() == "1") return;
            let btn = $(this);
            let form = $(this).closest('form');
            form.validate();
            if (!form.valid()) {
                return;
            }
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            setTimeout(function () {
                form.submit();
                return;
            }, 500);
        });
    }
    let handleForgetPasswordFormSubmit = function () {
        $('#m_login_forget_password_submit').click(function (e) {
            e.preventDefault();
            let btn = $(this);
            let form = $(this).closest('form');
            form.validate();
            if (!form.valid()) {
                return;
            }
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            setTimeout(function () {
                form.submit();
                return;
            }, 500);
        });
    }
    let handleForgetPasswordUpdateFormSubmit = function () {
        $('#m_login_forget_password_submit2').click(function (e) {
            e.preventDefault();
            let btn = $(this);
            let form = $(this).closest('form');
            form.validate();
            if (!form.valid()) {
                return;
            }
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            setTimeout(function () {
                form.submit();
                return;
            }, 500);
        });
    }
    return {
        init: function () {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
            handleForgetPasswordUpdateFormSubmit();
        }
    };
}();

function checkStrong() {
    let password = $("#password").val();
    let minumumRegex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[_#?!@$%^&*=+-]).{8,}$", "gm");
    $(".password-progress div").addClass('hidden');
    if (minumumRegex.test(password)) {
        $(".password-progress .m--bg-danger").removeClass('hidden');
        $(".password-progress .m--bg-warning").removeClass('hidden');
        if (password.length >= 8 && password.length <= 9) {
            $(".fbar").attr('class', 'progress-bar m--bg-warning fbar');
            $(".sbar").attr('class', 'progress-bar m--bg-warning sbar');
        } else {
            $(".fbar").attr('class', 'progress-bar m--bg-success fbar');
            $(".sbar").attr('class', 'progress-bar m--bg-success sbar');
            $(".tbar").attr('class', 'progress-bar m--bg-success tbar');
            $(".password-progress .m--bg-success").removeClass('hidden');
        }
    } else {
        if (password.length > 0) {
            $(".password-progress .m--bg-danger").removeClass('hidden');
            $(".fbar").attr('class', 'progress-bar m--bg-danger fbar');
            $(".sbar").attr('class', 'progress-bar m--bg-warning sbar hidden');
        }
    }
}

$("#signup_name").change(function (e) {
    $.post("signup.php", {name: $("#signup_name").val(), email: $("#signup_email").val()}, function (data) {
        if (data.name === 1) {
            $("#signup_name_error").html("User already exists").css("display", "block");
        } else $("#signup_name_error").css("display", "none");
        if (data.name === 0 && data.email === 0) {
            $("#signup_error").val("0");
        } else
            $("#signup_error").val("1");
    }, "json");
});

$("#signup_email").change(function (e) {
    $.post("signup.php", {name: $("#signup_name").val(), email: $("#signup_email").val()}, function (data) {
        if (data.email === 1) {
            $("#signup_email_error").html("Email already exists").css("display", "block");
        } else $("#signup_email_error").css("display", "none");
        if (data.name === 0 && data.email === 0) {
            $("#signup_error").val("0");
        } else
            $("#signup_error").val("1");
    }, "json");
});

jQuery(document).ready(function () {
    SnippetLogin.init();
});

$(window).resize(function () {
    if ($(window).width() <= 1024) {
        let elms = $(".table");
        $.each(elms, function (key, val) {
            let elm = $(val);
            let thead = elm.find('th');
            let tr = elm.find('tr');
            //console.log(tr);
            $.each(tr, function (trCount, trr) {
                $.each(thead, function (theadCount, th) {
                    let node = $($(trr).find('td')[theadCount]);
                    node.find('.tdInfo').remove();
                    let sep = ':';
                    if (node.hasClass('nosep')) {
                        sep = '';
                    }
                    node.prepend('        <span class="tdInfo">' + $(th).html() + ' ' + sep + '        </span>');
                });
            });
        });
    }
    if ($(window).width() <= 1670) {
        let elms = $(".buyTokensTable");
        $.each(elms, function (key, val) {
            let elm = $(val);
            let thead = elm.find('th');
            let tr = elm.find('tr');
            //console.log(tr);
            $.each(tr, function (trCount, trr) {
                $.each(thead, function (theadCount, th) {
                    let node = $($(trr).find('td')[theadCount]);
                    node.find('.tdInfo').remove();
                    let sep = ':';
                    if (node.hasClass('nosep')) {
                        sep = '';
                    }
                    node.prepend('        <span class="tdInfo">' + $(th).html() + ' ' + sep + '         </span>');
                });
            });
        });
    }
}).trigger('resize');


$(".triggerEvent").on('click', function (e) {
    let elm = $(e.delegateTarget);
    let type = parseInt(elm.attr('data-type'), 10);
    try {
        triggerGaEvents(type);
    } catch (e) {
    }
})

function triggerGaEvents(type) {
    let types = $.parseJSON('[]');
    let type_event = parseInt(type, 10);
    $.each(types, function (key, val) {
        let tp = parseInt(val.event_type, 10);
        if (tp === type_event) {
            ga('send', 'event', val.category, val.action, val.label);
        }
    });
}