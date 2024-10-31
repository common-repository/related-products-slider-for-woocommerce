jQuery(document).on('click', '.rp-tabs li', function() {
    jQuery('.rp-tabs li').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('.rp-tab-content').removeClass('active');
    jQuery('.rp-tab-content[data-target="' + jQuery(this).attr('data-target') + '"]').addClass('active');
});
jQuery(document).on('change', '.rp_show_type', function() {
    if (jQuery(this).val() == 'slider') {
        jQuery('.rp_slider_type').removeAttr('readonly').removeAttr('disabled');
    } else {
        jQuery('.rp_slider_type').attr('readonly', 'readonly').attr('disabled', 'disabled');
    }
});
jQuery(document).on('change', '.rp_slider_auto_play', function() {
    if (jQuery(this).val() === 'true') {
        jQuery('.rp_slider_auto_play_speed').removeAttr('readonly').removeAttr('disabled');
    } else {
        jQuery('.rp_slider_auto_play_speed').attr('readonly', 'readonly').attr('disabled', 'disabled');
    }
});
jQuery(document).on('change', '.rp_slider_pagination', function() {
    if (jQuery(this).val() === 'true') {
        jQuery('.rp_slider_pagination_number').removeAttr('readonly').removeAttr('disabled');
    } else {
        jQuery('.rp_slider_pagination_number').attr('readonly', 'readonly').attr('disabled', 'disabled');
    }
});
