# 🚀 W4-UI-Framework

## ✨ Contexto del componente Bootstrap IconButton

## 1. 📌 Información General

`Bootstrap IconButton` reutiliza el componente base:

`W4\UiFramework\Components\UI\IconButton\IconButton`

y aplica estilos/atributos mediante:

`W4\UiFramework\Themes\Bootstrap\Components\UI\IconButtonThemeResolver`

El componente está orientado a acciones iconográficas compactas usando clases de `btn` de Bootstrap.

## 2. 🧱 API base del IconButton (heredada)

Creación base:

```php
use W4\UiFramework\Components\UI\IconButton\IconButton;

$iconButton = IconButton::make('Actualizar');
```

Fluent API más usada:

```php
$iconButton = IconButton::make('Actualizar')
    ->id('btn-refresh')
    ->name('refresh')
    ->theme('bootstrap')
    ->icon('bi-arrow-repeat')
    ->variant('primary')
    ->size('md')
    ->attribute('type', 'button');
```

Estados funcionales soportados:

- `enabled`
- `disabled`
- `loading`
- `readonly`
- `active`

Eventos soportados por la state machine:

- `click`
- `disable`
- `enable`
- `start_loading`
- `finish_loading`
- `set_readonly`
- `set_active`
- `reset`

## 3. 🎨 Resolución visual Bootstrap (ThemeResolver)

Según `IconButtonThemeResolver`, Bootstrap IconButton usa clase base:

- `btn`

### 3.1 Variantes disponibles

- `primary` -> `btn-primary`
- `secondary` -> `btn-secondary`
- `success` -> `btn-success`
- `danger` -> `btn-danger`
- `warning` -> `btn-warning`
- `info` -> `btn-info`
- `light` -> `btn-light`
- `dark` -> `btn-dark`
- `link` -> `btn-link`
- default -> `btn-primary`

### 3.2 Tamaños disponibles

- `sm` -> `btn-sm`
- `md` -> sin clase adicional
- `lg` -> `btn-lg`

### 3.3 Estados y clases adicionales

- base: `btn`
- `state=disabled|readonly|loading` agrega `disabled`
- `state=active` agrega `active`
- `class` del usuario se mergea con clases resueltas

### 3.4 Atributos HTML resueltos

- `type`: valor de usuario o `button` por defecto
- `disabled`: `true` cuando estado es `disabled`, `loading` o `readonly`
- `aria-disabled`: `'true'` en `disabled`, `loading` o `readonly`
- `aria-pressed`: `'true'` cuando estado es `active`
- `aria-label`: toma `aria-label` del usuario o `label` del componente
- `title`: toma `title` del usuario o `label` del componente

## 4. 🖥️ Formas de renderizar Bootstrap IconButton

Nota de uso de tema:

- Usa `theme="bootstrap"` en `x-w4-icon-button` cuando el tema global de tu proyecto no sea Bootstrap y quieras forzar Bootstrap solo para ese botón.
- Usa `->theme('bootstrap')` en `IconButton::make(...)` cuando renderizas por helper/facade/controlador y quieres forzar Bootstrap en esa instancia.
- Si tu configuración global ya está en Bootstrap (`W4_UI_THEME=bootstrap`), no es obligatorio repetir `theme="bootstrap"` ni `->theme('bootstrap')`.
- Mantén `theme="bootstrap"` o `->theme('bootstrap')` en ejemplos de documentación cuando quieras que el snippet sea explícito y no dependa de la configuración global.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Actualizar')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
        ->variant('primary')
        ->size('md')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\IconButton\IconButton;

echo W4Ui::render(
    IconButton::make('Eliminar')
        ->theme('bootstrap')
        ->icon('bi-trash')
        ->variant('danger')
        ->size('sm')
);
```

### 4.3 Componente Blade directo (`x-w4-icon-button`)

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="bi-arrow-repeat"
    theme="bootstrap"
    variant="primary"
    size="md"
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
- `type`
- `disabled`
- `loading`
- `readonly`
- `active`
- `focused`
- `hovered`
- `pressed`
- `componentId`
- `class`

### 4.4 Ejemplos de renderizado por estado y evento

Render helper con estado `enabled`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Actualizar')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
        ->variant('primary')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::ENABLED)
);
```

