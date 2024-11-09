(function($){
	"use strict";
	var HT = {};
	HT.handleModal = () => {
        var popup = document.getElementById("popupDelete");
        var btn = document.getElementById("actionDelete");
        var span = document.getElementsByClassName("popup-close")[0];
        var wrapper = document.getElementById('wrapper');
        const div = document.createElement('div');
        div.className = 'popup-overlay';
        btn.onclick = function() {
            popup.style.display = "block";
            wrapper.classList.add('popup-overflow');
            wrapper.appendChild(div);
        }
        span.onclick = function() {
            popup.style.display = "none";
            wrapper.classList.remove('popup-overflow');
            if ($('.popup-overlay').length) {
                wrapper.remove($(this));
            }
        }
        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
                wrapper.classList.remove('popup-overflow');
                if ($('.popup-overlay').length) {
                    wrapper.remove($(this));
                }
            }
        }
    }
	$(document).ready(function(){
		HT.handleModal();
	});
})(jQuery);