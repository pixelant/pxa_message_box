/* global $ */

$(function () {
    "use strict";

    $('.message-box [data-close-message]').click(function (event) {
        event.preventDefault();

        var ajaxUrl = $(this).attr('href');
        var currentElement = $(this);

        $.ajax({
            url: ajaxUrl,
            dataType: 'json',

            success: function (data) {
                if (data.success) {
                    currentElement.parent().hide();
                }
            },
        });
    });
});