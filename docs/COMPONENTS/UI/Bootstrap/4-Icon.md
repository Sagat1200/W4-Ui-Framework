# 🚀 W4-UI-Framework

## ✨ Contexto del componente Bootstrap Icon

## 1. 📌 Información General

`Bootstrap Icon` reutiliza el componente base:

`W4\UiFramework\Components\UI\Icon\Icon`

y aplica estilos/atributos a través del resolver:

`W4\UiFramework\Themes\Bootstrap\Components\UI\IconThemeResolver`

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
    ->theme('bootstrap')
    ->icon('bi-arrow-repeat')
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

## 3. 🎨 Resolución visual Bootstrap (ThemeResolver)

### 3.1 Variantes disponibles

- `primary` -> `text-primary`
- `secondary` -> `text-secondary`
- `success` -> `text-success`
- `warning` -> `text-warning`
- `danger|error` -> `text-danger`
- `info` -> `text-info`
- `light` -> `text-light`
- `dark` -> `text-dark`
- default -> `text-body`

### 3.2 Tamaños disponibles

- `xs` -> `fs-6`
- `sm` -> `fs-5`
- `md` -> `fs-4`
- `lg` -> `fs-3`
- `xl` -> `fs-2`

### 3.3 Estados y clases adicionales

- base: `d-inline-block align-middle lh-1`
- `spin=true` agrega `fa-spin`
- `state=disabled` agrega `opacity-50`
- `state=active` agrega `text-decoration-underline`
- `state=hidden` agrega `d-none`
- `class` del usuario se mergea con las clases resueltas

### 3.4 Atributos HTML resueltos

- `role="img"`
- `aria-hidden`
- `aria-label` (si no es decorativo)
- `data-state`
- `data-spin`

## 4. 🖥️ Formas de renderizar Bootstrap Icon

Nota de uso de tema:

- Usa `theme="bootstrap"` en `x-w4-icon` cuando el tema global no sea Bootstrap.
- Usa `->theme('bootstrap')` por helper/facade para forzar Bootstrap en esa instancia.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Actualizar')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
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
        ->theme('bootstrap')
        ->icon('bi-check-circle')
        ->variant('success')
);
```

### 4.3 Componente Blade directo (`x-w4-icon`)

```blade
<x-w4-icon
    theme="bootstrap"
    label="Actualizar"
    icon="bi-arrow-repeat"
    variant="primary"
    size="lg"
    :spin="true"
    class="me-2"
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
        ->theme('bootstrap')
        ->icon('bi-lightning-charge')
        ->dispatch(\W4\UiFramework\Components\UI\Icon\IconComponentEvent::ACTIVATE)
);
```

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Oculto')
        ->theme('bootstrap')
        ->icon('bi-eye-slash')
        ->dispatch(\W4\UiFramework\Components\UI\Icon\IconComponentEvent::HIDE)
);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-icon`)

```blade
<x-w4-icon label="Visible" icon="bi-eye" theme="bootstrap" />
<x-w4-icon label="Oculto" icon="bi-eye-slash" theme="bootstrap" :hidden="true" />
```

## 5. 🧭 Ejemplos prácticos Bootstrap

Icon con `componentId` para auditoría/estado:

```blade
<x-w4-icon
    label="Actualizar"
    icon="bi-arrow-repeat"
    theme="bootstrap"
    :componentId="'icon-9001'"
/>
```

Inspección backend de `componentId` en payload:

```php
$debug = w4_debug_payload(
    \W4\UiFramework\Components\UI\Icon\Icon::make('Actualizar')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
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
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
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
