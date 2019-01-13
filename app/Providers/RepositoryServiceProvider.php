<?php
/**
 * Created by PhpStorm.
 * User: shehbaz
 * Date: 1/12/19
 * Time: 11:32 PM
 */

namespace App\Providers;


use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\RackRepository;
use App\Repositories\RackRepositoryInterface;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(RackRepositoryInterface::class, RackRepository::class);
    }
}
