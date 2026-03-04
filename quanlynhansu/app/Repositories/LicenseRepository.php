<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\LicenseRepositoryInterface;
use App\Models\License;

class LicenseRepository extends BaseRepository implements LicenseRepositoryInterface
{
	
	public function __construct(License $license)
	{
		$this->model = $license;
	}
}