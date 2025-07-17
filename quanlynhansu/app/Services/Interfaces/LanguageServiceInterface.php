<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface LanguageServiceInterface
{
    public function getLanguages(Request $request);
    public function create(Request $request);
}