jQuery(document).ready(function($) {

    $("#btn1").click(function () {
        $("#spt-post").fadeIn("slow");
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    });

    $("#btn2").click(function () {
        $("#spt-post").hide();
        $("#spt-label").fadeIn("slow");
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    });

    $("#btn3").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").fadeIn("slow");
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    });

    $("#btn4").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").fadeIn("slow");
        $("#spt-shortcode").hide();
    });

    $("#btn5").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").fadeIn("slow");
    });

    $('select#spt-cat').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        placeholder: 'Select categories (leave empty for all categories)',
        persist: false,
        create: false
    });

    $('.spt-color-picker').wpColorPicker();

    $("#spt-info").change(function() {
        if ($('#spt-info').val() == 'none') {
            $('.spt-info-sep').hide();
            $('.spt-info-colour').hide();
        }
        if ($('#spt-info').val() != 'none') {
            $('.spt-info-sep').show();
            $('.spt-info-colour').show();
        }
    });
    $("#spt-info").trigger('change');

    $("#spt-border").change(function() {
        if ($('#spt-border').val() == 'none') {
            $('.spt-border-width').hide();
            $('.spt-border-colour').hide();
        }
        if ($('#spt-border').val() != 'none') {
            $('.spt-border-width').show();
            $('.spt-border-colour').show();
        }
    });
    $("#spt-border").trigger('change');

    $(".coffee-amt").change(function() {
        var btn = $('.buy-coffee-btn');
        btn.attr('href', btn.data('link') + $(this).val());
    });
    $(".coffee-amt").trigger('change');

    if ( location.href.match(/page\=simple-posts-ticker#post/ig) ) {
        $("#spt-post").show();
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    } else if ( location.href.match(/page\=simple-posts-ticker#label/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn2").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").show();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#display/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn3").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").show();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#others/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn4").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").show();
        $("#spt-shortcode").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#shortcode/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn5").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").show();
    } 
});