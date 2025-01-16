<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface UserRoleServiceInterface{
    public function getRoles($request, $counte=false);
    public function create(Request $request);
    public function update($id,Request $req);
}