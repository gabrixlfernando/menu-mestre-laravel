<?php

namespace App\Providers;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use \App\Models\Contato;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'funcionario' => 'App\Models\Funcionario',
        ]);

        // Compartilhe a variável com todas as views usando a função view()->share()
        view()->share('naoLidas', Contato::where('lidoContato', false)->count());
    }
}
