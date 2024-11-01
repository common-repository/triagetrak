jQuery(document).ready(function ($) {
    var body = $('body'),
        can_be_loaded = true;

    tt_doctors_slider();

    // Initialize select2 for filter selects
    $("#tt_doctors,#tt_languages,#tt_body_parts,#tt_departments,#tt_sub_specialties,#tt_conditions,#tt_procedures,#tt_insurances,#tt_injury_types,#tt_patient_ages").select2();

    if (body.find('.tt_content').length === 0) return;

    //Load locations into single doctor page
    $(".tt_accordion > .accordion-item.is-active").children(".tt_accordion-panel").slideDown();

    get_location_info($(".tt_accordion > .accordion-item:first-child"));

    $(document).on('click', '.tt_accordion > .accordion-item', function () {
        get_location_info($(this));
    });

    function get_location_info(element) {
        element.siblings(".accordion-item").removeClass("is-active").children(".tt_accordion-panel").slideUp();
        element.toggleClass("is-active").children(".tt_accordion-panel").slideToggle("ease-out");
    }

    function filter_handler(filter, content) {
        paginate_params.args = filter.serialize();
        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(),
            type: filter.attr('method'),
            beforeSend: function () {
                filter.find('.tt_filter_btn i').removeClass('fa-arrow-circle-right');
                filter.find('.tt_filter_btn i').addClass('fa-spinner fa-spin');
                can_be_loaded = true;
            },
            success: function (res) {
                if (res.success) {
                    paginate_params.current_page = 1;
                    paginate_params.zip_codes = res.zip_codes;
                    filter.find('.tt_filter_btn i').removeClass('fa-spinner fa-spin');
                    filter.find('.tt_filter_btn i').addClass('fa-arrow-circle-right');
                    content.html(res.data);
                }
            }
        });
    }

    // Show doctors filter result
    var tt_doctors_filter = $('#tt_doctors_filter');

    tt_doctors_filter.submit(function () {
        let content = $('.tt_doctors_list');
        filter_handler(tt_doctors_filter, content);
        return false;
    });

    // Show locations filter result
    var tt_locations_filter = $('#tt_locations_filter');

    tt_locations_filter.submit(function () {
        let content = $('.tt_locations_list');
        filter_handler(tt_locations_filter, content);
        return false;
    });

    // Clear doctors filter result
    $('.tt_clear_btn').on('click', function () {
        reset_doctor_form();
        return false;
    });
    // Clear locations filter result
    $('.tt_loc_clear_btn').on('click', function () {
        reset_location_form();
        return false;
    });

    // Show tabs
    body.on('click', 'ul.tt_tabs li', function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tt_tabs li').removeClass('current');
        $('.tt_tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    });

    // tabs-accordion
    body.on('click', '.tt_tabs_accordions .tt_tab-link', function () {
        var _this = $(this);
        var tab_id = _this.attr('data-tab');
        if ($(window).width() < 993 && _this.hasClass('current')) {
            $("#" + tab_id).removeClass('current');
            _this.removeClass('current');
            return;
        } else if (_this.hasClass('current')) {
            return;
        }
        _this.siblings('.tt_tab-content-wrap, .tt_tab-link').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    });


    if ($(".tt_doctors_list.show-paginate").length) {
        let page = $('#tt_doctors_page');
        let params = page.attr("data-params");
        infinite_scroll(params, 'doctor', 'paginate', page);
    }

    if ($(".tt_locations_list.show-paginate").length) {
        let page = $('#tt_location_page');
        let params = page.attr("data-params");
        infinite_scroll(params, 'location', 'location_paginate', page);
    }

    // ajax infinite doctors scroll
    function infinite_scroll(params, type, action, page) {
        let bottomOffset = 2000,
            content,
            loader = $('.tt_load_more');

        $(window).scroll(function () {
            let data = {
                'action': action,
                'params': params,
                'page': paginate_params.current_page,
                'args': paginate_params.args,
                'zip_codes': paginate_params.zip_codes,
            };

            if (type == 'doctor') {
                content = page.find('.tt_doc_item:last-of-type');
            }
            if (type == 'location') {
                content = page.find('.tt_loc_item:last-of-type');
            }

            if ($(document).scrollTop() > ($(document).height() - bottomOffset) && can_be_loaded == true) {
                $.ajax({
                    url: paginate_params.ajax_url,
                    data: data,
                    type: 'POST',
                    beforeSend: function (xhr) {
                        can_be_loaded = false;
                    },
                    success: function (res) {
                        loader.show();
                        if (res.success && res.max_pages != 0) {
                            content.after(res.data);
                            can_be_loaded = true;
                            paginate_params.current_page++;
                            if (paginate_params.current_page == res.max_pages) {
                                can_be_loaded = false;
                                loader.hide();
                            }
                        } else {
                            loader.hide();
                        }
                    }
                });
            }
        });
    }

    // clear doctors filter param
    function reset_doctor_form() {
        $("#tt_doctors").val([]).trigger('change');
        $("#tt_languages").val([]).trigger('change');
        $("#tt_body_parts").val([]).trigger('change');
        $("#tt_departments").val([]).trigger('change');
        $("#tt_sub_specialties").val([]).trigger('change');
        $("#tt_conditions").val([]).trigger('change');
        $("#tt_procedures").val([]).trigger('change');
        $("#tt_insurances").val([]).trigger('change');
        $("#tt_injury_types").val([]).trigger('change');
        $("#tt_patient_ages").val('').trigger('change');
        $('#tt_new_patients').removeAttr('checked');
        $('.letter_field').removeAttr('checked');
        $("#tt_doc_zip_code").val("");
        paginate_params.zip_codes = '';
        let content = $('.tt_doctors_list');
        reset_filter(tt_doctors_filter, content);
    }

    // clear locations filter param
    function reset_location_form() {
        $("#tt_departments").val([]).trigger('change');
        $("#tt_zip_code").val("");
        $('.loc_letter_field').removeAttr('checked');
        paginate_params.zip_codes = '';
        let content = $('.tt_locations_list');
        reset_filter(tt_locations_filter, content);
    }

    function reset_filter(filter, content) {
        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(),
            type: filter.attr('method'),
            beforeSend: function () {
                filter.find('.tt_clear_btn i').removeClass('fa-times-circle');
                filter.find('.tt_clear_btn i').addClass('fa-spinner fa-spin');
            },
            success: function (res) {
                if (res.success) {
                    can_be_loaded = true;
                    paginate_params.current_page = 1;
                    paginate_params.args = '';
                    filter.find('.tt_clear_btn  i').removeClass('fa-spinner fa-spin');
                    filter.find('.tt_clear_btn  i').addClass('fa-times-circle');
                    content.html(res.data);
                }
            }
        })
    }

    function tt_doctors_slider() {
        let sliders = $('.tt_doc_slider');
        if (sliders.length) {
            sliders.each(function () {
                let columns = $(this).data('columns') ? $(this).data('columns') : 4;
                let separation = $(this).data('separation');
                let cs_duration = $(this).data('duration');
                let cs_autoplay = $(this).data('autoplay');
                let cs_dots = $(this).data('dots');
                let cs_navs = $(this).data('navs');
                let cs_loop = $(this).data('loop');
                let dots_nav = $(this).data('dots_nav');

                cs_duration = cs_duration ? cs_duration : 4000;
                cs_autoplay = !!cs_autoplay;
                cs_dots = !!cs_dots;
                cs_navs = !!cs_navs;
                cs_loop = !!cs_loop;
                dots_nav = dots_nav ? ('#' + dots_nav) : '';
                let cs = $(this).find('.tt_doctors_slider_inner');
                cs.addClass('owl-carousel owl-theme');

                let cards = cs.find('.tt_doctor_item');

                cards.each(function () {
                    if (separation) {
                        $(this).css({
                            'padding-left': + (separation / 2) + 'px',
                            'padding-right': + (separation / 2) + 'px',
                        });
                    }else {
                        $(this).css({
                            'padding-left': '7.5px',
                            'padding-right': '7.5px',
                        });
                    }
                });

                cs.owlCarousel({
                    items: columns,
                    margin: 0,
                    autoplay: cs_autoplay,
                    autoplayTimeout: cs_duration,
                    nav: cs_navs,
                    dots: cs_dots,
                    loop: cs_loop,
                    navElement: 'div',
                    autoHeight: false,
                    pagination: false,
                    slideSpeed: 450,
                    autoplayHoverPause: true,
                    dotsContainer: dots_nav,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        481: {
                            items: 2,
                        },
                        769: {
                            items: 2,
                        },
                        1025: {
                            items: columns,
                        },
                    },
                    lazyLoad: true,
                    navText: [
                        '<i class="fa fa-angle-left"></i>',
                        '<i class="fa fa-angle-right"></i>'
                    ],
                });
            });
        }
    }
});
