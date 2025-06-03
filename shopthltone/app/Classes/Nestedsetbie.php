<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Nestedsetbie
{
    protected $params;
    protected $checked;
    protected $data;
    protected $count;
    protected $count_level;
    protected $lft;
    protected $rgt;
    protected $level;
    function __construct($params = NULL){
		$this->params = $params;
		$this->checked = NULL;
		$this->data = NULL;
		$this->count = 0;
		$this->count_level = 0;
		$this->lft = NULL;
		$this->rgt = NULL;
		$this->level = NULL;
	}

	public function Get(){
		$catalogue = (isset($this->params['isMenu']) && $this->params['isMenu'] == true ) ? '' : '_catalogue'; //catalogue='_catalogue'
		$foreignkey = (isset($this->params['foreignkey'])) ? $this->params['foreignkey'] : 'post_catalogue_id';
		$moduleExtract = explode('_', $this->params['table']); //product
		$join = (isset($this->params['isMenu']) && $this->params['isMenu'] == true ) ? substr($moduleExtract[0], 0, -1) : $moduleExtract[0]; // product
		$result = DB::table($this->params['table'].' as tb1')
		->select('tb1.id','tb2.name','tb1.parentid','tb1.lft','tb1.rgt','tb1.level','tb1.order')
		->join($join.$catalogue.'_language as tb2', 'tb1.id', '=', 'tb2.'.$foreignkey.'')
		->where('tb2.language_id','=', $this->params['language_id'])->whereNull('tb1.deleted_at')
		->orderBy('tb1.lft','asc')->get()->toArray();
		$this->data = $result;
	}

	public function Set(){
		if(isset($this->data) && is_array($this->data)){
			$arr = NULL;
			foreach($this->data as $key => $val){
				$arr[$val->id][$val->parentid] = 1;
				$arr[$val->parentid][$val->id] = 1;
			}
			return $arr;
		}
	}

	public function Recursive($start = 0, $arr = NULL){
		$this->lft[$start] = ++$this->count;
		$this->level[$start] = $this->count_level;
		if(isset($arr) && is_array($arr)){
			foreach($arr as $key => $val){
				if((isset($arr[$start][$key]) || isset($arr[$key][$start])) &&(!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))){
					$this->count_level++;
					$this->checked[$start][$key] = 1;
					$this->checked[$key][$start] = 1;
					$this->recursive($key, $arr);
					$this->count_level--;
				}
			}
		}
		$this->rgt[$start] = ++$this->count;
	}

    public function Action(){
		if(isset($this->level) && is_array($this->level) && isset($this->lft) && is_array($this->lft) && isset($this->rgt) && is_array($this->rgt)){

			$data = NULL;
			foreach($this->level as $key => $val){
				if($key == 0) continue;
				$data[] = array(
					'id' => $key,
					'level' => $val,
					'lft' => $this->lft[$key],
					'rgt' => $this->rgt[$key],
					'user_id' => Auth::id(),
				);
			}
			if(isset($data) && is_array($data) && count($data)){
				DB::table($this->params['table'])->upsert($data, 'id', ['level','lft','rgt']);
			}
		}
    }

	public function Dropdown($param = NULL){
		$this->get();
		if(isset($this->data) && is_array($this->data)){
			$temp = NULL;
			$temp[0] = (isset($param['text']) && !empty($param['text']))?$param['text']:'[Root]';
			foreach($this->data as $key => $val){
				$temp[$val->id] = str_repeat('|-----', (($val->level > 0)?($val->level - 1):0)).$val->name;
			}
			return $temp;
		}
	}
	/**
	 * Summary of hierarchyWithCheckbox
	 * Customize 23/05/2025
	 */
	public function hierarchyWithCheckbox(){
		$this->get();
		if(isset($this->data) && is_array($this->data)){
			$html = '<div class="hierarchy-with-checkbox data-box-generate">';
			foreach($this->data as $key => $val){
				$html .= '<div class="hierarchy-item">';
				$html .= '<div class="i-checks"><label>';
				$html .= str_repeat('<span class="indent"></span>', (($val->level > 0)?($val->level - 1):0));
				$html .= '<input type="checkbox" name="promotion_product_cat[]" value="'.$val->id.'" /><span class="cat-name">'.$val->name.'</span>';
				$html .= '</label></div></div>';
			}
			$html .= '</div>';
			return $html;
		}
	}
	//xử lý thêm nếu template sử dụng nestable
	public function getNestable($id = 0, $route = 'logout'){
		$this->get();
		$nestable = '';
        $level=0;
		if(isset($this->data) && is_array($this->data) && count($this->data)){
			foreach($this->data as $k => $pc){
				$class = '';
				if($id > 0 && $id == $pc->id){
					$class = 'dd-focus';
				}
				if($pc->level > $level){
					$nestable .= '<ol class="dd-list">';
				}elseif($pc->level < $level){
				$nestable .= str_repeat('</ol></li>', $level - $pc->level);
				}
				$nestable .= '<li class="dd-item" data-id="'.$pc->id.'">';
				$nestable .= '<div class="dd-handle '.$class.'">';
				$nestable .= '<a href="'.route($route,["id"=>$pc->id]).'">'.$pc->name.'</a>';
				$nestable .= '</div>';
				if(($pc->rgt-$pc->lft)==1){
					$nestable .= '</li>';
				}
				$level=$pc->level;
			}
			$nestable .= str_repeat('</ol></li>', $level-1);
			$nestable .= '</ol>';
		}
        return $nestable;
	}
}