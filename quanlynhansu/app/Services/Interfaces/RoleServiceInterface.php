<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface RoleServiceInterface
{
    public function update($id, Request $request);
    public function create(Request $request);
}