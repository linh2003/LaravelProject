<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\Constant;

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
	public function getData() {
		return $this->data;
	}

	public function Get(){
		$catalogue = (isset($this->params['isMenu']) && $this->params['isMenu'] == true ) ? '' : '_catalogue'; //catalogue='_catalogue'
		$foreignkey = (isset($this->params['foreignkey'])) ? $this->params['foreignkey'] : 'post_catalogue_id';
		$moduleExtract = explode('_', $this->params['table']); //product
		$join = (isset($this->params['isMenu']) && $this->params['isMenu'] == true ) ? substr($moduleExtract[0], 0, -1) : $moduleExtract[0]; // product
		$result = DB::table($this->params['table'].' as tb1')
		->select('tb1.id','tb2.name','tb2.canonical','tb1.parent_id','tb1.icon','tb1.lft','tb1.rgt','tb1.level','tb1.order')
		->join($join.$catalogue.'_language as tb2', 'tb1.id', '=', 'tb2.'.$foreignkey.'')
		->where('tb2.language_id','=', $this->params['language_id'])->whereNull('tb1.deleted_at')
		->orderBy('tb1.lft','asc')->get()->toArray();
		$this->data = $result;
	}

	public function Set(){
		if(isset($this->data) && is_array($this->data)){
			$arr = NULL;
			foreach($this->data as $key => $val){
				$arr[$val->id][$val->parent_id] = 1;
				$arr[$val->parent_id][$val->id] = 1;
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
					'menu_catalogue_id' => Constant::MAIN_MENU,
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
	/**
	 * Summary of setupMainNav
	 * Customize 16/07/2025
	 * Display main navigation horizontal of AdminDek template
	 */
	public function setupMainNav($user, $roleUser, $menuWithRole){
		$this->get();
		$mainNav = '';
        $level = 0;
		if(isset($this->data) && is_array($this->data) && count($this->data)){
			foreach($this->data as $k => $pc){
				$class = '';
				$check = array_intersect($roleUser, $menuWithRole[$pc->id]);
				if($pc->level > $level){
					if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
						if ($pc->level == 1) {
							$mainNav .= '<ul class="pcoded-item">';
						}else{
							$mainNav .= '<ul class="pcoded-submenu">';
						}
					}
				}elseif($pc->level < $level){
					if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
						$mainNav .= str_repeat('</ul></li>', $level - $pc->level);
					}
				}
				if(($pc->rgt - $pc->lft) > 1){
					if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
						$mainNav .= '<li class="pcoded-hasmenu is-hover" subitem-icon="style1" dropdown-icon="style1">';
						$mainNav .= '<a href="javascript:void(0)" class="waves-effect waves-dark">';
						if ($pc->level == 1) {
							$mainNav .= '<span class="pcoded-micon"><i class="feather '.$pc->icon.'"></i></span>';
						}
					}
				}else{
					if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
						$mainNav .= '<li class="">';
						$route = '';
						if (!empty($pc->canonical)) {
							$route = route($pc->canonical);
						}
						$mainNav .= '<a href="'.$route.'" class="waves-effect waves-dark">';
					}
				}
				if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
					$mainNav .= '<span class="pcoded-mtext">'.$pc->name.'</span></a>';
				}
				if(($pc->rgt - $pc->lft) == 1){
					if(count($check) > 0 || ($user->id == Constant::SUPERADMIN)){
						$mainNav .= '</li>';
					}
				}
				$level = $pc->level;
			}
			if(!empty($mainNav)){
				$mainNav .= str_repeat('</ul></li>', $level-1);
				$mainNav .= '</ul>';
			}
		}
		return $mainNav;
	}
	/**
	 * Summary of getNestable
	 * Customize 16/07/2025
	 * Use for template manage menu with nestable
	 */
	public function getNestable(){
		$this->get();
		$nestable = '';
        $level=0;
		if(isset($this->data) && is_array($this->data) && count($this->data)){
			foreach($this->data as $k => $pc){
				$class = '';
				if($pc->level > $level){
					$nestable .= '<ol class="dd-list">';
				}elseif($pc->level < $level){
					$nestable .= str_repeat('</ol></li>', $level - $pc->level);
				}
				$nestable .= '<li class="dd-item" data-id="'.$pc->id.'">';
				$nestable .= '<div class="dd-handle dd-handle-'.$pc->id.'">'.$pc->name.'</div>
				<div class="menu-item-action"><a class="edit-menu-item" data-target="#menu-item-'.$pc->id.'" data-toggle="modal"><i class="feather icon-edit-2"></i></a><a class="edit-menu-item remove-menu-item" data-target="#remove-menu-item" data-toggle="modal" data-id="'.$pc->id.'"><i class="feather icon-trash-2"></i></a></div>';
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