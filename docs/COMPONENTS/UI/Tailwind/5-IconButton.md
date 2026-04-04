# 🚀 W4-UI-Framework

## ✨ Contexto del componente Tailwind IconButton

## 1. 📌 Información General

`Tailwind IconButton` reutiliza el componente base:

`W4\UiFramework\Components\UI\IconButton\IconButton`

y aplica estilos/atributos mediante:

`W4\UiFramework\Themes\Tailwind\Components\UI\IconButtonThemeResolver`

El objetivo es ofrecer botones de icono con control de variante, tamaño y estado usando utilidades Tailwind.

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
    ->theme('tailwind')
    ->icon('heroicon-o-arrow-path')
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

## 3. 🎨 Resolución visual Tailwind (ThemeResolver)

Según `IconButtonThemeResolver`, Tailwind IconButton usa clases base:

- `inline-flex items-center justify-center`
- `rounded-md font-medium transition-colors`
- `focus:outline-none focus:ring-2 focus:ring-offset-2`
- `disabled:opacity-50 disabled:pointer-events-none`
- `shrink-0`

### 3.1 Variantes disponibles

- `neutral` -> `bg-slate-700 text-white hover:bg-slate-800 focus:ring-slate-500`
- `primary` -> `bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500`
- `secondary` -> `bg-slate-100 text-slate-900 hover:bg-slate-200 focus:ring-slate-400`
- `accent` -> `bg-violet-600 text-white hover:bg-violet-700 focus:ring-violet-500`
- `info` -> `bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500`
- `success` -> `bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500`
- `warning` -> `bg-amber-500 text-slate-900 hover:bg-amber-600 focus:ring-amber-500`
- `error` -> `bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-500`
- default -> fallback `primary`

### 3.2 Tamaños disponibles

- `xs` -> `h-7 w-7 text-xs`
- `sm` -> `h-8 w-8 text-sm`
- `md` -> `h-10 w-10 text-sm`
- `lg` -> `h-11 w-11 text-base`
- `xl` -> `h-12 w-12 text-lg`

### 3.3 Estados y clases adicionales

- base: `inline-flex items-center justify-center rounded-md ... shrink-0`
- `state=loading` agrega `opacity-75 cursor-wait`
- `state=active` agrega `ring-2 ring-offset-2`
- `class` del usuario se mergea con clases resueltas
- si `class` incluye `h-*`, `min-h-*` o `max-h-*`, se remueven clases de tamaño para priorizar altura custom

### 3.4 Atributos HTML resueltos

- `type`: valor de usuario o `button` por defecto
- `disabled`: `true` cuando estado es `disabled`, `loading` o `readonly`
- `aria-disabled`: `'true'` en `disabled`, `loading` o `readonly`
- `aria-pressed`: `'true'` cuando estado es `active`
- `aria-label`: toma `aria-label` del usuario o `label` del componente
- `title`: toma `title` del usuario o `label` del componente

## 4. 🖥️ Formas de renderizar Tailwind IconButton

Nota de uso de tema:

- Usa `theme="tailwind"` en `x-w4-icon-button` cuando el tema global de tu proyecto no sea Tailwind y quieras forzar Tailwind solo para ese botón.
- Usa `->theme('tailwind')` en `IconButton::make(...)` cuando renderizas por helper/facade/controlador y quieres forzar Tailwind en esa instancia.
- Si tu configuración global ya está en Tailwind (`W4_UI_THEME=tailwind`), no es obligatorio repetir `theme="tailwind"` ni `->theme('tailwind')`.
- Mantén `theme="tailwind"` o `->theme('tailwind')` en ejemplos de documentación cuando quieras que el snippet sea explícito y no dependa de la configuración global.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Actualizar')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('primary')
        ->size('md')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\IconButton\IconButton;

echo W4Ui::render(
    IconButton::make('Editar')
        ->theme('tailwind')
        ->icon('heroicon-o-pencil-square')
        ->variant('secondary')
        ->size('sm')
);
```

### 4.3 Componente Blade directo (`x-w4-icon-button`)

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="heroicon-o-arrow-path"
    theme="tailwind"
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
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('primary')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::ENABLED)
);
```

