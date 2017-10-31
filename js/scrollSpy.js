(function ($) {
    var sections = [];
    var navbar = $(".navbar-nav");
    var navbara = $('a', navbar);
    var scrolledSection = null;
    // on recupere les sections
    // un peu laborieux mais c est ce qui est rigoureux
    navbara.each(function () {
        sections.push($($(this).attr('href')));
    });
    // on gere l evenement scroll
    $(window).scroll(function (e) {
        var scrolltop = $(this).scrollTop() + ($(window).height() / 2);
        for (var i in sections) {
            var section = sections[i];
            if (scrolltop > section.offset().top) {
                var prevScrolledSection = section.attr('id');
            }
        }
        //Optimisation pour ne pas faire appel aux fonctions tout le temps
        if (prevScrolledSection != scrolledSection) {
            scrolledSection = prevScrolledSection;
            navbara.removeClass('current');
            $("a[href='#" + scrolledSection + "']", navbar).addClass('current');
        }
    });
    // on gere le clic sur les liens du navbar
    navbara.click(function (e) {
        e.preventDefault();
        $($(this).attr('href')).animatescroll({
            scrollSpeed: 2000,
            easing: 'easeInOutBack',
            padding: 50
        });
        /*$("html,body").animate({
            scrollTop: $($(this).attr('href')).offset().top
        });*/
        hash($(this).attr('href'));
    });

})(jQuery);

hash = function (h) {
    if (history.pushState) {
        history.pushState(null, null, h);
    } else {
        location.hash = h;
    }

}