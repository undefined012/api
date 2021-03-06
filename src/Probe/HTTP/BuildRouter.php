<?php

declare(strict_types=1);

namespace PostAJob\API\Probe\HTTP;

use Moon\Moon\Router;
use PostAJob\API\Probe\HTTP\Middleware\HandleRequest\Liveness;
use PostAJob\API\Probe\HTTP\Middleware\HandleRequest\Readiness;

final class BuildRouter
{
    private const PREFIX = '/';

    public function __invoke(): Router
    {
        $router = new Router(self::PREFIX);
        $router->get('[liveness][/]', Liveness::class);
        $router->get('readiness[/]', Readiness::class);

        return $router;
    }
}
