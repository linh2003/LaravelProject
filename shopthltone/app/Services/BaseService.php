<?php
namespace App\Services;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Str;

class BaseService implements BaseServiceInterface
{
    protected $controllerName;
    protected $routerRepository;
    public function __construct(RouterRepository $routerRepository){
        $this->routerRepository = $routerRepository;
    }

    public function currentLanguage()
    {
        $lang = DB::table('languages')->where('active','=',1)->value('id');
        return $lang;
    }
    public function formatAlbum($payload)
    {
        return (isset($payload['album']) && !empty($payload['album'])) ? json_encode($payload['album']) : '';
    }
    public function formatJson($payload, $inputName)
    {
        return (isset($payload[$inputName]) && !empty($payload[$inputName])) ? json_encode($payload[$inputName]) : '';
    }
    
    public function createRouter($moduleId, $request, $controllerName, $languageId)
    {
        $router = $this->formatRouter($moduleId,$request,$controllerName, $languageId);
        // dd($router);
        $this->routerRepository->create($router);
    }
    public function updateRouter($moduleId, $request, $controllerName, $languageId)
    {
        $router = $this->formatRouter($moduleId,$request,$controllerName, $languageId);
        $condition = [
            ['module_id','=',$moduleId],
            ['controller','=',$controllerName],
        ];
        $this->routerRepository->updateByWhere($condition,$router);
    }
    public function formatRouter($moduleId,$request,$controllerName, $languageId)
    {
        $router = [
            'canonical'     => Str::slug($request->input('canonical')),
            'module_id'     => $moduleId,
            'language_id'   => $languageId,
            'controller'    => 'App\Http\Controllers\Frontend\\'.$controllerName.'',
        ];
        return $router;
    }
}