<?php

namespace W4\UiFramework\Themes\Tailwind;

use W4\UiFramework\Core\AbstractTheme;
use W4\UiFramework\Themes\Tailwind\Components\Forms\InputThemeResolver;
use W4\UiFramework\Themes\Tailwind\Components\UI\ButtonThemeResolver;

class TailwindTheme extends AbstractTheme
{
    public function __construct()
    {
        $this->registerResolver('button', new ButtonThemeResolver());
        $this->registerResolver('input', new InputThemeResolver());
    }

    public function name(): string
    {
        return 'tailwind';
    }
}