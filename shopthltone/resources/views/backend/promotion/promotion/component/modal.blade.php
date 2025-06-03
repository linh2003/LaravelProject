<div id="modalPromotionProduct" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="search-model-box mb15">
                    <i class="fa fa-search"></i>
                    <input 
                        type="text" name="search_promotion_product"
                        class="form-control search-model search-promotion-product" 
                        placeholder="Tìm kiếm theo tên, mã sản phẩm, SKU..."
                    >
                </div>
                <!-- <div class="search-list mt20">Loading...</div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success confirm-product-promotion" data-dismiss="modal">{{$heading['create']['field']['type_option']['product']['modal']['save']}}</button>
            </div>
        </div>
    </div>
</div>