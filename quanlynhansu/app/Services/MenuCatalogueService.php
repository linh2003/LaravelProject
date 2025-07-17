<?php
namespace App\Services;

use App\Services\Interfaces\MenuCatalogueServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use Illuminate\Support\Str;

class MenuCatalogueService implements MenuCatalogueServiceInterface
{
    protected $menuCatRepository;
    public function __construct(MenuCatalogueRepository $menuCatRepository)
    {
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->menuCatRepository = $menuCatRepository;
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['keyword'] = Str::slug($payload['keyword']);
            $menuCat = $this->menuCatRepository->create($payload);
            DB::commit();
            return [
                'flag' => true,
                'id' => $menuCat->id,
                'title' => $menuCat->name
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
        
    }
    private function payload(){
        return [
            'name',
            'keyword'
        ];
    }
    
}
