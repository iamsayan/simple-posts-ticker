(function($) {

    // variables
    var $mq = $('.spt-marquee');
    var cflow = $mq.data('duplicated');
    var loop = $mq.data('loop');
    var text = $mq.html();
    
    //init marquee
    $mq.on('beforeStarting', function() {
        // check repeated marquee
        if(cflow === true) {
            $mq.marquee('destroy');
            for (i = 0; i < loop; i++) {
    		    // we need to repeat at least once..
                $mq = $mq.append(text);
            }
            $mq.marquee();
        }
    }).marquee();

})(jQuery);