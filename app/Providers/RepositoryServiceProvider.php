<?php

namespace App\Providers;

use App\Repositories\Eloquent;

use App\Repositories\Interfaces\CategoryInterface;
use App\Repositories\Interfaces\FileInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        CategoryInterface::class => Eloquent\CategoryRepository::class,
        FileInterface::class => Eloquent\FileEloquentRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}