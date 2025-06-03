<div class="filter">
    <div class="uk-flex uk-flex-middle">
        <div class="filter-widget mr20">
            <div class="uk-flex uk-flex-middle">
				<a href="" class="view-grid active"><i class="fi-rs-grid"></i></a>
				<a href="" class="view-grid view-list"><i class="fi-rs-list"></i></a>
				 <div class="filter-button ml10 mr20">
                    <a href="" class="btn-filter uk-flex uk-flex-middle">
                        <i class="fi-rs-filter mr5"></i>
                        <span>Bộ Lọc</span>
                    </a>
                </div>
			</div>
		</div>
		<div class="perpage uk-flex uk-flex-middle">
            <div class="filter-text">Hiển thị</div>
            <select name="perpage" id="perpage" class="nice-select">
                @foreach($config['filter']['perpage']['value'] as $k => $item)
                <option value="{{ $item }}"> {{ $item.' '.$config['filter']['perpage']['label'] }} </option>
                @endforeach
            </select>
        </div>
	</div>
</div>