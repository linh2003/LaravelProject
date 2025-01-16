<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface LanguageServiceInterface{
    public function create(Request $request);
    public function switchLanguage($id);
}