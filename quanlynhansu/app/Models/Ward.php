<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
}
