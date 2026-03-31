<?php

namespace W4\UiFramework\Contracts;

interface ComponentThemeResolverInterface
{
    public function classes(array $context = []): array;

    public function attributes(array $context = []): array;
}