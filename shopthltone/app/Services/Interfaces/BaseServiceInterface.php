<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface BaseServiceInterface{
    public function createRouter($moduleId, $request, $controllerName, $languageId);
    public function updateRouter($moduleId, $request, $controllerName, $languageId);
    public function formatRouter($moduleId,$request,$controllerName, $languageId);
    public function formatAlbum($payload);
    public function formatJson($request, $inputName);
    public function currentLanguage();
}