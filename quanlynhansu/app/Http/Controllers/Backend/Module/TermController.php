<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\TermServiceInterface as TermService;
use App\Repositories\Interfaces\TermRepositoryInterface as TermRepository;
use App\Services\Interfaces\VocabularyServiceInterface as VocabularyService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class TermController extends BackendController
{
    protected $termService;
    protected $termRepository;
    protected $languageRepository;
    protected $vocService;
    public function __construct(TermService $termService, TermRepository $termRepository, LanguageRepository $languageRepository, VocabularyService $vocService){
        parent::__construct();
        $this->termService = $termService;
        $this->termRepository = $termRepository;
        $this->languageRepository = $languageRepository;
        $this->vocService = $vocService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $template = 'main.module.term.index';
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $terms = $this->termService->getTerm();
        // dd($terms);
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'terms' => $terms,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $template = 'main.module.term.store';
		$config = $this->config();
		$method = 'create';
		$vocs = $this->vocService->getVocabularies();
		return view(
            'main.layout',
            [
                'template' => $template,
				'method' => $method,
                'config' => $config,
                'vocs' => $vocs,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($this->termService->create($request)) {
            return redirect()->route('term.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('term.view')->with('error', __('general.message.create.error'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $template = 'main.module.term.store';
		$config = $this->config();
		$method = 'update';
		$vocs = $this->vocService->getVocabularies();
		$term = $this->termService->getTermById($id);
		return view(
            'main.layout',
            [
                'template' => $template,
				'method' => $method,
                'config' => $config,
                'vocs' => $vocs,
                'term' => $term,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function config(){
        return [
            'css' => [
				'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/switchery/switchery.min.css',
            ],
            'script' => [
                $this->asset.'/js/autoMachineName.js',
				'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/setupSelect2.js',
                $this->asset.'/js/plugins/switchery/switchery.min.js',
				$this->asset.'/js/setupSwitchery.js',
				$this->asset.'/js/switchStatus.js',
				$this->asset.'/js/module/module/term.js',
            ]
        ];
    }
}
