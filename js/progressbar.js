progressbar = {
    countedElt: 0,
    loadedElt: 0,
    init: function () {
        var self = this;
        this.countedElt = $('img').length;
        var $progressbarContainer = $('<div/>').addClass('progressbar-container');
        $progressbarContainer.append($('<div/>').addClass('progressbar'));
        $('body').append($progressbarContainer);
        //container des images pour caher a la fin
        var $container = $('<div/>').addClass('progressbar-inner');
        $container.appendTo($('body'));
        $('img').each(function () {
            $('<img/>')
                .attr('src', $(this).attr('src'))
                .on('load error', function () {
                    self.loadedElt++;
                    self.updateProgressBar();
                })
                .appendTo($container);
        });

    },
    updateProgressBar: function () {
        $progressbar = $('.progressbar');
        $progressbar.stop().animate({
            width: (progressbar.loadedElt / progressbar.countedElt) * 100 + '%'
        }, 200, 'linear', function () {
            if (progressbar.loadedElt == progressbar.countedElt) {
                $('.progressbar-container').animate({
                    top: '-8px'
                }, 2000, function () {
                    $('.progressbar-container').remove();
                    $('progressbar-inner').remove();
                });

            }
        });
    }

}

progressbar.init();