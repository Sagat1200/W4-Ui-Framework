<?php

namespace W4\UiFramework\Contracts;

use W4\UiFramework\Contracts\ComponentThemeResolverInterface;

interface ThemeInterface
{
    public function name(): string;

    public function resolverFor(string $component): ?ComponentThemeResolverInterface;
}