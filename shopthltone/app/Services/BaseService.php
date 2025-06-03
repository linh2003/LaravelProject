<?php
namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaseService implements BaseServiceInterface
{
    protected $languageCurent;
    protected $routerRepository;
    protected $controllerPrefix;
    public function __construct($routerRepository){
        $this->languageCurent = DB::table('languages')->select('id')->where('active', '=', 1)->first();
        $this->routerRepository = $routerRepository;
        $this->controllerPrefix = 'App\Http\Controllers\Frontend\\';
    }
    public function deleteMultipleRouter($moduleIds, $controllerName){
        $condition = [
            'wherein' => ['module_id' => $moduleIds],
            'where' => [
                ['controller', '=', $this->controllerPrefix.$controllerName],
                ['language_id', '=', $this->languageCurent->id],
            ]
        ];
        return $this->routerRepository->deleteCondition($condition);
    }
    public function deleteRouter($moduleId, $controllerName){
        $condition = [];
        $condition['where'] = [
            ['module_id', '=', $moduleId],
            ['controller', '=', $this->controllerPrefix.$controllerName],
            ['language_id', '=', $this->languageCurent->id],
        ];
        return $this->routerRepository->deleteCondition($condition);
    }
    public function updateRouter($request, $moduleId, $controllerName){
        $payload = $request->only('canonical');
        $payloadRouter = [
            'canonical' => Str::slug($payload['canonical'])
        ];
        // dd($payload);
        $condition = [
            ['module_id', '=', $moduleId],
            ['controller', '=', $this->controllerPrefix.$controllerName],
            ['language_id', '=', $this->languageCurent->id],
        ];
        return $this->routerRepository->updateByCondition($condition, $payloadRouter);
    }
    public function createRouter($request, $moduleId, $controllerName){
        $payload = $this->formatRouter($request, $moduleId, $controllerName, $this->languageCurent->id);
        // dd($payload);
        return $this->routerRepository->create($payload);
    }
    public function formatAlbum($payload){
        return (isset($payload['album']) && count($payload['album'])) ? json_encode($payload['album']) : '';
    }
    public function formatRouter($request, $moduleId, $controllerName, $languageId)
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
