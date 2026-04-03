<?php

namespace W4\UiFramework\Themes\Tailwind\Components\Forms;

use W4\UiFramework\Contracts\ComponentThemeResolverInterface;
use W4\UiFramework\Support\ClassBag;

class InputThemeResolver implements ComponentThemeResolverInterface
{
    public function classes(array $context = []): array
    {
        $variant = $context['variant'] ?? 'neutral';
        $size = $context['size'] ?? 'md';
        $state = $context['state'] ?? 'enabled';
        $interactState = $context['interact_state'] ?? [];

        $inputClasses = ClassBag::make([
            'block',
            'w-full',
            'rounded-md',
            'border',
            'transition',
            'focus:outline-none',
            'focus:ring-2',
            'disabled:opacity-50',
            'disabled:cursor-not-allowed',
        ]);

        $inputClasses->add(match ($variant) {
            'neutral' => 'border-slate-300 focus:border-slate-400 focus:ring-slate-400',
            'primary' => 'border-blue-300 focus:border-blue-500 focus:ring-blue-500',
            'secondary' => 'border-slate-300 focus:border-slate-500 focus:ring-slate-500',
            'accent' => 'border-violet-300 focus:border-violet-500 focus:ring-violet-500',
            'success' => 'border-emerald-300 focus:border-emerald-500 focus:ring-emerald-500',
            'warning' => 'border-amber-300 focus:border-amber-500 focus:ring-amber-500',
            'error' => 'border-rose-300 focus:border-rose-500 focus:ring-rose-500',
            default => 'border-slate-300 focus:border-slate-400 focus:ring-slate-400',
        });

        $sizeClasses = [
            'xs' => 'px-2 py-1 text-xs',
            'sm' => 'px-3 py-1.5 text-sm',
            'md' => 'px-3 py-2 text-sm',
            'lg' => 'px-4 py-2.5 text-base',
            'xl' => 'px-5 py-3 text-lg',
        ];

        $inputClasses->add($sizeClasses[$size] ?? $sizeClasses['md']);

        match ($state) {
            'valid' => $inputClasses->add('border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500'),
            'invalid' => $inputClasses->add('border-rose-500 focus:border-rose-500 focus:ring-rose-500'),
            'loading' => $inputClasses->add('opacity-75 animate-pulse'),
            default => null,
        };

        if (($interactState['focused'] ?? false) === true) {
            $inputClasses->add('ring-2');
        }

        if (! empty($context['attributes']['class'])) {
            $userClasses = (string) $context['attributes']['class'];

            if (preg_match('/(?:^|\s)!?(?:[a-z0-9-]+:)*w-(?:\S+)/i', $userClasses) === 1) {
                $inputClasses->remove('w-full');
            }

            if (preg_match('/(?:^|\s)!?(?:[a-z0-9-]+:)*(?:h|min-h|max-h)-(?:\S+)/i', $userClasses) === 1) {
                foreach ($sizeClasses as $mappedClasses) {
                    foreach (preg_split('/\s+/', $mappedClasses) ?: [] as $class) {
                        $inputClasses->remove($class);
                    }
                }
            }

            $inputClasses->merge($userClasses);
        }

        return [
            'root' => 'w-full',
            'input' => $inputClasses->toString(),
            'helper' => 'mt-1 text-sm text-slate-500',
            'error' => 'mt-1 text-sm text-rose-600',
            'label' => 'mb-1 block text-sm font-medium text-slate-700',
        ];
    }

    public function attributes(array $context = []): array
    {
        $state = $context['state'] ?? 'enabled';
        $userAttributes = $context['attributes'] ?? [];
        $interactState = $context['interact_state'] ?? [];

        return array_merge($userAttributes, [
            'type' => $context['type'] ?? $userAttributes['type'] ?? 'text',
            'name' => $context['name'] ?? $userAttributes['name'] ?? null,
            'id' => $context['id'] ?? $userAttributes['id'] ?? null,
            'value' => $context['value'] ?? $userAttributes['value'] ?? null,
            'placeholder' => $context['placeholder'] ?? $userAttributes['placeholder'] ?? null,
            'disabled' => in_array($state, ['disabled', 'loading'], true),
            'readonly' => $state === 'readonly',
            'aria-invalid' => in_array($state, ['invalid'], true) ? 'true' : 'false',
            'aria-busy' => $state === 'loading' ? 'true' : 'false',
            'data-focused' => ($interactState['focused'] ?? false) ? 'true' : 'false',
            'data-hovered' => ($interactState['hovered'] ?? false) ? 'true' : 'false',
            'data-filled' => ($interactState['filled'] ?? false) ? 'true' : 'false',
        ]);
    }
}
