<?php
namespace App\Services;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseService implements BaseServiceInterface
{
    
    public function __construct(){
        
    }

    public function currentLanguage()
    {
        return 1;
    }
}