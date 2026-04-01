{{-- {!! $html() !!} --}}

@php
    $instance = $component();

    $extraAttributes = $attributes->getAttributes();

    if (method_exists($instance, 'attributes') && !empty($extraAttributes)) {
        $instance->attributes($extraAttributes);
    }
@endphp

{!! app(\W4\UIFramework\Support\W4UIManager::class)->render($instance, $renderer) !!}