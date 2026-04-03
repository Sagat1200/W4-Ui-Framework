<?php

namespace W4\UiFramework\Themes\Tailwind\Components\UI;

use W4\UiFramework\Contracts\ComponentThemeResolverInterface;
use W4\UiFramework\Support\ClassBag;

class ButtonThemeResolver implements ComponentThemeResolverInterface
{
    public function classes(array $context = []): array
    {
        $variant = $context['variant'] ?? 'primary';
        $size = $context['size'] ?? 'md';
        $state = $context['state'] ?? 'enabled';

        $classes = ClassBag::make([
            'inline-flex',
            'items-center',
            'justify-center',
            'rounded-md',
            'font-medium',
            'transition-colors',
            'focus:outline-none',
            'focus:ring-2',
            'focus:ring-offset-2',
            'disabled:opacity-50',
            'disabled:pointer-events-none',
        ]);

        $classes->add(match ($variant) {
            'neutral' => 'bg-slate-700 text-white hover:bg-slate-800 focus:ring-slate-500',
            'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
            'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-200 focus:ring-slate-400',
            'accent' => 'bg-violet-600 text-white hover:bg-violet-700 focus:ring-violet-500',
            'info' => 'bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500',
            'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500',
            'warning' => 'bg-amber-500 text-slate-900 hover:bg-amber-600 focus:ring-amber-500',
            'error' => 'bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-500',
            default => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        });

        $sizeClasses = [
            'xs' => 'px-2 py-1 text-xs',
            'sm' => 'px-3 py-1.5 text-sm',
            'md' => 'px-4 py-2 text-sm',
            'lg' => 'px-5 py-2.5 text-base',
            'xl' => 'px-6 py-3 text-lg',
        ];

        $classes->add($sizeClasses[$size] ?? $sizeClasses['md']);

        if ($state === 'loading') {
            $classes->add('opacity-75 cursor-wait');
        }

        if ($state === 'active') {
            $classes->add('ring-2 ring-offset-2');
        }

        if (! empty($context['attributes']['class'])) {
            $userClasses = (string) $context['attributes']['class'];

            if (preg_match('/(?:^|\s)!?(?:[a-z0-9-]+:)*(?:h|min-h|max-h)-(?:\S+)/i', $userClasses) === 1) {
                foreach ($sizeClasses as $mappedClasses) {
                    foreach (preg_split('/\s+/', $mappedClasses) ?: [] as $class) {
                        $classes->remove($class);
                    }
                }
            }

            $classes->merge($userClasses);
        }

        return [
            'root' => $classes->toString(),
        ];
    }

    public function attributes(array $context = []): array
    {
        $state = $context['state'] ?? 'enabled';
        $userAttributes = $context['attributes'] ?? [];

        return array_merge($userAttributes, [
            'type' => $userAttributes['type'] ?? 'button',
            'disabled' => in_array($state, ['disabled', 'loading', 'readonly'], true),
            'aria-disabled' => in_array($state, ['disabled', 'loading', 'readonly'], true) ? 'true' : 'false',
            'aria-pressed' => $state === 'active' ? 'true' : 'false',
        ]);
    }
}