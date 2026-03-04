<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Module\Vocabulary\VocabularyStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\VocabularyServiceInterface as VocabularyService;
use App\Repositories\Interfaces\VocabularyRepositoryInterface as VocabularyRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class VocabularyController extends BackendController
{
    protected $vocabularyService;
    protected $vocabularyRepository;
    protected $languageRepository;
    public function __construct(VocabularyService $vocabularyService, VocabularyRepository $vocabularyRepository, LanguageRepository $languageRepository){
        parent::__construct();
        $this->vocabularyService = $vocabularyService;
        $this->vocabularyRepository = $vocabularyRepository;
        $this->languageRepository = $languageRepository;
    }
    public function store(VocabularyStoreRequest $request){
        if ($this->vocabularyService->create($request)) {
            return redirect()->route('vocabulary.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('vocabulary.view')->with('error', __('general.message.create.error'));
    }
    public function create(){
        $template = 'main.module.vocabulary.store';
        $method = 'create';
        $config = $this->config();
            
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
            ]
        );
    }
    public function index(){
        $template = 'main.module.vocabulary.index';
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['css'][] = $this->asset.'/js/libraries/bootstrap-growl.min.js';
        $config['css'][] = $this->asset.'/css/plugins/nestable/nestable.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/plugins/nestable/jquery.nestable.js';
        $config['script'][] = $this->asset.'/js/setupNestable.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $config['script'][] = $this->asset.'/js/quickAdd.js';
        $config['script'][] = $this->asset.'/js/sortObject.js';
        $vocabularies = $this->vocabularyService->getVocabulary();
        // dd($vocabularies);
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'vocabularies' => $vocabularies,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
            ],
            'script' => [
                $this->asset.'/js/autoMachineName.js',
            ]
        ];
    }
}
