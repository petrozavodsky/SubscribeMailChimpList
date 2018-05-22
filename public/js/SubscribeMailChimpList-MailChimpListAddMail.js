var SubscribeMailChimpListMailChimpListAddMail =
    {

        action_url: false,

        selector: '.grid__girl-posts-items',

        run: function () {

            var this_class = this;

            this_class.action_url = window.SubscribeMailChimpList_MailChimpListAddMail__vars.ajax_url_action;

            this_class.init("[action$='" + this_class.action_url + "']");


        },
        init: function (selector) {


            $(selector).submit(function (e) {

                e.preventDefault();

                var method = $(this).attr('method');
                var action = $(this).attr('action');
                var form = $(this);
                var data = $(this).serialize();
                var button = $(this).find("[type='submit']");

                button.removeAttr('disabled');


                $.ajax({
                    type: method,
                    url: action,
                    data: data,
                    beforeSend: function () {
                        button.attr('disabled', 'disabled');
                    },
                    success: function (result) {
                        button.removeAttr('disabled');

                        console.log(result);
                    }
                });

            });

        },

    };

$(document).ready(function () {
    SubscribeMailChimpListMailChimpListAddMail.run();
});