# 🚀 W4-UI-Framework

## ✨ Contexto del componente Tailwind Icon

## 1. 📌 Información General

`Tailwind Icon` reutiliza el componente base:

`W4\UiFramework\Components\UI\Icon\Icon`

y aplica estilos/atributos a través del resolver:

`W4\UiFramework\Themes\Tailwind\Components\UI\IconThemeResolver`

## 2. 🧱 API base del Icon (heredada)

Creación base:

```php
use W4\UiFramework\Components\UI\Icon\Icon;

$icon = Icon::make('Actualizar');
```

Fluent API más usada:

```php
$icon = Icon::make('Actualizar')
    ->name('refresh_icon')
    ->id('icon-refresh')
    ->theme('tailwind')
    ->icon('heroicon-o-arrow-path')
    ->variant('primary')
    ->size('lg')
    ->spin(true)
    ->decorative(false);
```

Estados funcionales soportados:

- `enabled`
- `disabled`
- `active`
- `hidden`

Eventos soportados por la state machine:

- `activate`
- `deactivate`
- `disable`
- `enable`
- `hide`
- `show`
- `reset`

## 3. 🎨 Resolución visual Tailwind (ThemeResolver)

### 3.1 Variantes disponibles

- `primary` -> `text-blue-600`
- `secondary` -> `text-slate-700`
- `accent` -> `text-violet-600`
- `success` -> `text-emerald-600`
- `warning` -> `text-amber-600`
- `error` -> `text-rose-600`
- `info` -> `text-cyan-600`
- default -> `text-slate-900`

### 3.2 Tamaños disponibles

- `xs` -> `text-xs`
- `sm` -> `text-sm`
- `md` -> `text-base`
- `lg` -> `text-lg`
- `xl` -> `text-xl`

### 3.3 Estados y clases adicionales

- base: `inline-block align-middle leading-none`
- `spin=true` agrega `animate-spin`
- `state=disabled` agrega `opacity-50`
- `state=active` agrega `drop-shadow-sm`
- `state=hidden` agrega `hidden`
- `class` del usuario se mergea con las clases resueltas

### 3.4 Atributos HTML resueltos

- `role="img"`
- `aria-hidden`
- `aria-label` (si no es decorativo)
- `data-state`
- `data-spin`

## 4. 🖥️ Formas de renderizar Tailwind Icon

Nota de uso de tema:

- Usa `theme="tailwind"` en `x-w4-icon` cuando el tema global no sea Tailwind.
- Usa `->theme('tailwind')` por helper/facade para forzar Tailwind en esa instancia.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Actualizar')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('primary')
        ->size('lg')
        ->spin(true)
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\Icon\Icon;

echo W4Ui::render(
    Icon::make('Estado')
        ->theme('tailwind')
        ->icon('heroicon-o-check-circle')
        ->variant('success')
);
```

### 4.3 Componente Blade directo (`x-w4-icon`)

```blade
<x-w4-icon
    theme="tailwind"
    label="Actualizar"
    icon="heroicon-o-arrow-path"
    variant="primary"
    size="lg"
    :spin="true"
    class="mr-2"
/>
```

Parámetros Blade comunes:

- `label`
- `icon`
- `id`
- `name`
- `theme`
- `renderer`
- `variant`
- `size`
- `spin`
- `decorative`
- `active`
- `disabled`
- `hidden`
- `focused`
- `hovered`
- `class`
- `componentId`

### 4.4 Ejemplos de renderizado por estado y evento

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Activo')
        ->theme('tailwind')
        ->icon('heroicon-o-bolt')
        ->dispatch(\W4\UiFramework\Components\UI\Icon\IconComponentEvent::ACTIVATE)
);
```

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Oculto')
        ->theme('tailwind')
        ->icon('heroicon-o-eye-slash')
        ->dispatch(\W4\UiFramework\Components\UI\Icon\IconComponentEvent::HIDE)
);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-icon`)

```blade
<x-w4-icon label="Visible" icon="heroicon-o-eye" theme="tailwind" />
<x-w4-icon label="Oculto" icon="heroicon-o-eye-slash" theme="tailwind" :hidden="true" />
```

## 5. 🧭 Ejemplos prácticos Tailwind

Icon con `componentId` para auditoría/estado:

```blade
<x-w4-icon
    label="Actualizar"
    icon="heroicon-o-arrow-path"
    theme="tailwind"
    :componentId="'icon-9001'"
/>
```

Inspección backend de `componentId` en payload:

```php
$debug = w4_debug_payload(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Actualizar')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->meta('component_id', 'icon-9001')
        ->attribute('data-component-id', 'icon-9001')
);
```

## 6. 🧩 Ejemplo en controlador Laravel

```php
use W4\UiFramework\Components\UI\Icon\Icon;
use W4\UiFramework\Facades\W4Ui;

public function index()
{
    $refreshIcon = Icon::make('Actualizar')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('primary')
        ->spin(true);

    return view('dashboard.index', [
        'refreshIconHtml' => W4Ui::render($refreshIcon),
    ]);
}
```

## 7. 📦 Notas de integración

- El icon usa payload estándar (`renderer`, `view`, `data`, `theme`).
- La vista final concatena clases del resolver + token de icono (`data.icon` o `label`).
- Si `W4_UI_LOG=true` y usas `componentId`, registra en `storage/logs/w4.ui.log`.
