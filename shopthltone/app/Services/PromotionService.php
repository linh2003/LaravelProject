<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Interfaces\PromotionServiceInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use Illuminate\Support\Facades\DB;
use App\Enums\Promotion;
use Illuminate\Support\Carbon;

class PromotionService implements PromotionServiceInterface
{
    protected $promotionRepository;
    public function __construct(PromotionRepository $promotionRepository){
        $this->promotionRepository = $promotionRepository;
    }
    public function remove($id){
        DB::beginTransaction();
        try {
            $this->promotionRepository->destroy($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            
            $payload['start'] = Carbon::createFromFormat('d/m/Y',$payload['start']);
            $payload['end'] = Carbon::createFromFormat('d/m/Y',$payload['end']);
            // dd($payload);
            switch ($payload['type']) {
                case Promotion::PROMOTION_VALUE_PRODUCT:
                    $payload['discount'] = $this->promotionValueProduct($request);
                    $this->promotionRepository->update($id, $payload);
                    break;
                case Promotion::PROMOTION_PRODUCT:
                    $payloadData = $this->promotionProduct($request);
                    $payload['discount'] = $payloadData;
                    $payload['discount_type'] = $payloadData['discount'];
                    $payload['discount_value'] = convertPrice($payloadData['discount_promotion_product']);
                    // dd($payload);
                    $promotion = $this->promotionRepository->update($id, $payload);
                    if ($promotion->id > 0) {
                        $payloadModule = [];
                        foreach ($payload['discount']['aplly_promotion_product']['id'] as $k => $val) {
                            $payloadModule[] = [
                                'module' => $payload['discount']['module'],
                                'module_id' =>$val
                            ];
                        }
                        // dd($payloadModule);
                        $this->promotionRepository->syncData($promotion, $payloadModule, 'products');
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
            // dd($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            
            $payload['start'] = Carbon::createFromFormat('d/m/Y',$payload['start']);
            $payload['end'] = Carbon::createFromFormat('d/m/Y',$payload['end']);
            // dd($payload);
            switch ($payload['type']) {
                case Promotion::PROMOTION_VALUE_PRODUCT:
                    $payload['discount'] = $this->promotionValueProduct($request);
                    $this->promotionRepository->create($payload);
                    break;
                case Promotion::PROMOTION_PRODUCT:
                    $payloadData = $this->promotionProduct($request);
                    $payload['discount'] = $payloadData;
                    $payload['discount_type'] = $payloadData['discount'];
                    $payload['discount_value'] = convertPrice($payloadData['discount_promotion_product']);
                    // dd($payload);
                    $promotion = $this->promotionRepository->create($payload);
                    if ($promotion->id > 0) {
                        $payloadModule = [];
                        foreach ($payload['discount']['aplly_promotion_product']['id'] as $k => $val) {
                            $payloadModule[] = [
                                'module' => $payload['discount']['module'],
                                'module_id' =>$val
                            ];
                        }
                        // dd($payloadModule);
                        $this->promotionRepository->syncData($promotion, $payloadModule, 'products');
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
            // dd($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function promotionValueProduct($request){
        $payload = $request->only('discount_promotion_value_product');
        return $payload['discount_promotion_value_product'];
    }
    private function promotionProduct($request){
        $payload = $request->only($this->payloadPromotionModule());
        // dd($payload);
        return $payload;
    }
    private function payloadPromotionModule(){
        return [
            'aplly_promotion_product', 
            'module',
            'discount_promotion_product',
            'discount'
        ];
    }
    private function payload(){
        return [
            'name',
            'code',
            'description',
            'type',
            'status',
            'start',
            'end'
        ];
    }
    public function getData($request, $counter = false){
        $select = $this->select();
        $condition['keyword'] = $request->except('search');
        return $this->promotionRepository->getData($select, $condition, $counter);
    }
    private function select(){
        return [
            'id',
            'name',
            'code',
            'description',
            'status',
            'start',
            'end',
        ];
    }
    public function changeStatusAll($request){
        $ids = $request['modelId'];
        $condition = [$request['field'] => $request['value']];
        return $this->promotionRepository->updateWhereIn('id', $ids, $condition);
    }
    public function changeStatus($request){
        DB::beginTransaction();
        try {
            $id = $request['modelId'];
            $field = $request['field'];
            $value = ($request['value'] == 1) ? config('apps.general.unpublish') : config('apps.general.publish');
            // dd($value);
            $condition = [$field => $value];
            $this->promotionRepository->update($id, $condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}