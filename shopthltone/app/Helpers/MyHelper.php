<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

/* sortString 
* Sử dụng với bài toán sx column code trong product variant
* để khi click ngoài frontend detail product page
* cho thống nhất kiểu ASC
*/
if (!function_exists('sortString')) {
    function sortString(string $str){
        $extract = explode(', ',$str);
        $sort = sort($extract, SORT_NUMERIC);
        $ret = implode(', ', $extract);
        return $ret;
    }
}
/* displayPrice */
if (!function_exists('displayPrice')) {
    function displayPrice($model){
        $html = '';
        $price = $model->price;
        $sale = isset($model->max_discount) ? $model->max_discount : 0;
        $price_sale = $price - $price*$sale/100;
        if ($sale > 0) {
            $html .= '<div class="price-sale">'.number_format($price_sale).'đ</div>';
			$html .= '<div class="price-old">'.number_format($model->price).'đ</div>';
        }else{
            $html .= '<div class="price-sale">'.number_format($model->price).'đ</div>';
        }
        return $html;
    }
}
/* setupSeo */
if (!function_exists('setupSeo')) {
    function setupSeo($model){
        $meta_description = (isset($model->meta_desc) && !empty($model->meta_desc)) ? $model->meta_desc : '';
        if (empty($meta_description)) {
            $meta_description = (isset($model->meta_description) && !empty($model->meta_description)) ? $model->meta_description : '';
        }
        if (empty($meta_description) && (isset($model->description) && !empty($model->description))) {
            $meta_description = cutStringDecode($model->description, 180);
        }
        return [
            'meta_title' => (isset($model->meta_title) && !empty($model->meta_title)) ? $model->meta_title : $model->name,
            'meta_keyword' => (isset($model->meta_keyword) && !empty($model->meta_keyword)) ? $model->meta_keyword : '',
            'meta_description' => $meta_description,
            'meta_image' => isset($model->image) ? $model->image : '',
            'canonical' => writeUrl($model->canonical, true, true)
        ];
    }
}
/* writeUrl */
if (!function_exists('writeUrl')) {
    function writeUrl($canonical, bool $fullDomain = true, bool $suffix = false){
        $fullUrl = '';
        if($fullDomain){
            $fullUrl = URL::to('/').'/';
        }
        $fullUrl .= $canonical;
        if($suffix){
            $fullUrl .= config('apps.general.suffix');
        }
        return $fullUrl;
    }
}
/* convertArrray */
if (!function_exists('convertArrray')) {
    function convertArray($data, $keyword, $value){
        $ret = [];
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $ret[$val[$keyword]] = $val[$value];
            }
        }
        if (is_object($data)) {
            foreach ($data as $key => $val) {
                $ret[$val->{$keyword}] = $val->{$value};
            }
        }
        return $ret;
    }
}
/* formatDate */
if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd/m/Y'){
        return Carbon::parse($date)->format($format);
    }
}
/* convertPrice */
if (!function_exists('convertPrice')) {
	function convertPrice(mixed $price='', $flag = false)
	{
		if($price === null) return 0;
		return ($flag === false) ? str_replace('.','', $price) : number_format($price, 0, ',', '.');
	}
}
/* cutnChar */
if (!function_exists('cutnChar')) {
	function cutnChar($str = NULL, $n = 320)
	{
		if (strlen($str) < $n) {
            return $str;
        }
        $html = substr($str, 0, $n);
        $html = substr($html, 0, strpos($html, ' '));
        return $html.'...';
	}
}
/* cut_string_and_decode */
if (!function_exists('cutStringDecode')) {
	function cutStringDecode($str = NULL, $n = 200)
	{
		$str = html_entity_decode($str);
        $str = strip_tags($str);
        $str = cutnChar($str, $n);
        return $str;
	}
}
/* renderTableHeadingHtml */
if (!function_exists('renderTableHeadingHtml')) {
    function renderTableHeadingHtml(array $column = []){
        $html = '';
        foreach ($column as $key => $col) {
            if (array_key_exists('checkbox', $column) && $key == 'checkbox') {
                foreach ($column['checkbox'] as $k => $val) {
                    if ($k == 'input') {
                        if(empty($html)){
                            $html .= '<th>';
                        }
                        $html .= renderInputHtml($val);
                    }else{
                        $html .= '<th '.$k.'="'.$val.'" >';
                    }
                }
                $html .= '</th>';
            }else{
                $html .= '<th ';
                foreach ($col as $keyCol => $valCol) {
                    $html .= $keyCol.'="'.$valCol.'" ';
                }
                $html .= '>'.$key.'</th>';
            }
        }
        // dd($html);
        return $html;
    }
}
/* renderInputHtml */
if (!function_exists('renderInputHtml')) {
    function renderInputHtml(array $input = [], $nameInput = '', $data = []){
        $html = '';
        if(count($input)){
            if($input['type'] == 'text'){
                $html .= '<input ';
                foreach ($input as $key => $val) {
                    $html .= $key.'="'.$val.'" name="'.$nameInput.'"';
                    $html .= 'value="'.((isset($data[$nameInput]) && $data[$nameInput] != null) ? $data[$nameInput] : '').'"';
                }
                $html .= ' />';
            }
            if($input['type'] == 'checkbox'){
                $html .= '<input ';
                foreach ($input as $key => $val) {
                    $html .= $key.'="'.$val.'"';
                }
                $html .= ' />';
            }else if ($input['type'] == 'file') {
                $html .= '<div class="group-finder"><span class="image img-cover image-target">';
                $html .= '<img src="'.asset(((isset($data[$nameInput]) && $data[$nameInput] != null) ? $data[$nameInput] : "backend/images/not-found.jpg")).'" alt="" />';
                $html .= '</span>';
                $html .= '<input type="hidden" name="'.$nameInput.'" value="'.((isset($data[$nameInput]) && $data[$nameInput] != null) ? $data[$nameInput] : '').'" /></div>';
            }else if($input['type'] == 'textarea'){
                $html .= '<textarea ';
                foreach ($input as $key => $val) {
                    if($key == 'type') continue;
                    $html .= $key.'="'.$val.'" name="'.$nameInput.'"';
                }
                $html .= '>'.((isset($data[$nameInput]) && $data[$nameInput] != null) ? $data[$nameInput] : '').'</textarea>';
            }
        }
        return $html;
    }
}