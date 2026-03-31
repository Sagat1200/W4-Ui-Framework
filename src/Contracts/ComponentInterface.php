<?php

namespace W4\UiFramework\Contracts;

interface ComponentInterface
{
    public function componentName(): string;

    public function toThemeContext(): array;

    public function toArray(): array;
}