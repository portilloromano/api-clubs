<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class ClubProvider extends ServiceProvider
{

    protected bool $defer = false;

    public function boot(): void
    {
    }

    public function register()
    {
        $this->app->bind(
            'Api\ClubsAdmin\Domain\Repository\ClubRepository',
            'Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Club\ClubEloquentRepository'
        );
    }

    public function provides(): array
    {
        return [
            'Api\ClubsAdmin\Domain\Repository\ClubRepository',
        ];
    }

}