Render helper con estado `disabled`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('No disponible')
        ->theme('tailwind')
        ->icon('heroicon-o-lock-closed')
        ->variant('secondary')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::DISABLED)
);
```

Render helper con estado `loading`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Procesando')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('info')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::LOADING)
);
```

Render helper con estado `active`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Activo')
        ->theme('tailwind')
        ->icon('heroicon-o-star')
        ->variant('accent')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::ACTIVE)
);
```

Render helper con estado `readonly`:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Solo lectura')
        ->theme('tailwind')
        ->icon('heroicon-o-eye')
        ->variant('warning')
        ->state(\W4\UiFramework\Components\UI\IconButton\IconButtonComponentState::READONLY)
);
```

Render por evento `set_active`:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Favorito')
        ->theme('tailwind')
        ->icon('heroicon-o-star')
        ->variant('success')
        ->dispatch(IconButtonComponentEvent::SET_ACTIVE)
);
```

Render por evento `start_loading`:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Cargando')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
        ->variant('info')
        ->dispatch(IconButtonComponentEvent::START_LOADING)
);
```

Render por evento `reset` después de activar:

```php
use W4\UiFramework\Components\UI\IconButton\IconButtonComponentEvent;

$iconButton = \W4\UiFramework\Components\UI\IconButton\IconButton::make('Reset')
    ->theme('tailwind')
    ->icon('heroicon-o-arrow-path')
    ->dispatch(IconButtonComponentEvent::SET_ACTIVE)
    ->dispatch(IconButtonComponentEvent::RESET);

echo w4_render($iconButton);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-icon-button`)

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="heroicon-o-arrow-path"
    theme="tailwind"
    variant="primary"
/>
```

```blade
<x-w4-icon-button
    label="No disponible"
    icon="heroicon-o-lock-closed"
    theme="tailwind"
    variant="secondary"
    :disabled="true"
/>
```

```blade
<x-w4-icon-button
    label="Procesando"
    icon="heroicon-o-arrow-path"
    theme="tailwind"
    variant="info"
    :loading="true"
/>
```

```blade
<x-w4-icon-button
    label="Activo"
    icon="heroicon-o-star"
    theme="tailwind"
    variant="accent"
    :active="true"
/>
```

```blade
<x-w4-icon-button
    label="Solo lectura"
    icon="heroicon-o-eye"
    theme="tailwind"
    variant="warning"
    :readonly="true"
/>
```

Para volver a estado base (`reset`) en Blade, renderiza el componente sin `:active`, `:loading`, `:disabled` ni `:readonly`.

## 5. 🧭 Ejemplos prácticos Tailwind

IconButton de recarga:

```blade
<x-w4-icon-button
    label="Actualizar"
    icon="heroicon-o-arrow-path"
    theme="tailwind"
    variant="primary"
    size="md"
/>
```

IconButton de borrado:

```blade
<x-w4-icon-button
    label="Eliminar"
    icon="heroicon-o-trash"
    theme="tailwind"
    variant="error"
    size="sm"
/>
```

IconButton con `componentId` para auditoría/estado:

```blade
<x-w4-icon-button
    label="Editar"
    icon="heroicon-o-pencil-square"
    theme="tailwind"
    :componentId="'icon-button-9200'"
/>
```

Inspección backend de `componentId` en payload:

```php
$debug = w4_debug_payload(
    \W4\UiFramework\Components\UI\IconButton\IconButton::make('Editar')
        ->theme('tailwind')
        ->icon('heroicon-o-pencil-square')
        ->meta('component_id', 'icon-button-9200')
        ->attribute('data-component-id', 'icon-button-9200')
);
```

## 6. 🧩 Ejemplo en controlador Laravel

```php
use W4\UiFramework\Components\UI\IconButton\IconButton;
use W4\UiFramework\Facades\W4Ui;

public function index()
{
    $refreshButton = IconButton::make('Actualizar')
        ->theme('tailwind')
        ->icon('heroicon-o-arrow-path')
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
- Si usas purga de clases, incluye en el escaneo/safelist las clases dinámicas de variantes, tamaños y estados de Tailwind.
