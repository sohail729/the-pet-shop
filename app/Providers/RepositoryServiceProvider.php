<?php

namespace App\Providers;

use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BrandRepositoryInterface::class => BrandRepository::class,
        UserRepositoryInterface::class =>  UserRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
