(function($) {
    Drupal.behaviors.ninesixtyrobots = {
        attach: function (context) {
            $('#search-block-form input:text', context).autofill({
                value: "Search..."
            });
        }
    };
})(jQuery);