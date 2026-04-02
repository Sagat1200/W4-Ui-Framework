<?php

namespace W4\UiFramework\Renderers;

use W4\UiFramework\Contracts\ComponentInterface;
use W4\UiFramework\Core\AbstractRenderer;

class BladeRenderer extends AbstractRenderer
{
    public function render(ComponentInterface $component, array $resolvedTheme = []): array
    {
        $componentName = $component->componentName();
        $componentNamespaces = [
            'button' => 'ui',
            'input' => 'forms',
        ];

        $primaryView = isset($componentNamespaces[$componentName])
            ? 'w4-ui::components.' . $componentNamespaces[$componentName] . '.' . $componentName
            : 'w4-ui::components.ui.' . $componentName;

        $view = view()->exists($primaryView)
            ? $primaryView
            : collect([
                'w4-ui::components.ui.' . $componentName,
                'w4-ui::components.forms.' . $componentName,
                'w4-ui::components.' . $componentName,
            ])->first(fn(string $candidate) => view()->exists($candidate))
            ?? $primaryView;

        return [
            'renderer' => 'blade',
            'view' => $view,
            'component' => $componentName,
            'data' => $component->toArray(),
            'theme' => $resolvedTheme,
        ];
    }
}