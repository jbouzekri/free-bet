if (typeof jQuery === "undefined") { throw new Error("Cart requires jQuery") }

+function ($) {

    var $cart = $('#cart');

    $cart.on( "click", "button", function() {
        var $this = $(this);
        var form = $this.parent('form');
        bootbox.confirm($this.data('label'), function(result) {
            if (result) {
                $.post(form.attr('action'), form.serialize(), function( data ) {
                    $cart.html(data);
                });
            }
        });
        return false;
    });

    $('.bet-type form button').click(function(){
        form = $(this).parent('form');
        $.post(form.attr('action'), form.serialize(), function( data ) {
            $cart.html(data);
        });
        return false;
    });
}(jQuery);