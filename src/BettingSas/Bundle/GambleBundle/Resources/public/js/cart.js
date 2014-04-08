if (typeof jQuery === "undefined") { throw new Error("Cart requires jQuery") }

+function ($) {

    var $cart = $('#cart');

    $cart.on( "click", "button", function() {
        form = $(this).parent('form');
        $.post(form.attr('action'), form.serialize(), function( data ) {
            $cart.html(data);
        });
        return false;
    });

}(jQuery);