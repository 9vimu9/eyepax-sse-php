<?php

namespace App\Providers;

use App\Models\Member;
use App\Repositories\member\MemberRepositoryInterface;
use App\Repositories\member\MySqlMemberRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MemberRepositoryInterface::class, function (Application $app) {
            return $app->make(MySqlMemberRepository::class,['builder'=>(new Member())->newQuery()]);
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
