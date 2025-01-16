<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LanguageComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\Interfaces\LanguageRepositoryInterface', 'App\Repositories\LanguageRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('backend.component.nav',function($view){
            $languageRepository = $this->app->make(LanguageRepository::class);
            $languages = $languageRepository->getAll();
            $view->with('languages',$languages);
        });
    }
}
