<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface LanguageServiceInterface{
    public function getAllUser();
    public function switchLanguage($id);
    public function getLanguagePagination(Request $request,$pagination=true);
    public function create(Request $request);
    public function update($id,Request $req);
    public function destroy($id);
}