<?php
namespace App\Services;

use App\Services\BaseService;
use App\Services\Interfaces\SystemServiceInterface;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SystemService extends BaseService implements SystemServiceInterface
{
    protected $systemRepository;
    public function __construct(SystemRepository $systemRepository){
        parent::__construct($systemRepository);
        $this->systemRepository = $systemRepository;
    }
    public function getConfig(){
        $config = $this->systemRepository->getConfig();
        $data = [];
        foreach ($config as $key => $item) {
            $data[$item->keyword] = $item->content;
        }
        return $data;
    }
    public function save($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send']);
            $payloadData = [];
            foreach ($payload as $key => $value) {
                $payloadData[] = [
                    'keyword' => $key,
                    'content' => $value,
                    'language_id' => $this->languageCurent->id,
                ];
            }
            // dd($payloadData);
            $flag = $this->systemRepository->upsertData($payloadData, ['keyword'], ['content', 'language_id']);
            // dd($flag);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    
}