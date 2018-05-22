var SubscribeMailChimpListMailChimpListAddMail =
    {
        slider: false,
        selector: '.grid__girl-posts-items',
        run: function () {
            var this_class = this;

            if (document.querySelector(this_class.selector)) {
                this_class.slider_init(this_class.selector);
            }
        },
        slider_init: function (selector) {

        },

    };

$(document).ready(function () {
    SubscribeMailChimpListMailChimpListAddMail.run();
});