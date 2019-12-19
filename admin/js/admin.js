jQuery(document).ready(function($) {

    $("#btn1").click(function () {
        $("#spt-post").fadeIn("slow");
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    });

    $("#btn2").click(function () {
        $("#spt-post").hide();
        $("#spt-label").fadeIn("slow");
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    });

    $("#btn3").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").fadeIn("slow");
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    });

    $("#btn4").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").fadeIn("slow");
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    });

    $("#btn5").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").fadeIn("slow");
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    });

    $("#btn6").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").fadeIn("slow");
        $("#spt-tools").hide();
    });

    $("#btn7").click(function () {
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").fadeIn("slow");
    });

    $('select#spt-cat').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        placeholder: 'Select categories (leave empty to select all categories)',
        persist: false,
        create: false
    });

    $('.spt-color-picker').wpColorPicker();

    $("#spt-post-type").change(function() {
        if ($('#spt-post-type').val() == 'post') {
            $('.spt-cat').show();
        }
        if ($('#spt-post-type').val() != 'post') {
            $('.spt-cat').hide();
        }
    });
    $("#spt-post-type").trigger('change');

    $("#spt-info").change(function() {
        if ($('#spt-info').val() == 'none') {
            $('.spt-info-sep, .spt-info-colour, .spt-info-position').hide();
        }
        if ($('#spt-info').val() != 'none') {
            $('.spt-info-sep, .spt-info-colour, .spt-info-position').show();
        }
    });
    $("#spt-info").trigger('change');

    $("#spt-link").change(function() {
        if ($('#spt-link').val() == 'yes') {
            $('.spt-window, .spt-no-follow').show();
        }
        if ($('#spt-link').val() == 'no') {
            $('.spt-window, .spt-no-follow').hide();
        }
    });
    $("#spt-link").trigger('change');

    $("#spt-border").change(function() {
        if ($('#spt-border').val() == 'none') {
            $('.spt-border-width, .spt-border-colour, .spt-border-radius').hide();
        }
        if ($('#spt-border').val() != 'none') {
            $('.spt-border-width, .spt-border-colour, .spt-border-radius').show();
        }
    });
    $("#spt-border").trigger('change');

    $("#spt-continuous-flow").change(function() {
        if ($('#spt-continuous-flow').val() == 'false') {
            $('.spt-loop').hide();
        }
        if ($('#spt-continuous-flow').val() == 'true') {
            $('.spt-loop').show();
        }
    });
    $("#spt-continuous-flow").trigger('change');

    $("#spt-nocontent-type").change(function() {
        if ($('#spt-nocontent-type').val() == 'none') {
            $('.spt-nocontent').hide();
            $('#spt-nocontent').removeAttr('required');
        }
        if ($('#spt-nocontent-type').val() != 'none') {
            $('.spt-nocontent').show();
            $('#spt-nocontent').attr('required', 'required');
        }
    });
    $("#spt-nocontent-type").trigger('change');

    $(".coffee-amt").change(function() {
        var btn = $('.buy-coffee-btn');
        btn.attr('href', btn.data('link') + $(this).val());
    });
    $(".coffee-amt").trigger('change');

    if ( location.href.match(/page\=simple-posts-ticker#post/ig) ) {
        $("#spt-post").show();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    } else if ( location.href.match(/page\=simple-posts-ticker#label/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn2").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").show();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#configure/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn3").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").show();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#styles/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn4").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").show();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#others/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn5").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").show();
        $("#spt-shortcode").hide();
        $("#spt-tools").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#shortcode/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn6").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").show();
        $("#spt-tools").hide();
    } else if( location.href.match(/page\=simple-posts-ticker#tools/ig) ) {
        $("#btn1").removeClass("active");
        $("#btn7").addClass("active");
        $("#spt-post").hide();
        $("#spt-label").hide();
        $("#spt-configure").hide();
        $("#spt-display").hide();
        $("#spt-misc").hide();
        $("#spt-shortcode").hide();
        $("#spt-tools").show();
    } 
});