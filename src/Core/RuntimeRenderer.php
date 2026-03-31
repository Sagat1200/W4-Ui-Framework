<?php

namespace W4\UiFramework\Core;

use InvalidArgumentException;
use W4\UiFramework\Contracts\ComponentInterface;

class RuntimeRenderer
{
    public function __construct(
        protected ThemeResolverPipeline $themeResolverPipeline,
        protected RendererPipeline $rendererPipeline
    ) {}

    public function render(ComponentInterface $component, ?string $renderer = null): mixed
    {
        $resolved = $this->themeResolverPipeline->resolve($component);

        return $this->rendererPipeline->render(
            component: $component,
            resolvedTheme: $resolved,
            renderer: $renderer
        );
    }

    public function renderMany(iterable $components, ?string $renderer = null): array
    {
        $output = [];

        foreach ($components as $component) {
            if (! $component instanceof ComponentInterface) {
                throw new InvalidArgumentException('All items passed to renderMany() must implement ComponentInterface.');
            }

            $output[] = $this->render($component, $renderer);
        }

        return $output;
    }
}