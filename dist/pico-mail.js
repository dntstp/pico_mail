;(function ($) {
    $.fn.pico_mail = function (mailpath) {
        mailpath = typeof mailpath !== 'undefined' ? mailpath : 'mail.php';
        var t = $(this);
        t.submit(function (elem) {
            var th = $(this);
            elem.preventDefault();
            $.ajax({
                type: "GET",
                url: mailpath,
                data: th.serialize()
            }).done(function () {
                alert("Thank you!");
                setTimeout(function () {
                    th.trigger("reset");
                }, 1000);
            }).error(function (e) {
                conlole.log(e);
            });
        });

    }
})(jQuery);