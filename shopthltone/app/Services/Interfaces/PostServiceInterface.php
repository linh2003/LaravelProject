<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PostServiceInterface{
    public function getPostsPagination(Request $request,$pagination=true);
    public function create(Request $request);
    public function update($id,Request $req);
    public function destroy($id);
}