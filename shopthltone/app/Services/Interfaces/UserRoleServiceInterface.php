<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface UserRoleServiceInterface{
    public function getRolePagination($request);
    public function create(Request $request);
    public function update($id,Request $req);
}