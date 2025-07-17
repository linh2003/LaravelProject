<?php
namespace App\Services;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Enums\Constant;

class BaseService implements BaseServiceInterface
{
    protected $language;
    public function __construct(){
        $this->language = DB::table('languages')->where(
            'id',
            '=', config('apps.general.publish')
        )->first()->id;
    }
    public function changeStatus($payload){
        $model = $payload['model'];
        $id = $payload['id'];
        $field = $payload['field'];
        $value = $payload['value'] == Constant::PUBLISH ? Constant::UNPUBLISH : Constant::PUBLISH;
        $repo = 'App\Repositories\\'.ucfirst($model).'Repository';
        // dd($repo);
        if (class_exists($repo)) {
            $repoInstance = app($repo);
            $repoInstance->update($id, [$field => $value]);
        }
    }
    public function changeStatusAll($payload){
        $model = $payload['model'];
        $ids = $payload['ids'];
        $field = $payload['field'];
        $value = $payload['value'];
        $repo = 'App\Repositories\\'.ucfirst($model).'Repository';
        if (class_exists($repo)) {
            $repoInstance = app($repo);
            $repoInstance->updateWhereIn('id', $ids, [$field => $value]);
        }
        return true;
    }
}
