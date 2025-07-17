<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function changeRole(Request $request);
    public function getUsers(Request $request);
    public function create(Request $request);
}