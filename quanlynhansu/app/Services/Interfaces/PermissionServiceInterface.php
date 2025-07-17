<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PermissionServiceInterface
{
    public function update($id, Request $request);
    public function create(Request $request);
}