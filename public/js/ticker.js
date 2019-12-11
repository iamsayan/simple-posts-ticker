(function($) {

    // variables
    var $mq = $('.spt-marquee');
    var cflow = $mq.data('duplicated');
    var text = $mq.html();
    
    //init marquee
    $mq.bind('beforeStarting', function() {
        // check repeated marquee
        if(cflow === true) {
            $mq.marquee('destroy');
    		// we need to repeat at least once..
    		$mq = $mq.append(text).marquee();
        }
    }).marquee();

})(jQuery);