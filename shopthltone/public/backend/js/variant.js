(function($){
	"use strict";
	var HT = {};
	$('form').on('submit', function (e) {
	    $('.choose-attribute').each(function () {
	        console.log($(this).val()); // Kiểm tra giá trị của từng select
	        return false;
	    });
	});
	HT.variantAlbum = () => {
		$(document).on('click', '.upload-variant-picture', function(e){
			HT.browerVariantServerAlbum();
			e.preventDefault();
		});
	}
	HT.browerVariantServerAlbum = () => {
		var type = 'Images';
		var finder = new CKFinder();
		finder.resourceType = type;
		finder.selectActionFunction = function(fileUrl, data, allFiles){
			var html = '';
			for (var i = 0; i < allFiles.length; i++) {
				var image = allFiles[i].url;
				html += '<li class="ui-state-default"><div class="thumb"><span class="span image img-scaledown">';
				html += '<img src="'+image+'" alt="" /><input type="hidden" name="variantAlbum[]" value="'+image+'"></span>';
				html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button></div></li>';
			}
			// $('.click-to-upload-variant').addClass('hide');
			$('#sortable2').append(html);
			$('.upload-variant-list').removeClass('hide');
		}
		finder.popup();
	}
	HT.deleteVariantPicture = () => {
		$(document).on('click','.variant-delete-image',function(){
			let _this = $(this);
			_this.parents('.ui-state-default').remove();
			if ($('.ui-state-default').length == 0) {
				$('.click-to-upload-variant').removeClass('hide');
			}
		});
	}
	HT.addVarriant = () => {
        var html = HT.renderVariantItem(attributeTypes);
        $('.setupSelect2').select2();
        $(document).on('click','.add-variant',function(){
			console.log('add variant click');
			let price = $('input[name=price]').val();
			let code = $('input[name=code]').val();
			if (price == '' || code == '') {
				alert('Bạn phải nhập Giá và mã sản phẩm để sử dụng chức năng này!');
				return false;
			}
            $('.variant-body').append(html);
            $('table.variantTable thead').html('');
            $('table.variantTable tbody').html('');
            HT.disabledSelectAttribute();
			HT.checkMaxAttributeGroup(attributeTypes);
        });
    }
    HT.renderVariantItem = (attributeTypes) => {
		// console.log(attributeTypes);
        var html = '';
		// var atTypes = JSON.parse(attributeTypes);
		// console.log(atTypes);
        html += '<div class="row variant-item">';
					html += '<div class="col-sm-3">';
						html += '<select class="form-control setupSelect2 choose-attribute" name="attributeType[]">';
							html += '<option value="0">-- Chọn thuộc tính --</option>';
							for (let i = 0; i < attributeTypes.length; i++) {
								html += '<option value="'+attributeTypes[i].id+'">'+attributeTypes[i].name+'</option>';
							}
						html += '</select>';
					html += '</div>';
					html += '<div class="col-sm-8">';
						html += '<input type="text" name="variant" class="form-control" disabled />';
					html += '</div>';
					html += '<div class="col-sm-1">';
						html += '<button type="button" class="btn btn-outline btn-danger dim remove-attribute"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
					html += '</div>';
				html += '</div>';
        return html;
    }
	HT.disabledSelectAttribute = () => {
		let ids = [];
		$('.choose-attribute').each(function(){
			var _this = $(this);
			// var selected = _this.find('option:selected').val();
			// if(selected != 0){
			// 	ids.push(selected);
			// }
			if (_this.val()) {
				$('.choose-attribute').not($(this)).find('option[value='+_this.val()+']').prop('disabled',true);
			}
		});
		// $('.choose-attribute').find('option').remove('disabled');
		// for (let i = 0; i < ids.length; i++) {
		// 	$('.choose-attribute').not($(this)).find('option[value='+ids[i]+']').prop('disabled',true);
		// }
		$('.setupSelect2').select2();
	}
	HT.changeAttributeTypeOnProduct = () => {
		$(document).on('change','.choose-attribute',function(){
			// console.log('choose-attribute click');
			let _this = $(this);
			let atTypeId = _this.val();
			// console.log('atTypeId_1:'+atTypeId);
			if (atTypeId != 0) {
				// console.log('atTypeId_2:'+atTypeId);
				_this.parents('.col-sm-3').siblings('.col-sm-8').html(HT.select2Variant(atTypeId));
				$('.selectVariant').each(function(){
					HT.getSelect2($(this));
				});
			}else{
				_this.parents('.col-sm-3').siblings('.col-sm-8').html('<input type="text" name="variant" class="form-control" disabled />');
			}
			HT.disabledSelectAttribute();
		});
	}
	HT.checkMaxAttributeGroup = (attributeTypes) => {
		var items = $('.variant-item').length;
		
		if (items >= attributeTypes.length) {
			$('.add-variant').remove();
		}else{
			$('.variant-footer').html('<button type="button" class="btn btn-primary add-variant">Thêm thuộc tính mới</button>');
		}
	}
	HT.removeAttributeGroup = () => {
		$(document).on('click','.remove-attribute',function(){
			$(this).parents('.variant-item').remove();
			HT.checkMaxAttributeGroup(attributeTypes);
			HT.createVariant();
			HT.disabledSelectAttribute();
		});
	}
	HT.select2Variant = (attributeTypes) => {
		let html = '<select class="selectVariant variant-'+attributeTypes+' form-control" name="attribute['+attributeTypes+'][]" multiple data-catid="'+attributeTypes+'"></select>';
		return html;
	}
	HT.getSelect2 = (object) => {
		let option = {
			'attributeTypeId' : object.attr('data-catid')
		};
		$(object).select2({
			minimumInputLength: 2,
			placeholder: 'Nhập tối thiểu 2 ký tự để tìm kiếm',
			ajax: {
				url: '/ajax/attribute/getattribute',
				type: 'GET',
				dataType: 'json',
				delay: 250,
				data: function(params){
					return {
						search: params.term,
						option: option,
					}
				},
				processResults: function(data){
					// console.log(data);
					return {
						results: $.map(data, function(obj,i){
							return obj;
						})
					}
				},
				cache: true
			}
		});
	}
	HT.createProductVariant = () => {
		$(document).on('change', '.selectVariant', function(){
			let _this = $(this);
			HT.createVariant();
		});
	}
	HT.createVariant = () => {
		let attributes = [];
		let variants = [];
		let attributeTitle = [];
		$('.variant-item').each(function(){
			let _this = $(this);
			let attr = [];
			let attrVariant = [];
			let attributeTypeId = _this.find('.choose-attribute option:selected').val();
			// console.log('attributeTypeId in createVariant:'+attributeTypeId);
			let optionText = _this.find('.choose-attribute option:selected').text();
			// console.log('optionText in createVariant:'+optionText);
			let attribute = $('.variant-'+attributeTypeId).select2('data');
			// console.log(attribute);
			for (let i = 0; i < attribute.length; i++) {
				let item = {};
				let itemVariant = {};
				item[optionText] = attribute[i].text;
				itemVariant[attributeTypeId] = attribute[i].id;
				attr.push(item);
				attrVariant.push(itemVariant);
			}
			attributeTitle.push(optionText);
			attributes.push(attr);
			variants.push(attrVariant);
		});
		attributes = attributes.reduce(
			(a,b) => a.flatMap(d => b.map(e => ({... d, ... e})))
		);
		variants = variants.reduce(
			(a,b) => a.flatMap(d => b.map(e => ({... d, ... e})))
		);
		HT.createTableHeader(attributeTitle);
		let classes = [];
		attributes.forEach((item, index) => {
			let row = HT.createVariantRow(item,variants[index]);
			let classModified = 'tr-variant-' + Object.values(variants[index]).join(', ').replace(/, /g,'-');
			classes.push(classModified);
			if (!$('table.variantTable tbody tr').hasClass(classModified)) {
				$('table.variantTable tbody').append(row);
			}
		});
		$('table.variantTable tbody tr').each(function(){
			const row = $(this);
			const rowClass = row.attr('class');
			if (rowClass) {
				const rowClassArr = rowClass.split(' ');
				let shouldRemove = false;
				rowClassArr.forEach(rowClass => {
					if (rowClass == 'variant-row') {
						return;
					}else if (!classes.includes(rowClass)) {
						shouldRemove = true;
					}
				});
				if (shouldRemove) {
					row.remove();
				}
			}
		});
		// console.log(variants);
		// let html = HT.renderTableProductVariant(attributes, attributeTitle, variants);
		// $('table.variantTable').html(html);
	}
	HT.createVariantRow = (attributeItem, variantItem) => {
		let attributeString = Object.values(attributeItem).join(', ');
		let attributeId = Object.values(variantItem).join(', ');
		let classModified = attributeId.replace(/, /g,'-');
		let row = $('<tr>').addClass('variant-row tr-variant-' + classModified);
		let td = $('<td>').addClass('td-variant-thumb');
		row.append(td);
		Object.values(attributeItem).forEach(value => {
			td = $('<td>').text(value);
			row.append(td);
		});
		td = $('<td>').addClass('hide td-variant');
		let mainPrice = $('input[name=price]').val();
		let mainCode = $('input[name=code]').val() + '-' + classModified;
		let inputHideFields = [
			{ name: 'variant[quantity][]', class: 'variant-quantity', data_target: 'variant_quantity' },
			{ name: 'variant[sku][]', class: 'variant-sku', data_target: 'variant_sku', value: mainCode },
			{ name: 'variant[price][]', class: 'variant-price', data_target: 'variant_price', value: mainPrice },
			{ name: 'variant[barcode][]', class: 'variant-barcode', data_target: 'variant_barcode' },
			{ name: 'variant[file][]', class: 'variant-file', data_target: 'variant_file' },
			{ name: 'variant[path][]', class: 'variant-path', data_target: 'variant_path' },
			{ name: 'variant[album][]', class: 'variant-album', data_target: 'variant_album' },
			{ name: 'productVariant[name][]', value: attributeString },
			{ name: 'productVariant[id][]', value: attributeId },
		];
		$.each(inputHideFields, function(_, field){
			let input = $('<input>').attr('type', 'text').addClass(field.class).attr('name', field.name).attr('data-target', field.data_target);
			if (field.value) {
				input.val(field.value);
			}
			td.append(input);
		});
		row.append($('<td>').addClass('td-quantity').text('-'))
			.append($('<td>').addClass('td-price').text(mainPrice))
			.append($('<td>').addClass('td-sku').text(mainCode))
			.append(td);
		return row;
	}
	HT.createTableHeader = (attributeTitle) => {
		let thead = $('table.variantTable thead');
		let row = $('<tr>');
		row.append($('<th>').text('Hình ảnh'));
		for (var i = 0; i < attributeTitle.length; i++) {
			row.append($('<th>').text(attributeTitle[i]));
		}
		row.append($('<th>').text('Số lượng'));
		row.append($('<th>').text('Giá tiền'));
		row.append($('<th>').text('SKU'));
		thead.html(row);
		return thead;
	}
	/* BEGIN NOT USE */
	HT.renderTableProductVariant = (attributes, attributeTitle, variants) => {
		let html = '<thead>';
					html = html + '<tr>';
						html = html + '<th data-toggle="true">Hình ảnh</th>';
						for (let i = 0; i < attributeTitle.length; i++) {
							html = html + '<th>'+attributeTitle[i]+'</th>';
						}
						html = html + '<th>Số lượng</th>';
						html = html + '<th>Giá</th>';
						html = html + '<th>SKU</th>';
					html = html + '</tr>';
				html = html + '</thead>';
				html = html + '<tbody>';
				for (let j = 0; j < attributes.length; j++) {
					html = html + '<tr class="variant-row">';
						html = html + '<td class="td-variant-thumb"></td>';
						let attrStrName = [];
						let attrArrId = [];
						$.each(attributes[j],function(index,value){
							html = html + '<td>'+value+'</td>';
							attrStrName.push(value);
						});
						$.each(variants[j],function(index,value){
							html = html + '<td class="hide">'+value+'</td>';
							attrArrId.push(value);
						});
						var attrStr = attrStrName.join(', ');
						var attrStrId = attrArrId.join(', ');
						html = html + '<td class="td-quantity">-</td>';
						html = html + '<td class="td-price">-</td>';
						html = html + '<td class="td-sku">-</td>';
						html = html + '<td class="hide td-variant">';
						html = html + '<input type="text" name="variant[quantity][]" class="variant-quantity" data-target="variant_quantity" />';
						html = html + '<input type="text" name="variant[sku][]" class="variant-sku" data-target="variant_sku" />';
						html = html + '<input type="text" name="variant[barcode][]" class="variant-barcode" data-target="variant_barcode" />';
						html = html + '<input type="text" name="variant[price][]" class="variant-price" data-target="variant_price" />';
						html = html + '<input type="text" name="variant[file][]" class="variant-file" data-target="variant_file" />';
						html = html + '<input type="text" name="variant[path][]" class="variant-path" data-target="variant_path" />';
						html = html + '<input type="text" name="variant[album][]" class="variant-album" data-target="variant_album" />';
						html = html + '<input type="text" name="productVariant[name][]" value="'+attrStr+'" />';
						html = html + '<input type="text" name="productVariant[id][]" value="'+attrStrId+'" />';
						html = html + '</td>';
					html = html + '</tr>';
				}
				html = html + '</tbody>';
		return html;
	}
	/* END NOT USE */
	HT.updateVariant = () => {
		$(document).on('click','.variant-row',function(){
			// console.log('variant-row');
			var _this = $(this);
			let variantData = {};
			_this.find('.td-variant input[type=text][class^="variant-"]').each(function(){
				let targetInput = $(this).attr('data-target');
				variantData[targetInput] = $(this).val();
				// if (targetInput == 'variant_album') {
				// 	variantData[targetInput] = HT.renderPictureVariant(variantData[targetInput]);
				// }
			});
			// console.log(variantData);
			var updateVariantBox = HT.updateVariantHtml(variantData);
			if ($('.updateVariantRow').length == 0) {
				_this.after(updateVariantBox);
				HT.switchery();
			}
			
		});
	}
	HT.updateVariantHtml = (variantData) => {
		let variantAlbum = HT.variantAlbumList(variantData.variant_album);
		let html = '';
		html = html + '<tr class="updateVariantRow"><td colspan="6">';
			html = html + '<div class="updateVariant ibox">';
				html = html + '<div class="ibox-title">';
					html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">';
						html = html + '<h5 class="mb-0">Cập nhật thông tin phiên bản</h5>';
						html = html + '<div class="uk-flex justify-content-end">';
							html = html + '<button type="button" class="btn btn-danger cancelUpdate">Hủy bỏ</button>';
							html = html + '<button type="button" class="btn btn-primary applyUpdate ml-3">Lưu thay đổi</button>';
						html = html + '</div>';
					html = html + '</div>';
				html = html + '</div>';
				html = html + '<div class="ibox-content">';
					html = html + '<div class="click-to-upload-variant">';
						html = html + '<div class="icon">';
							html = html + '<a href="" class="upload-variant-picture">';
								html = html + '<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>';
							html = html + '</a>';
						html = html + '</div>';
					html = html + '</div>';
					html = html + '<div class="upload-variant-list '+ ( variantAlbum.length > 0 ? '' : 'hide' ) +'"><ul id="sortable2" class="sortui clearfix data-album ui-sortable">'+ ( variantAlbum.length > 0 ? variantAlbum : '' ) +'</ul></div>';
					html = html + '<div class="row uk-flex uk-flex-middle mt-3">';
						html = html + '<div class="col-sm-2 uk-flex uk-flex-middle">';
							html = html + '<label for="" class="control-label mb-0">Tồn kho&nbsp;&nbsp;</label>';
							html = html + '<input type="checkbox" class="js-switch" data-target="variantQuantity" />';
						html = html + '</div>';
						html = html + '<div class="col-sm-10">';
							html = html + '<div class="row">';
								html = html + '<div class="col-sm-3">';
									html = html + '<label for="" class="control-label">Số lượng</label>';
									html = html + '<input type="text" class="form-control int disabled" name="variant_quantity" disabled value='+variantData.variant_quantity+'>';
								html = html + '</div>';
								html = html + '<div class="col-sm-3">';
									html = html + '<label for="" class="control-label">SKU</label>';
									html = html + '<input type="text" class="form-control" name="variant_sku" value='+variantData.variant_sku+'>';
								html = html + '</div>';
								html = html + '<div class="col-sm-3">';
									html = html + '<label for="" class="control-label">Giá</label>';
									html = html + '<input type="text" class="form-control int" name="variant_price" value='+variantData.variant_price+'>';
								html = html + '</div>';
								html = html + '<div class="col-sm-3">';
									html = html + '<label for="" class="control-label">Barcode</label>';
									html = html + '<input type="text" class="form-control" name="variant_barcode" value='+variantData.variant_barcode+'>';
								html = html + '</div>';
							html = html + '</div>';
						html = html + '</div>';
					html = html + '</div>';
					html = html + '<div class="row uk-flex uk-flex-middle mt-3">';
						html = html + '<div class="col-sm-2 uk-flex uk-flex-middle">';
							html = html + '<label for="" class="control-label mb-0">QL File&nbsp;&nbsp;</label>';
							html = html + '<input type="checkbox" class="js-switch" data-target="variantFile" />';
						html = html + '</div>';
						html = html + '<div class="col-sm-10">';
							html = html + '<div class="row">';
								html = html + '<div class="col-sm-6">';
									html = html + '<label for="" class="control-label">Tên File</label>';
									html = html + '<input type="text" class="form-control disabled" name="variant_file" disabled value='+variantData.variant_file+'>';
								html = html + '</div>';
								html = html + '<div class="col-sm-6">';
									html = html + '<label for="" class="control-label">Đường dẫn</label>';
									html = html + '<input type="text" class="form-control disabled" name="variant_path" disabled value='+variantData.variant_path+'>';
								html = html + '</div>';
							html = html + '</div>';
						html = html + '</div>';
					html = html + '</div>';
				html = html + '</div>';
			html = html + '</div>';
		html = html + '</td></tr>';
		return html;
	}
	HT.cancelUpdateVariant = () => {
		$(document).on('click', '.cancelUpdate', function(){
			HT.closeVariantBox();
		});
	}
	HT.closeVariantBox = () => {
		$('.updateVariantRow').remove();
	}
	HT.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small' });
        });
    }
    HT.switchChange = () => {
    	$(document).on('change', '.js-switch', function(){
    		var _this = $(this);
    		var checked = _this.prop('checked');
    		if (checked) {
    			_this.parents('.col-sm-2').siblings('.col-sm-10').find('.disabled').removeAttr('disabled');
    		}else{
    			_this.parents('.col-sm-2').siblings('.col-sm-10').find('.disabled').attr('disabled',true);
    		}
    	});
    }
    HT.saveVariantUpdate = () => {
    	$(document).on('click', '.applyUpdate', function(){
    		let variant = {
    			'quantity' : $('input[name=variant_quantity]').val(),
    			'sku' : $('input[name=variant_sku]').val(),
    			'price' : $('input[name=variant_price]').val(),
    			'barcode' : $('input[name=variant_barcode]').val(),
    			'file' : $('input[name=variant_file]').val(),
    			'path' : $('input[name=variant_path]').val(),
    			'album' : $('input[name="variantAlbum[]"]').map(function(){
    				return $(this).val()
    			}).get()
    		}
    		
    		$.each(variant, function(index, value){
    			$('.updateVariantRow').prev().find('.variant-'+index).val(value);
    			$('.updateVariantRow').prev().find('.td-'+index).html(value);
    			if(index == 'album'){
    				HT.variantSetThumbnail(value);
    			}
    		});
    		HT.closeVariantBox();
    	});
    }
    HT.variantAlbumList = (albumVariant) => {
    	let arrAlbum = albumVariant.split(',');
    	let html = '';
    	if (albumVariant.length == 0) { return html; }
    	for (var i = 0; i < arrAlbum.length; i++) {
			html += '<li class="ui-state-default"><div class="thumb"><span class="span image img-scaledown">';
			html += '<img src="'+arrAlbum[i]+'" alt="" /><input type="hidden" name="variantAlbum[]" value="'+arrAlbum[i]+'"></span>';
			html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button></div></li>';
		}
		return html;
    }
    HT.addCommas = (nStr) => {
    	nStr = String(nStr);
    	nStr = nStr.replace(/\./gi,"");
    	let str = '';
    	for (var i = nStr.length; i >= 0; i-=3) {
    		let a = ( (i-3) < 0 ) ? 0 : (i-3);
    		str = nStr.slice(a,i) + '.' + str;
    	}
    	str = str.slice(0, str.length - 1);
    	return str;
    }
    HT.variantSetThumbnail = (albumVariant) => {
    	console.log('thumb:');
    	console.log(albumVariant);
    	if (albumVariant.length > 0) {
    		var html = '<img src="'+ albumVariant[0] +'" alt="" />';
    		$('.updateVariantRow').prev().find('.td-variant-thumb').html(html);
    	}
    }
    HT.setupSelectMultiple = (callback) => {
    	// console.log('setup Select Multiple');
    	// const attr = JSON.parse(attribute);
    	// console.log('select Variant length:'+$('.selectVariant').length);
    	if($('.selectVariant').length){
    		let count = $('.selectVariant').length;
    		$('.selectVariant').each(function(){
    			let _this = $(this);
    			let attributeType = _this.attr('data-catid');
    			if (attribute != '') {
    				$.get('/ajax/attribute/loadAttribute', {
    					attribute: attribute,
    					attributeType: attributeType,
    				}, function(json){
    					if (json.items != 'undefined' && json.items.length) {
    						for (var i = 0; i < json.items.length; i++) {
    							var option = new Option(json.items[i].text, json.items[i].id, true, true);
    							_this.append(option).trigger('change');
    						}
    					}
    					if (--count === 0 && callback) {
    						callback();
    					}
    				});
    			}
    			HT.getSelect2(_this);
    		});
    		
    	}
    }
    HT.productVariant = () => {
    	variant = JSON.parse(atob(variant));
    	// console.log($('.variant-row').length);
    	$('.variant-row').each(function(index, value){
    		let _this = $(this);
    		let inputHideFields = [
				{ name: 'variant[quantity][]', class: 'variant-quantity', data_target: 'variant_quantity', value: variant.quantity[index] },
				{ name: 'variant[sku][]', class: 'variant-sku', data_target: 'variant_sku', value: variant.sku[index] },
				{ name: 'variant[price][]', class: 'variant-price', data_target: 'variant_price', value: variant.price[index] },
				{ name: 'variant[barcode][]', class: 'variant-barcode', data_target: 'variant_barcode', value: variant.barcode[index] },
				{ name: 'variant[file][]', class: 'variant-file', data_target: 'variant_file', value: variant.file[index] },
				{ name: 'variant[path][]', class: 'variant-path', data_target: 'variant_path', value: variant.path[index] },
				{ name: 'variant[album][]', class: 'variant-album', data_target: 'variant_album', value: variant.album[index] }
			];
			for (var i = 0; i < inputHideFields.length; i++) {
				_this.find('.'+inputHideFields[i].class).val(inputHideFields[i].value);
			}
			let album = variant.album[index];
			let variantImage = (album) ? album.split(',')[0] : '';

			_this.find('.td-quantity').html(HT.addCommas(variant.quantity[index]));
			_this.find('.td-price').html(HT.addCommas(variant.price[index]));
			_this.find('.td-sku').html(variant.sku[index]);
			var img = '<img src="'+ variantImage +'" alt="" />';
    		_this.find('.td-variant-thumb').html(img);
    	});
    }
	$(document).ready(function(){
		HT.variantAlbum();
		HT.addVarriant();
		HT.changeAttributeTypeOnProduct();
		HT.removeAttributeGroup();
		HT.createProductVariant();
		HT.updateVariant();
		HT.cancelUpdateVariant();
		HT.deleteVariantPicture();
		HT.switchChange();
		HT.saveVariantUpdate();
		HT.setupSelectMultiple(
			() => {
				HT.productVariant();
			}
		);
	});
})(jQuery);