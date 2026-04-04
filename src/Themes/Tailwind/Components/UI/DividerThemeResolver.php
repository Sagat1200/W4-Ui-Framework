<?php

namespace W4\UiFramework\Themes\Tailwind\Components\UI;

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

        $root = ClassBag::make([
            'relative',
            'flex',
            'items-center',
            'text-slate-500',
            'before:content-[""]',
            'before:flex-1',
            'after:content-[""]',
            'after:flex-1',
        ]);

        $label = ClassBag::make(['px-3']);

        if ($orientation === 'vertical') {
            $root->remove('items-center')
                ->remove('before:flex-1')
                ->remove('after:flex-1')
                ->add('flex-col')
                ->add('justify-center')
                ->add('h-full')
                ->add('before:w-px')
                ->add('before:h-1/2')
                ->add('after:w-px')
                ->add('after:h-1/2');
        } else {
            $root->add('w-full')
                ->add('before:border-t')
                ->add('after:border-t');
        }

        $colorClass = match ($variant) {
            'primary' => 'border-blue-500',
            'secondary' => 'border-slate-400',
            'accent' => 'border-violet-500',
            'success' => 'border-emerald-500',
            'warning' => 'border-amber-500',
            'error' => 'border-rose-500',
            'info' => 'border-cyan-500',
            default => 'border-slate-300',
        };

        if ($orientation === 'vertical') {
            $root->add(str_replace('border-', 'before:bg-', $colorClass))
                ->add(str_replace('border-', 'after:bg-', $colorClass));
        } else {
            $root->add('before:' . $colorClass)
                ->add('after:' . $colorClass);
        }

        $thicknessClass = match ($size) {
            'xs' => '1',
            'sm' => '1',
            'md' => '2',
            'lg' => '4',
            'xl' => '8',
            default => '2',
        };

        if ($orientation === 'vertical') {
            $root->add('before:w-' . $thicknessClass)
                ->add('after:w-' . $thicknessClass);
        } else {
            $root->add('before:border-t-' . $thicknessClass)
                ->add('after:border-t-' . $thicknessClass);
        }

        $label->add(match ($size) {
            'xs' => 'text-xs',
            'sm' => 'text-sm',
            'md' => 'text-sm',
            'lg' => 'text-base',
            'xl' => 'text-lg',
            default => 'text-sm',
        });

        if ($state === 'disabled') {
            $root->add('opacity-50');
        }

        if ($state === 'active') {
            $root->add('text-slate-700');
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
