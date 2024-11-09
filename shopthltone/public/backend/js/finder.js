(function($){
	"use strict";
	var HT = {};
	HT.setupCkeditor = () => {
		if ($('.ck-editor')) {
			$('.ck-editor').each(function(){
				let editor = $(this);
				let elementId = editor.attr('id');
				let elementHeight = editor.attr('data-height');
				HT.ckeditor4(elementId,elementHeight);
			});
		}
	}
	HT.ckeditor4 = (elementId,elementHeight) => {
		if(typeof(elementHeight) == 'undefined'){
			elementHeight = 500;
		}
		CKEDITOR.replace( elementId, {
            height: elementHeight,
            removeButtons: '',
            entities: true,
            allowedContent: true,
            toolbarGroups: [
                { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker','undo' ] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'forms' },
                { name: 'tools' },
                { name: 'document',    groups: [ 'mode', 'document', 'doctools'] },
                { name: 'others' },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup','colors','styles','indent'  ] },
                { name: 'paragraph',   groups: [ 'list', '', 'blocks', 'align', 'bidi' ] },
            ],
            removeButtons: 'Save,NewPage,Pdf,Preview,Print,Find,Replace,CreateDiv,SelectAll,Symbol,Block,Button,Language',
            removePlugins: "exportpdf",
        
        });
	}
	HT.uploadThumbnail = () => {
		$('.image-target').click(function(){
			let input = $(this);
			let type = "Images";
			HT.browerServerThumbnail(input,type);
		});
	}
	HT.browerServerThumbnail = (object,type) => {
		if(typeof(type) == 'undefined'){
			type = 'Images';
		}
		var finder = new CKFinder();
		finder.resourceType = type;
		finder.selectActionFunction = function(fileUrl,data){
			// var parts = fileUrl.split('/');
			// if (parts[0]==='public') {
			// 	parts.shift();
			// }
			// fileUrl = parts.join('/');
			object.find('img').attr('src',fileUrl);
			object.siblings('input').val(fileUrl);
		}
		finder.popup();
	}
	HT.uploadImageToInput = () => {
		$('.upload-image').click(function(){
			let input = $(this);
			let type = input.attr('data-type');
			// console.log('type:'+type);
			HT.setupCkFinder2(input,type);
		});
	}
	HT.setupCkFinder2 = (object,type) => {
		if(typeof(type) == 'undefined'){
			type = 'Images';
		}
		var finder = new CKFinder();
		finder.resourceType = type;
		finder.selectActionFunction = function(fileUrl,data){
			// var parts = fileUrl.split('/');
			// if (parts[0]==='public') {
			// 	parts.shift();
			// }
			// fileUrl = parts.join('/');
			object.val(fileUrl);
		}
		finder.popup();
		
	}
	HT.multipleUploadImageCkeditor = () => {
		$(document).on('click','.multipleUploadImageCkeditor',function(e){
			let obj = $(this);
			let target = obj.attr('data-target');
			HT.browerServerCkeditor(obj,'Images',target);
			e.preventDefault();
		});
	}
	
	HT.browerServerCkeditor = (object,type,target) => {
		if(typeof(type) == 'undefined'){
			type = 'Images';
		}
		var finder = new CKFinder();
		finder.resourceType = type;
		finder.selectActionFunction = function(fileUrl, data, allFiles){
			var html = '';
			for (var i = 0; i < allFiles.length; i++) {
				var image = allFiles[i].url;
				html += '<figure><img src="'+image+'" alt="" /><figcaption>Nhập mô tả</figcaption></figure>';
			}
			CKEDITOR.instances[target].insertHtml(html);
		}
		finder.popup();
	}
	HT.uploadAlbum = () => {
		$(document).on('click','.upload-picture',function(e){
			HT.browerServerAlbum();
			e.preventDefault();
		});
	}
	HT.browerServerAlbum = () => {
		var type = 'Images';
		var finder = new CKFinder();
		finder.resourceType = type;
		finder.selectActionFunction = function(fileUrl, data, allFiles){
			var html = '';
			for (var i = 0; i < allFiles.length; i++) {
				var image = allFiles[i].url;
				html += '<li class="ui-state-default"><div class="thumb"><span class="span image img-scaledown">';
				html += '<img src="'+image+'" alt="" /><input type="hidden" name="album[]" value="'+image+'"></span>';
				html += '<button class="delete-image"><i class="fa fa-trash"></i></button></div></li>';
			}
			$('.click-to-upload').addClass('hide');
			$('#sortable').append(html);
			$('.upload-list').removeClass('hide');
		}
		finder.popup();
	}
	HT.deletePicture = () => {
		$(document).on('click','.delete-image',function(){
			let _this = $(this);
			_this.parents('.ui-state-default').remove();
			if ($('.ui-state-default').length == 0) {
				$('.click-to-upload').removeClass('hide');
			}
		});
	}
	$(document).ready(function(){
		HT.uploadImageToInput();
		HT.setupCkeditor();
		HT.uploadThumbnail();
		HT.multipleUploadImageCkeditor();
		HT.uploadAlbum();
		HT.deletePicture();
	});
})(jQuery);