Render helper con estado `disabled`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('No disponible')
        ->theme('bootstrap')
        ->icon('bi-lock-fill')
        ->variant('secondary')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::DISABLED)
);
```

Render helper con estado `loading`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Procesando')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
        ->variant('info')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::LOADING)
);
```

Render helper con estado `active`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Activo')
        ->theme('bootstrap')
        ->icon('bi-star-fill')
        ->variant('warning')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::ACTIVE)
);
```

Render helper con estado `readonly`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Solo lectura')
        ->theme('bootstrap')
        ->icon('bi-eye')
        ->variant('dark')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::READONLY)
);
```

Render por evento `set_active`:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Favorito')
        ->theme('bootstrap')
        ->icon('bi-star-fill')
        ->variant('success')
        ->dispatch(IconButtonComponentEvent::SET_ACTIVE)
);
```

Render por evento `start_loading`:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Cargando')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
        ->variant('info')
        ->dispatch(IconButtonComponentEvent::START_LOADING)
);
```

Render por evento `reset` después de activar:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

$iconButton = \W4\UiFramework\Components\UI\IconButton\IconButton::make('Reset')
    ->theme('bootstrap')
    ->icon('bi-arrow-repeat')
    ->dispatch(IconButtonComponentEvent::SET_ACTIVE)
    ->dispatch(IconButtonComponentEvent::RESET);

echo w4_render($iconButton);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-icon-button`)

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="bi-arrow-repeat"
    theme="bootstrap"
    variant="primary"
/>
```

```blade
<x-w4-icon-button
    label="No disponible"
    icon="bi-lock-fill"
    theme="bootstrap"
    variant="secondary"
    :disabled="true"
/>
```

```blade
<x-w4-icon-button
    label="Procesando"
    icon="bi-arrow-repeat"
    theme="bootstrap"
    variant="info"
    :loading="true"
/>
```

```blade
<x-w4-icon-button
    label="Activo"
    icon="bi-star-fill"
    theme="bootstrap"
    variant="warning"
    :active="true"
/>
```

```blade
<x-w4-icon-button
    label="Solo lectura"
    icon="bi-eye"
    theme="bootstrap"
    variant="dark"
    :readonly="true"
/>
```

Para volver a estado base (`reset`) en Blade, renderiza el componente sin `:active`, `:loading`, `:disabled` ni `:readonly`.

## 5. 🧭 Ejemplos prácticos Bootstrap

IconButton de recarga:

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="bi-arrow-repeat"
    theme="bootstrap"
    variant="primary"
    size="md"
/>
```

IconButton de borrado:

```blade
<x-w4-icon-button
    label="Eliminar"
    icon="bi-trash"
    theme="bootstrap"
    variant="danger"
    size="sm"
/>
```

IconButton con `componentId` para auditoría/estado:

```blade
<x-w4-icon-button
    label="Editar"
    icon="bi-pencil-square"
    theme="bootstrap"
    :componentId="'icon-button-9100'"
/>
```

Inspección backend de `componentId` en payload:

```php
$debug = w4_debug_payload(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Editar')
        ->theme('bootstrap')
        ->icon('bi-pencil-square')
        ->meta('component_id', 'icon-button-9100')
        ->attribute('data-component-id', 'icon-button-9100')
);
```

## 6. 🧩 Ejemplo en controlador Laravel

```php
use W4\UiFramework\Components\UI\IconButton\IconButton;
use W4\UiFramework\Facades\W4Ui;

public function index()
{
    $refreshButton = IconButton::make('Actualizar')
        ->theme('bootstrap')
        ->icon('bi-arrow-repeat')
        ->variant('primary')
        ->size('md');

    return view('dashboard.index', [
        'refreshButtonHtml' => W4Ui::render($refreshButton),
    ]);
}
```

## 7. 📦 Notas de integración

- El componente usa payload estándar (`renderer`, `view`, `data`, `theme`).
- La vista final de IconButton imprime `<button>` y utiliza el valor de `icon` dentro de una etiqueta `<i>`.
- Si tu proyecto integra purga/minificación agresiva de clases, valida que `btn-*` y estados como `active`/`disabled` no se eliminen.
