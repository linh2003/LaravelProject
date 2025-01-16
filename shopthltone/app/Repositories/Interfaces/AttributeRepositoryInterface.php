<?php
namespace App\Repositories\Interfaces;

interface AttributeRepositoryInterface
{
    public function getAttributeById(int $id=0, int $language_id=0);
    public function searchAttributes(string $keyword='', array $option=[], int $languageId);

    public function findAttributeByIdArrray($attributeArr, $languageId);
    
}