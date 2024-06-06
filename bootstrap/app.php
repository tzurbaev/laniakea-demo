<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Validation\ValidationException;
use Laniakea\Exceptions\BaseHttpException;
use Laniakea\Exceptions\ExceptionRenderer;
use Laniakea\MiddlewarePriority\MiddlewarePriorityManager;
use Laniakea\Resources\Middleware\SetResourceRequest;
use Laniakea\Versions\Middleware\SetApiVersion;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register aliases for Laniakea middleware.
        $middleware->alias([
            'laniakea.request' => SetResourceRequest::class,
            'laniakea.version' => SetApiVersion::class,
        ]);

        // Create fresh middleware priority manager with default middleware priority.
        $manager = MiddlewarePriorityManager::withDefaults($middleware);

        // Place SetApiVersion middleware before SubstituteBindings middleware.
        $manager->before(SubstituteBindings::class, SetApiVersion::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /** @var ExceptionRenderer $renderer */
        $renderer = app(ExceptionRenderer::class);

        // Disable reporting for all Lanikea exceptions.
        $exceptions->dontReport(BaseHttpException::class);

        // Allow Laniakea's ExceptionRenderer render base exceptions
        $exceptions->renderable(fn (BaseHttpException $e, Request $request) => $renderer->render($e, $request));

        // Optionally: render Laravel's ValidationException with Laniakea's renderer.
        $exceptions->renderable(fn (ValidationException $e, Request $request) => $renderer->renderValidationException($e, $request));
    })->create();
