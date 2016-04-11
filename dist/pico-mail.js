;(function ($) {
    $.fn.pico_mail = function (mailpath) {
        mailpath = typeof mailpath !== 'undefined' ? mailpath : 'mail.php';
        var el = $(this);
        el.submit(function () {
            alert('ss');
            console.log(el);
            $.ajax({
                type: "POST",
                url: mailpath, 
                data: el.serialize()
            }).done(function () {
                alert("Thank you!");
                setTimeout(function () {
                    el.trigger("reset");
                }, 1000);
            }).error(function (e) {
                conlole.log(e);
            });
        });
        return false;
    }
})(jQuery);