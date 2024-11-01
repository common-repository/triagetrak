jQuery(document).ready(function ($) {
    let modal_confirm = $('.tt_modal_confirm');
    $('.tt_logout_form').on('submit', function (e) {
        e.preventDefault();
        modal_confirm.addClass('is-visible');
    });

    $("#tt_modal_ok, #tt_modal_no ").on("click", function (e) {
        e.preventDefault();
        modal_confirm.removeClass('is-visible');
        if (this.id === "tt_modal_ok") {
            $(".tt_logout_form")[0].submit();
            modal_confirm.removeClass('is-visible');
        }
    });

    $(".tt_modal_close ").on("click", function (e) {
        e.preventDefault();
        modal_confirm.removeClass('is-visible');
    });

    $('.tt_shortcode_copy').each(function (i, obj) {
        $(this).on('click', function () {
            let $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(this).text()).select();
            document.execCommand("copy");
            $temp.remove();
        });
    });

    let doc_modal = $('.tt_doctor_modal');
    $(".tt_doc_list_open").on("click", function (e) {
        e.preventDefault();
        doc_modal.addClass('is-visible');

        let tab_item = $('.tt_doctor_modal .tabs li');
        let tab_content = $('.tt_doctor_modal .tab-content');
        show_tabs(tab_item, tab_content);

        $("#show_paginate").change(function () {
            let show_filter_option = $('.show_filter_option');
            if (this.checked) {
                show_filter_option.show();
            } else {
                show_filter_option.hide();
            }
        });

        $("#show_doc_conditions").change(function () {
            let show_limit_option = $('.show_limit_option');
            if (this.checked) {
                show_limit_option.show();
            } else {
                show_limit_option.hide();
            }
        });

    });
    let doc_slider_modal = $('.tt_doctor_slider_modal');
    $(".tt_doc_slider_open").on("click", function (e) {
        e.preventDefault();
        doc_slider_modal.addClass('is-visible');

        let tab_item = $('.tt_doctor_slider_modal .tabs li');
        let tab_content = $('.tt_doctor_slider_modal .tab-content');
        show_tabs(tab_item, tab_content);

        $("#slider_doc_conditions").change(function () {
            let show_limit_option = $('.show_limit_option');
            if (this.checked) {
                show_limit_option.show();
            } else {
                show_limit_option.hide();
            }
        });

    });

    let loc_modal = $('.tt_location_modal');
    $(".tt_loc_list_open").on("click", function (e) {
        e.preventDefault();
        loc_modal.addClass('is-visible');

        let tab_item = $('.tt_location_modal .tabs li');
        let tab_content = $('.tt_location_modal .tab-content');
        show_tabs(tab_item, tab_content);

        $("#show_loc_paginate").change(function () {
            let show_filter_option = $('.show_loc_filter_option');
            if (this.checked) {
                show_filter_option.show();
            } else {
                show_filter_option.hide();
            }
        });

        $("#show_address").change(function () {
            let show_limit_option = $('.show_loc_limit_option');
            if (this.checked) {
                show_limit_option.show();
            } else {
                show_limit_option.hide();
            }
        });

    });

    let dep_modal = $('.tt_departments_modal');
    $(".tt_dep_list_open").on("click", function (e) {
        e.preventDefault();
        dep_modal.addClass('is-visible');
    });

    $(".tt_modal_close").on("click", function (e) {
        e.preventDefault();
        $(".tt_modal").removeClass('is-visible');
        $('.result_shortcode').hide().empty();
        $('.tt_shortcode_message').hide();
    });

    $('.show_doc_shortcode').on("click", function (e) {
        e.preventDefault();
        generateDoctorsShortcode();
    });

    $('.show_doc_slider_shortcode').on("click", function (e) {
        e.preventDefault();
        generateDoctorsSliderShortcode();
    });
    $('.show_loc_shortcode').on("click", function (e) {
        e.preventDefault();
        generateLocationsShortcode();
    });

    $('.show_dep_shortcode').on("click", function (e) {
        e.preventDefault();
        generateDepartmentsShortcode();
    });

    function generateDoctorsShortcode() {
        let list_type = $('#doctor_list_type').children("option:selected").val();
        let grid_columns = $('#doctor_grid_columns').children("option:selected").val();
        let departments_val = $('#doctor_departments').children("option:selected").val();
        let conditions_val = $('#doctor_conditions').children("option:selected").val();
        let procedures_val = $('#doctor_procedures').children("option:selected").val();
        let el_class = '';
        let doctors_count = '';
        let paginate = '';
        let filter = '';
        let link_button = '';
        let doc_conditions = '';
        let limit_conditions = '';

        if ($("#doctors_count").val()) {
            let doctors_count_val = $("#doctors_count").val();
            doctors_count = 'per_page="' + doctors_count_val + '"';
        }

        let departments = (departments_val !== " ") ? 'doc_departments="' + departments_val + '"' : '';

        let conditions = (conditions_val !== " ") ? 'doc_conditions="' + conditions_val + '"': '';

        let procedures = (procedures_val !== " ") ? 'doc_procedures="' + procedures_val + '"': '';

        if ($('#doc_el_class').val()) {
            let el_class_val = $('#doc_el_class').val();
            el_class = 'el_class="' + el_class_val + '"';
        }
        if ($('#show_paginate').is(":checked")) {
            paginate = 'show_paginate="1"';
        }
        if ($('#show_filter').is(":checked")) {
            filter = 'show_filter="1"';
        }
        if ($('#show_link_button').is(":checked")) {
            link_button = 'show_link_button="1"';
        }
        if ($('#show_doc_conditions').is(":checked")) {
            doc_conditions = 'show_doc_conditions="1"';
        }
        if ($('#limit_conditions').is(":checked")) {
            limit_conditions = 'limit_conditions="1"';
        }

        $('.result_shortcode').css('display', 'block').text('[tt_doctors_list list_type="' + list_type + '"' +
            ' grid_columns="' + grid_columns + '" ' + departments + ' ' + conditions + ' ' + procedures +
            ' ' + paginate + ' ' + filter + ' ' + link_button + ' '
            + doc_conditions + ' ' + limit_conditions + ' ' + doctors_count + ' ' + el_class + ']');
        $('.tt_shortcode_message').css('display', 'block');
    }
    function generateDoctorsSliderShortcode() {
        let order_by = $('#doctor_order_by').children("option:selected").val();
        let order = $('#doctor_order').children("option:selected").val();
        let grid_columns = $('#doctor_columns').children("option:selected").val();
        let doctors_count = '';
        let link_button = '';
        let doc_conditions = '';
        let limit_conditions = '';
        let separation = '';
        let autoplay = '';
        let dots = '';
        let navs = '';

        if ($("#doctors_number").val()) {
            let doctors_count_val = $("#doctors_number").val();
            doctors_count = 'number_of_doctors="' + doctors_count_val + '"';
        }
        if ($("#slider_separation").val()) {
            let separation_val = $("#slider_separation").val();
            separation = 'separation="' + separation_val + '"';
        }
        if ($('#slider_link_button').is(":checked")) {
            link_button = 'show_link_button="1"';
        }
        if ($('#slider_doc_conditions').is(":checked")) {
            doc_conditions = 'show_doc_conditions="1"';
        }
        if ($('#slider_limit_conditions').is(":checked")) {
            limit_conditions = 'limit_conditions="1"';
        }
        if ($('#slider_autoplay').is(":checked")) {
            autoplay = 'autoplay="1"';
        }
        if ($('#slider_dots').is(":checked")) {
            dots = 'dots="1"';
        }
        if ($('#slider_navs').is(":checked")) {
            navs = 'navs="1"';
        }
        $('.result_shortcode').css('display', 'block').text('[tt_doctors_slider ' +
            'doctors_columns="' + grid_columns + '" order_by="' + order_by + '" order="' + order + '" '
            + link_button + ' ' + doc_conditions + ' ' + limit_conditions +
            ' ' + separation + ' ' + autoplay + ' ' + dots + ' ' + navs + ' ' + doctors_count + ' ]');
        $('.tt_shortcode_message').css('display', 'block');
    }
    function generateLocationsShortcode() {
        let list_type = $('#location_list_type').children("option:selected").val();
        let grid_columns = $('#loc_grid_columns').children("option:selected").val();
        let el_class = '';
        let locations_count = '';
        let show_map = '';
        let paginate = '';
        let filter = '';
        let address = '';
        let limit_address = '';
        let phone = '';
        let show_link_button = '';

        if ($("#locations_count").val()) {
            let locations_count_val = $("#locations_count").val();
            locations_count = 'per_page="' + locations_count_val + '"';
        }

        if ($('#loc_el_class').val()) {
            let el_class_val = $('#loc_el_class').val();
            el_class = 'el_class="' + el_class_val + '"';
        }

        if ($('#show_map').is(":checked")) {
            show_map = 'show_map="1"';
        }
        if ($('#show_loc_paginate').is(":checked")) {
            paginate = 'show_paginate="1"';
        }
        if ($('#show_loc_filter').is(":checked")) {
            filter = 'show_filter="1"';
        }
        if ($('#show_address').is(":checked")) {
            address = 'show_address="1"';
        }
        if ($('#limit_address').is(":checked")) {
            limit_address = 'limit_address="1"';
        }
        if ($('#show_phone').is(":checked")) {
            phone = 'show_phone="1"';
        }
        if ($('#show_loc_button').is(":checked")) {
            show_link_button = 'show_link_button="1"';
        }

        $('.result_shortcode').css('display', 'block').text('[tt_locations_list list_type="' + list_type + '" grid_columns="' + grid_columns + '"' +
            ' ' + show_map + ' ' + paginate + ' ' + filter + ' ' + address + ' ' + limit_address + '' +
            ' ' + phone + ' ' + show_link_button + ' ' + locations_count + ' ' + el_class + ']');
        $('.tt_shortcode_message').css('display', 'block');
    }

    function generateDepartmentsShortcode() {
        let link_target = $('#departments_target').children("option:selected").val();
        let el_class = '';
        let departments_count = '';

        if ($("#departments_count").val()) {
            let departments_count_val = $("#departments_count").val();
            departments_count = 'departments_count="' + departments_count_val + '"';
        }

        if ($('#dep_el_class').val()) {
            let el_class_val = $('#dep_el_class').val();
            el_class = 'el_class="' + el_class_val + '"';
        }

        $('.result_shortcode').css('display', 'block').text('[tt_departments_list target="' + link_target + '" ' + el_class + ' ' + departments_count + ']');
        $('.tt_shortcode_message').css('display', 'block');
    }

    function show_tabs(tab_item, tab_content) {
        $(tab_item).click(function () {
            let tab_id = $(this).attr('data-tab');

            tab_item.removeClass('current');
            tab_content.removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
    }

    var clear_timer,
        doctors_count,
        locationd_count;
    var btn = $('#tt_import');

    $('.tt_import_data').on('submit', function(event){

        let message = $('#tt_message');
        message.html('');
        event.preventDefault();
        $.ajax({
            url: ajaxurl,
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType:"json",
            beforeSend:function(){
                btn.addClass('loading');
                message.html('<div class="alert">The process could take a while. Please do not reload this page</div>');
            },
            success:function(res) {
                console.log(res)
                if(res.success)
                {
                    doctors_count = res.total_doctors;
                    locationd_count = res.total_locations;
                    let total_data = parseInt(res.total_doctors) + parseInt(res.total_locations);
                    $('#total_data').text(total_data);
                    import_data(res.data);
                    clear_timer = setInterval(get_import_data, 1000);
                }
                if(res.error)
                {
                    message.html('<div class="alert alert-danger">'+res.error+'</div>');
                    btn.removeClass('loading');
                    btn.attr('disabled',false);
                }
            },
            error: function(err) {
                console.log(err);
                message.html('<div class="alert alert-danger">'+err.statusText+' <br> Please try again</div>');
                btn.removeClass('loading');
                btn.attr('disabled',false);
            }
        })
    });

    function import_data(args) {
        btn.removeClass('loading');
        $('#tt_message').html('');
        btn.attr('disabled','disabled');
        $('.show_process').css('display', 'block');
        $('#tt_process').css('display', 'block');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {action:'import_data', args:JSON.stringify(args)},
            success:function(data)
            {
            }
        })
    }

    function get_import_data()
    {
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {action:'get_import_data'},
            success:function(data)
            {
                let total_data = $('#total_data').text();
                let width = Math.round((data/total_data)*100);
                $('#process_data').text(data);
                $('.progress-bar').css('width', width + '%');
                if(width >= 100)
                {
                    clearInterval(clear_timer);
                    $('.show_process').css('display', 'none');
                    $('#tt_process').css('display', 'none');
                    $('.tt_doctor_count').text(doctors_count);
                    $('.tt_location_count').text(locationd_count);
                    $('#tt_success_message').css('display','block');
                    btn.attr('disabled',false);
                }
            }
        })
    }

});
