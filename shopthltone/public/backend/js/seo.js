(function($){
	"use strict";
	var HT = {};
	HT.previewSeo = () => {
        var metaTitle = $('input[name=meta_title]').val();
        if (metaTitle != '') {
            $('.meta-title').html(metaTitle);
        }
        $('input[name=meta_title]').keyup(function(){
            let input = $(this);
            let val = input.val();
            $('.seo-container .meta-title').html(val);
        });
        
        
        var baseUrl = $('.baseUrl-custom').outerWidth();
        $('.canonical-wrapper input[name=canonical]').css({'padding-left':parseFloat(baseUrl)+10});

        var canon = $('.canonical-wrapper input[name=canonical]').val();
        if (canon != '') {
            canon = HT.removeUtf8(canon);
            var url = BASE_URL+canon+SUFFIX;
            $('.seo-container .canonical').html(url);
        }
        
        $('.canonical-wrapper input[name=canonical]').keyup(function(){
            var input = $(this);
            var val = HT.removeUtf8(input.val());
            var url = BASE_URL+val+SUFFIX;
            $('.seo-container .canonical').html(url);
        });

        var meta_desc = $('textarea[name=meta_desc]').val();
        if (meta_desc != '') {
            $('.seo-container .meta-description').html(meta_desc);
        }

        $('textarea[name=meta_desc]').keyup(function(){
            $('.seo-container .meta-description').html($(this).val());
        });
    }
    HT.removeUtf8 = (str) => {
        str = str.toLowerCase(); // chuyen ve ki tu biet thuong
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|,|\.|\:|\;|\'|\–| |\"|\&|\#|\[|\]|\\|\/|~|$|_/g, "-");
        str = str.replace(/-+-/g, "-");
        str = str.replace(/^\-+|\-+$/g, "");
        return str;
    }
	$(document).ready(function(){
		HT.previewSeo();
	});
})(jQuery);