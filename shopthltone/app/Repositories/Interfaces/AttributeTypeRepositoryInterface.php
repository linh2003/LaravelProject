<?php
namespace App\Repositories\Interfaces;

interface AttributeTypeRepositoryInterface
{
    public function getAttributeTypeById(int $id=0, int $language_id=0);
    
}