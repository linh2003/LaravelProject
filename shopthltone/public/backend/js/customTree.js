(function($){
	"use strict";
	var HT = {};
	HT.jsTree = () => {
        
        $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
        $('#jstree1').on('click','.jstree-anchor',function()
        {
            document.location.href = this;
        });
        $(".dropdown-treeCat").click(function()
        {
            $('.ibox-post-catalogue').slideToggle(500);
        });
        
    }
	$(document).ready(function(){
		HT.jsTree();
	});
})(jQuery);