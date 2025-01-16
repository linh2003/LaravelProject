(function($){
	"use strict";
	var HT = {};
	HT.sortAbleUI = () => {
        $('#sortable').sortable().disableSelection();
    }
	$(document).ready(function(){
		HT.sortAbleUI();
	});
})(jQuery);