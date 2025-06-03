<?php
namespace App\Services\Interfaces;

interface LanguageServiceInterface
{
    public function switchLanguage($id);
    public function create($request);
    public function getData($request, $counter = false);
}