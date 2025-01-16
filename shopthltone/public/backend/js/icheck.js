(function($){
    "use strict";
    var HT = {};
    var document = $(document);
    HT.iCheck = () => {
        $('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
    }
    
    document.ready(function(){
        HT.iCheck();
    });
})(jQuery);