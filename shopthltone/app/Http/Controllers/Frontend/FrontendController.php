<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\System;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;

class FrontendController extends Controller
{
    protected $asset;
    protected $language;
    protected $system;
    public function __construct(){
        $this->asset = asset(''); /* sitename/public/ */
        $this->language = $this->setLanguage();
        // dd($this->language);
        $this->system = $this->configSystem();
    }
    public function setLanguage(){
        // $locale = app()->getLocale();
        // $lang = Language::where('canonical', '=', $locale);
        $lang = Language::where('active', '=', 1);
        return $lang->first()->id;
    }
    public function configSystem(){
        $system = System::select(['keyword', 'content'])->where(
            'language_id', '=', $this->language
        )->get();
        return convertArray($system, 'keyword', 'content');
    }
}
