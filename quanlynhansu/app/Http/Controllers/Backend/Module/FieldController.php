<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use App\Services\Interfaces\FieldServiceInterface as FieldService;

class FieldController extends BackendController
{
    protected $fieldService;
    public function __construct(FieldService $fieldService){
        $this->fieldService = $fieldService;
    }
    public function store(Request $request){
        if ($this->fieldService->create($request)) {
            return redirect()->route('module.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('module.view')->with('error', __('general.message.create.error'));
    }
}
