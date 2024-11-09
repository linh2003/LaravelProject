(function($){
    "use strict";
    var HT = {};
    var document = $(document);
    HT.customNavbar = () => {
        $('#side-menu > li > a').on('click',function (e) {
            var _this = $(this);
            if(_this.next('ul').length){
                console.log('dieptvvv');
                e.preventDefault();
            }
            if (_this.parent('li').hasClass('active')) {
                _this.parent('li').removeClass('active');
                _this.next('ul').removeClass('in');
            } else {
                $('#side-menu > li').removeClass('active');
                $('#side-menu > li ul').removeClass('in');
                _this.parent('li').addClass('active');
                _this.next('ul').addClass('in');
            }
        });
    }
    
    document.ready(function(){
        HT.customNavbar();
    });
})(jQuery);