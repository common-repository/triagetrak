(function ($) {

    "use strict";

    function tt_search(form, query, currentQuery, timeout) {

        let search = form.find('.search');
        let doctors = form.find('#doctors').val();
        let locations = form.find('#locations').val();
        let departments = form.find('#departments').val();
        let conditions = form.find('#conditions').val();
        let procedures = form.find('#procedures').val();

        form.next('.tt_search-results').html('').removeClass('active');

        query = query.trim();

        if (query.length >= 3) {

            if (timeout) {
                clearTimeout(timeout);
            }

            form.next('.tt_search_results').removeClass('empty');

            if (query != currentQuery) {
                timeout = setTimeout(function () {
                    $.ajax({
                        url: opt.ajaxUrl,
                        type: 'post',
                        data: {
                            action: 'tt_search',
                            keyword: query,
                            doctors: doctors,
                            locations: locations,
                            departments: departments,
                            conditions: conditions,
                            procedures:procedures
                        },
                        success: function (data) {
                            currentQuery = query;

                            if (!form.next('.tt_search_results').hasClass('empty')) {
                                if (data.length) {
                                    form.next('.tt_search_results').html('<ul>' + data + '</ul>').addClass('active');
                                }
                            }

                            clearTimeout(timeout);
                            timeout = false;
                        }
                    });

                }, 500);
            }
        } else {
            search.parent().removeClass('loading');
            form.next('.search-results').empty().removeClass('active').addClass('empty');
            clearTimeout(timeout);
            timeout = false;

        }
    }

    $("#tt_search").each(function () {
        let form = $(this),
            search = form.find('.search'),
            currentQuery = '',
            timeout = false;

        search.keyup(function () {
            let query = $(this).val();
            tt_search(form, query, currentQuery, timeout);
        });

        form.submit(function(e) {
            e.preventDefault();
        });

    });

    $(document).click(function (event) {
        if (!$(event.target).closest(".tt_search_results.active").length) {
            $('.tt_search_results').removeClass('active').addClass('empty');
            $('.search').val("");
        }
    });

})(jQuery);