<?php

namespace W4\UiFramework\Contracts;

use W4\UiFramework\Contracts\ComponentInterface;

interface RendererInterface
{
    public function render(ComponentInterface $component, array $resolvedTheme = []): mixed;
}