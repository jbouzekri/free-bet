if (typeof jQuery === "undefined") { throw new Error("Event requires jQuery") }

+function ($) {

    $('#next-event-list table tr th').click(function() {
        var $this = $(this);
        var $glyph = $(this).find('span.glyphicon').first();
        $glyph.toggleClass('glyphicon-chevron-down');
        $glyph.toggleClass('glyphicon-chevron-right');
        $this.parents('table').find('tbody').first().toggle();
        return false;
    });

}(jQuery);