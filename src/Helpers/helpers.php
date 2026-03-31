<?php

use W4\UiFramework\Contracts\ComponentInterface;
use W4\UiFramework\Support\W4UiManager;

if (! function_exists('w4_render')) {
    function w4_render(ComponentInterface $component, ?string $renderer = null): string
    {
        return app(W4UiManager::class)->render($component, $renderer);
    }
}

if (! function_exists('w4_view')) {
    function w4_view(ComponentInterface $component, ?string $renderer = null)
    {
        return app(W4UiManager::class)->view($component, $renderer);
    }
}

if (! function_exists('w4_payload')) {
    function w4_payload(ComponentInterface $component, ?string $renderer = null): mixed
    {
        return app(W4UiManager::class)->payload($component, $renderer);
    }
}
