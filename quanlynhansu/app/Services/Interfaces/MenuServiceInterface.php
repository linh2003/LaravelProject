<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface MenuServiceInterface
{
    public function create(Request $request);
    public function getHierarchy();
    public function setupMainNav($user, $roleUser);
    public function getNestedSetbie();
    public function getMenuRole();
}