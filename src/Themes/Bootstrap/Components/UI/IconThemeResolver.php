<?php

namespace W4\UiFramework\Themes\Bootstrap\Components\UI;

use W4\UiFramework\Contracts\ComponentThemeResolverInterface;
use W4\UiFramework\Support\ClassBag;

class IconThemeResolver implements ComponentThemeResolverInterface
{
    public function classes(array $context = []): array
    {
        $variant = $context['variant'] ?? 'neutral';
        $size = $context['size'] ?? 'md';
        $state = $context['state'] ?? 'enabled';
        $spin = (bool) ($context['spin'] ?? false);

        $root = ClassBag::make(['d-inline-block', 'align-middle', 'lh-1']);

        $root->add(match ($variant) {
            'primary' => 'text-primary',
            'secondary' => 'text-secondary',
            'success' => 'text-success',
            'warning' => 'text-warning',
            'danger', 'error' => 'text-danger',
            'info' => 'text-info',
            'light' => 'text-light',
            'dark' => 'text-dark',
            default => 'text-body',
        });

        $root->add(match ($size) {
            'xs' => 'fs-6',
            'sm' => 'fs-5',
            'md' => 'fs-4',
            'lg' => 'fs-3',
            'xl' => 'fs-2',
            default => 'fs-4',
        });

        if ($spin) {
            $root->add('fa-spin');
        }

        if ($state === 'disabled') {
            $root->add('opacity-50');
        }

        if ($state === 'active') {
            $root->add('text-decoration-underline');
        }

        if ($state === 'hidden') {
            $root->add('d-none');
        }

        if (! empty($context['attributes']['class'])) {
            $root->merge((string) $context['attributes']['class']);
        }

        return [
            'root' => $root->toString(),
        ];
    }

    public function attributes(array $context = []): array
    {
        $state = $context['state'] ?? 'enabled';
        $decorative = (bool) ($context['decorative'] ?? false);
        $label = (string) ($context['label'] ?? '');
        $userAttributes = $context['attributes'] ?? [];

        return array_merge($userAttributes, [
            'role' => $userAttributes['role'] ?? 'img',
            'aria-hidden' => $decorative || $state === 'hidden' ? 'true' : 'false',
            'aria-label' => $decorative ? null : ($userAttributes['aria-label'] ?? ($label !== '' ? $label : null)),
            'data-state' => $state,
            'data-spin' => (bool) ($context['spin'] ?? false) ? 'true' : 'false',
        ]);
    }
}
