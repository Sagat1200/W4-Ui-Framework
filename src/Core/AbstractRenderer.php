<?php

namespace W4\UiFramework\Core;

use W4\UiFramework\Contracts\ComponentInterface;
use W4\UiFramework\Contracts\RendererInterface;

abstract class AbstractRenderer implements RendererInterface
{
    abstract public function render(ComponentInterface $component, array $resolvedTheme = []): mixed;

    protected function basePayload(ComponentInterface $component, array $resolvedTheme = []): array
    {
        return [
            'component' => $component->componentName(),
            'data' => $component->toArray(),
            'theme' => $resolvedTheme,
        ];
    }
}