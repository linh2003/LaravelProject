(function($){
    // "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    var document = $(document);
    HT.changeStatus = () => {
        $('.status').on('change',function(){
            let _this = $(this);
            let option = {
                'val' : _this.val(),
                'model' : _this.attr('data-model'),
                'modelId' : _this.attr('data-modelId'),
                'field' : _this.attr('data-field'),
                '_token' : _token,
            }
            $.ajax({
                url: '/ajax/changestatus',
                type : 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                },
                error: function(jqXHR,textStatus,errorThrown){
                    console.log('Error:'+textStatus+' '+errorThrown);
                }
            });
        });
    }
    HT.checkAll = () => {
        if ($('#checkAll').length) {
            $('#checkAll').click(function(){
                let isChecked = $(this).prop('checked');
                $('.checkBoxItem').prop('checked',isChecked);
                $('.checkBoxItem').each(function(){
                    let parentTr = $(this).closest('tr');
                    let itemChecked = $(this).prop('checked');
                    if (itemChecked==true) {
                        $(this).closest('tr').addClass('active-checked');
                    }else{
                        $(this).closest('tr').removeClass('active-checked');
                    }
                });
            });
            $('.checkBoxItem').click(function(){
                let itemChecked = $(this).prop('checked');
                if (itemChecked == false) {
                    $(this).closest('tr').removeClass('active-checked');
                    let isChecked = $('#checkAll').prop('checked');
                    if (isChecked) {
                        $('#checkAll').prop('checked',false);
                    }
                }else{
                    $(this).closest('tr').addClass('active-checked');
                }
                HT.allChecked();
            });
        }
    }
    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked',allChecked);
    }
    HT.changStatusAll = () => {
        $('.changStatusAll').click(function(){
            // console.log('changStatus All');
            let _this = $(this);
            let ids = [];
            $('.checkBoxItem').each(function(){
                let checkBoxItem = $(this);
                if (checkBoxItem.prop('checked')) {
                    ids.push(checkBoxItem.val());
                }
            });
            // console.log(ids);
            let option = {
                'val' : _this.attr('data-value'),
                'model' : _this.attr('data-model'),
                'modelId' : ids,
                'field' : _this.attr('data-field'),
                '_token' : _token,
            }
            $.ajax({
                url: '/ajax/changestatusall',
                type : 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if (res.flag) {
                        for (let i = 0; i < ids.length; i++) {
                            let swInput = $('.switch-status-'+ids[i]);
                            if (option.val==1) {
                                swInput.find('span.switchery').attr('style','background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 11px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;').find('small').attr('style','left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s, left 0.2s;');
                            }else{
                                swInput.find('span').attr('style','background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s, box-shadow 0.4s;').find('small').attr('style','left: 0px; transition: background-color 0.4s, left 0.2s;');
                            }
                        }
                        
                    }
                },
                error: function(jqXHR,textStatus,errorThrown){
                    console.log('Error:'+textStatus+' '+errorThrown);
                }
            });
        });
    }
    document.ready(function(){
        HT.changeStatus();
        HT.checkAll();
        HT.changStatusAll();
    });
})(jQuery);