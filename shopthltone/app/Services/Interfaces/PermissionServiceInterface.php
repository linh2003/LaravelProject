<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PermissionServiceInterface{
    public function getPermissions(Request $request, $count=false,$select=['*']);
    public function create(Request $request);
    public function setPermission(Request $request);
    public function update($id, Request $request);
}