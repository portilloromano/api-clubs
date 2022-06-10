<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class EntityProvider extends ServiceProvider
{

    protected bool $defer = false;

    public function boot(): void
    {
    }

    public function register()
    {
        $this->app->bind(
            'Api\ClubsAdmin\Domain\Repository\EntityRepository',
            'Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Entity\EntityEloquentRepository'
        );
    }

    public function provides(): array
    {
        return [
            'Api\ClubsAdmin\Domain\Repository\EntityRepository',
        ];
    }

}
