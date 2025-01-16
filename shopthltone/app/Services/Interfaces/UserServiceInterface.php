<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface UserServiceInterface{
    public function getUsers($request,$pagination=true);
    public function create(Request $request);
    public function update($id,Request $req);
    public function changeStatus($post=[]);
    public function changeStatusAll($post=[]);
    public function applyRole(Request $req);
}