<?php
namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function deleteMultipleRouter($moduleIds, $controllerName);
    public function deleteRouter($moduleId, $controllerName);
    public function updateRouter($request, $moduleId, $controllerName);
    public function createRouter($request, $moduleId, $controllerName);
}