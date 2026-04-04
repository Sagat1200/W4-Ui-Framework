<?php

namespace W4\UiFramework\Themes\DaisyUI\Components\UI;

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

        $root = ClassBag::make(['inline-block', 'align-middle', 'leading-none']);

        $root->add(match ($variant) {
            'primary' => 'text-primary',
            'secondary' => 'text-secondary',
            'accent' => 'text-accent',
            'success' => 'text-success',
            'warning' => 'text-warning',
            'error' => 'text-error',
            'info' => 'text-info',
            default => 'text-base-content',
        });

        $root->add(match ($size) {
            'xs' => 'text-xs',
            'sm' => 'text-sm',
            'md' => 'text-base',
            'lg' => 'text-lg',
            'xl' => 'text-xl',
            default => 'text-base',
        });

        if ($spin) {
            $root->add('animate-spin');
        }

        if ($state === 'disabled') {
            $root->add('opacity-50');
        }

        if ($state === 'active') {
            $root->add('drop-shadow-sm');
        }

        if ($state === 'hidden') {
            $root->add('hidden');
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
