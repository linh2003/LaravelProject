<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface VocabularyServiceInterface
{
    public function update($id, Request $request);
    public function create(Request $request);
}