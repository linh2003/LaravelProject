<?php
namespace App\Repositories\Interfaces;

interface AttributeTypeRepositoryInterface
{
    public function getAttributeType($id = '', $languageId);
}