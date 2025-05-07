<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    protected $namespace = 'App\\Http\\Controllers';

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')  // Prefixo "api" para as rotas
            ->middleware('api')  // Middleware para rotas da API
            ->namespace($this->namespace)  // Namespace correto
            ->group(base_path('routes/api.php'));  // Carrega o arquivo correto
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
