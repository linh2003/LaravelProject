<?php
namespace App\Repositories;

use App\Models\MenuCatalogue;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface;

class MenuCatalogueRepository extends BaseRepository implements MenuCatalogueRepositoryInterface
{
    public function __construct(MenuCatalogue $menuCatalogue)
    {
        $this->model = $menuCatalogue;
    }
}
