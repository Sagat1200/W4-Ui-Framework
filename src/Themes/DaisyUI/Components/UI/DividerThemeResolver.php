<?php

namespace W4\UiFramework\Themes\DaisyUI\Components\UI;

use W4\UiFramework\Contracts\ComponentThemeResolverInterface;
use W4\UiFramework\Support\ClassBag;

class DividerThemeResolver implements ComponentThemeResolverInterface
{
    public function classes(array $context = []): array
    {
        $variant = $context['variant'] ?? 'neutral';
        $size = $context['size'] ?? 'md';
        $orientation = $context['orientation'] ?? 'horizontal';
        $state = $context['state'] ?? 'enabled';

        $root = ClassBag::make('divider');
        $label = ClassBag::make([]);

        if ($orientation === 'vertical') {
            $root->add('divider-horizontal');
        }

        $root->add(match ($variant) {
            'primary' => 'divider-primary',
            'secondary' => 'divider-secondary',
            'accent' => 'divider-accent',
            'success' => 'divider-success',
            'warning' => 'divider-warning',
            'error' => 'divider-error',
            'info' => 'divider-info',
            default => 'divider-neutral',
        });

        $label->add(match ($size) {
            'xs' => 'text-xs',
            'sm' => 'text-sm',
            'md' => 'text-base',
            'lg' => 'text-lg',
            'xl' => 'text-xl',
            default => 'text-base',
        });

        if ($state === 'disabled') {
            $root->add('opacity-50');
        }

        if ($state === 'active') {
            $root->add('font-semibold');
        }

        if ($state === 'hidden') {
            $root->add('hidden');
        }

        if (! empty($context['attributes']['class'])) {
            $root->merge((string) $context['attributes']['class']);
        }

        return [
            'root' => $root->toString(),
            'label' => $label->toString(),
        ];
    }

    public function attributes(array $context = []): array
    {
        $orientation = $context['orientation'] ?? 'horizontal';
        $state = $context['state'] ?? 'enabled';
        $userAttributes = $context['attributes'] ?? [];

        return array_merge($userAttributes, [
            'role' => $userAttributes['role'] ?? 'separator',
            'aria-orientation' => $userAttributes['aria-orientation'] ?? $orientation,
            'aria-hidden' => $state === 'hidden' ? 'true' : 'false',
            'data-state' => $state,
        ]);
    }
}
