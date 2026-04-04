<?php

namespace W4\UiFramework\Themes\Bootstrap\Components\UI;

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

        $root = ClassBag::make(['w-100', 'd-flex', 'align-items-center', 'text-muted']);
        $label = ClassBag::make(['px-2', 'small']);

        if ($orientation === 'vertical') {
            $root->remove('w-100')
                ->add('h-100')
                ->add('border-start');
        } else {
            $root->add('border-top');
        }

        $root->add(match ($variant) {
            'primary' => 'border-primary',
            'secondary' => 'border-secondary',
            'success' => 'border-success',
            'warning' => 'border-warning',
            'danger', 'error' => 'border-danger',
            'info' => 'border-info',
            'light' => 'border-light',
            'dark', 'neutral' => 'border-dark',
            default => 'border-secondary',
        });

        $root->add(match ($size) {
            'xs' => 'border-1',
            'sm' => 'border-1',
            'md' => 'border-2',
            'lg' => 'border-3',
            'xl' => 'border-4',
            default => 'border-2',
        });

        if ($state === 'disabled') {
            $root->add('opacity-50');
        }

        if ($state === 'active') {
            $root->add('border-opacity-100');
        }

        if ($state === 'hidden') {
            $root->add('d-none');
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
