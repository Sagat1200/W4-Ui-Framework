# 🚀 W4-UI-Framework

## ✨ Contexto del componente Tailwind Input

## 1. 📌 Información General

`Tailwind Input` en este paquete reutiliza el componente base:

`W4\UiFramework\Components\Forms\Input\Input`

y aplica estilos/atributos a través del resolver Tailwind:

`W4\UiFramework\Themes\Tailwind\Components\Forms\InputThemeResolver`

Esto mantiene la API funcional del input y delega la parte visual a utilidades de Tailwind.

## 2. 🧱 API base del Input (heredada)

Creación base:

```php
use W4\UiFramework\Components\Forms\Input\Input;

$input = Input::make('Correo');
```

Fluent API más usada:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

$input = Input::make('Correo')
    ->name('email')
    ->id('input-email')
    ->theme('tailwind')
    ->type('email')
    ->placeholder('correo@dominio.com')
    ->variant('primary')
    ->size('md')
    ->dispatch(InputComponentEvent::SET_VALID);
```

Estados funcionales soportados:

- `enabled`
- `disabled`
- `readonly`
- `invalid`
- `valid`
- `loading`

Eventos soportados:

- `focus`
- `blur`
- `input`
- `disable`
- `enable`
- `set_readonly`
- `set_invalid`
- `set_valid`
- `start_loading`
- `finish_loading`
- `reset`

Métodos de conveniencia disponibles:

- `disable()`
- `enable()`
- `setReadonly()`
- `setInvalid()`
- `setValid()`
- `startLoading()`
- `finishLoading()`
- `resetState()`
- `can(InputComponentEvent $event)`
- `dispatch(InputComponentEvent $event)`

Ejemplo de transición por evento:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

$input = Input::make('Correo')
    ->theme('tailwind')
    ->dispatch(InputComponentEvent::SET_INVALID);
```

## 3. 🎨 Resolución visual Tailwind (ThemeResolver)

Según `InputThemeResolver`, Tailwind Input usa clases base:

- `block w-full rounded-md border transition`
- `focus:outline-none focus:ring-2`
- `disabled:opacity-50 disabled:cursor-not-allowed`

### 3.1 Variantes Tailwind disponibles

Mapeo actual de `variant`:

- `neutral` -> `border-slate-300 focus:border-slate-400 focus:ring-slate-400`
- `primary` -> `border-blue-300 focus:border-blue-500 focus:ring-blue-500`
- `secondary` -> `border-slate-300 focus:border-slate-500 focus:ring-slate-500`
- `accent` -> `border-violet-300 focus:border-violet-500 focus:ring-violet-500`
- `success` -> `border-emerald-300 focus:border-emerald-500 focus:ring-emerald-500`
- `warning` -> `border-amber-300 focus:border-amber-500 focus:ring-amber-500`
- `error` -> `border-rose-300 focus:border-rose-500 focus:ring-rose-500`
- valor no reconocido -> `neutral`

### 3.2 Tamaños disponibles

Mapeo actual de `size`:

- `xs` -> `px-2 py-1 text-xs`
- `sm` -> `px-3 py-1.5 text-sm`
- `md` -> `px-3 py-2 text-sm`
- `lg` -> `px-4 py-2.5 text-base`
- `xl` -> `px-5 py-3 text-lg`

### 3.3 Estados y clases adicionales

- `state=valid` fuerza borde/ring de éxito
- `state=invalid` fuerza borde/ring de error
- `state=loading` agrega `opacity-75 animate-pulse`
- `interact_state.focused=true` agrega `ring-2`
- si el usuario pasa `class`, se hace merge con clases resueltas
- si `class` incluye `w-*`, se remueve `w-full` para respetar ancho custom
- si `class` incluye `h-*`, `min-h-*` o `max-h-*`, se remueven clases de tamaño para priorizar altura custom

Ejemplo de `class` con prioridad de ancho/alto:

```blade
<x-w4-input
    label="Correo"
    theme="tailwind"
    variant="primary"
    size="xs"
    class="w-52 h-14"
/>
```

### 3.4 Atributos HTML resueltos

- `type`, `name`, `id`, `value`, `placeholder` desde contexto/atributos
- `disabled`: `true` en `disabled` o `loading`
- `readonly`: `true` en `readonly`
- `aria-invalid`: `'true'` en `invalid`
- `aria-busy`: `'true'` en `loading`
- `data-focused`, `data-hovered`, `data-filled` según `interact_state`

## 4. 🖥️ Formas de renderizar Tailwind Input

Nota de uso de tema:

- Usa `theme="tailwind"` en `x-w4-input` cuando el tema global de tu proyecto no sea Tailwind y quieras forzar Tailwind solo para ese input.
- Usa `->theme('tailwind')` en `Input::make(...)` cuando renderizas por helper/facade/controlador y quieres forzar Tailwind en esa instancia.
- Si tu configuración global ya está en Tailwind (`W4_UI_THEME=tailwind`), no es obligatorio repetir `theme="tailwind"` ni `->theme('tailwind')`.
- Mantén `theme="tailwind"` o `->theme('tailwind')` en ejemplos de documentación cuando quieras que el snippet sea explícito y no dependa de la configuración global.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Usuario')
        ->theme('tailwind')
        ->name('username')
        ->placeholder('tu usuario')
        ->variant('primary')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\Forms\Input\Input;

echo W4Ui::render(
    Input::make('Correo')
        ->theme('tailwind')
        ->type('email')
        ->variant('error')
        ->size('sm')
);
```

### 4.3 Componente Blade directo (`x-w4-input`)

```blade
<x-w4-input
    label="Correo"
    theme="tailwind"
    name="email"
    type="email"
    variant="primary"
    size="md"
    placeholder="correo@dominio.com"
/>
```

Parámetros Blade comunes:

- `label`
- `id`
- `name`
- `theme`
- `renderer`
- `type`
- `value`
- `placeholder`
- `helperText`
- `errorMessage`
- `variant`
- `size`
- `disabled`
- `loading`
- `readonly`
- `invalid`
- `valid`
- `focused`
- `hovered`
- `filled`
- `class`

### 4.4 Ejemplos de renderizado por estado y evento

Render helper con estado `enabled`:

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Correo')
        ->theme('tailwind')
        ->variant('neutral')
        ->state(\W4\UiFramework\Components\Forms\Input\InputComponentState::ENABLED)
);
```

Render helper con estado `disabled`:

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('No editable')
        ->theme('tailwind')
        ->variant('neutral')
        ->state(\W4\UiFramework\Components\Forms\Input\InputComponentState::DISABLED)
);
```

Render helper con estado `loading`:

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Buscando')
        ->theme('tailwind')
        ->variant('primary')
        ->state(\W4\UiFramework\Components\Forms\Input\InputComponentState::LOADING)
);
```

Render helper con estado `invalid`:

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Correo')
        ->theme('tailwind')
        ->variant('error')
        ->errorMessage('Correo inválido')
        ->state(\W4\UiFramework\Components\Forms\Input\InputComponentState::INVALID)
);
```

Render helper con estado `valid`:

```php
echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Correo')
        ->theme('tailwind')
        ->variant('success')
        ->state(\W4\UiFramework\Components\Forms\Input\InputComponentState::VALID)
);
```

Render por evento `set_invalid`:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Validación')
        ->theme('tailwind')
        ->variant('error')
        ->dispatch(InputComponentEvent::SET_INVALID)
);
```

Render por evento `start_loading`:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

echo w4_render(
    \W4\UiFramework\Components\Forms\Input\Input::make('Consultar')
        ->theme('tailwind')
        ->variant('primary')
        ->dispatch(InputComponentEvent::START_LOADING)
);
```

Render por evento `reset` después de invalidar:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

$input = \W4\UiFramework\Components\Forms\Input\Input::make('Reset')
    ->theme('tailwind')
    ->dispatch(InputComponentEvent::SET_INVALID)
    ->dispatch(InputComponentEvent::RESET);

echo w4_render($input);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-input`)

Render Blade equivalente a `enabled`:

```blade
<x-w4-input
    label="Correo"
    theme="tailwind"
    variant="neutral"
/>
```

Render Blade equivalente a `disabled`:

```blade
<x-w4-input
    label="No editable"
    theme="tailwind"
    variant="neutral"
    :disabled="true"
/>
```

Render Blade equivalente a `loading`:

```blade
<x-w4-input
    label="Buscando"
    theme="tailwind"
    variant="primary"
    :loading="true"
/>
```

Render Blade equivalente a `invalid`:

```blade
<x-w4-input
    label="Correo"
    theme="tailwind"
    variant="error"
    errorMessage="Correo inválido"
    :invalid="true"
/>
```

Render Blade equivalente a `valid`:

```blade
<x-w4-input
    label="Correo válido"
    theme="tailwind"
    variant="success"
    :valid="true"
/>
```

Render Blade simulando transición de eventos (`set_invalid` y `start_loading`) por props:

```blade
<x-w4-input
    label="Inválido por estado"
    theme="tailwind"
    variant="error"
    :invalid="true"
/>

<x-w4-input
    label="Cargando por estado"
    theme="tailwind"
    variant="primary"
    :loading="true"
/>
```

Para volver a estado base (`reset`) en Blade, renderiza el input sin `:invalid`, `:valid`, `:loading`, `:disabled` ni `:readonly`.

Ejemplo de transición por evento:

```php
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;

$input = Input::make('Correo')
    ->theme('tailwind')
    ->dispatch(InputComponentEvent::SET_INVALID);
```

## 5. 🧭 Ejemplos prácticos Tailwind

Input de correo:

```blade
<x-w4-input
    label="Correo"
    name="email"
    theme="tailwind"
    type="email"
    variant="primary"
    placeholder="correo@dominio.com"
/>
```

Input con ancho y alto custom:

```blade
<x-w4-input
    label="Correo"
    name="email"
    theme="tailwind"
    variant="primary"
    size="xs"
    class="w-52 h-14"
/>
```

Input con estado inválido:

```blade
<x-w4-input
    label="Correo"
    name="email"
    theme="tailwind"
    variant="error"
    errorMessage="Correo inválido"
    :invalid="true"
/>
```

Input con interacción marcada:

```blade
<x-w4-input
    label="Usuario"
    name="username"
    theme="tailwind"
    :focused="true"
    :hovered="true"
    :filled="true"
    value="john.doe"
/>
```

Input con `componentId` para auditoría/estado:

```blade
<x-w4-input
    label="Correo"
    name="email"
    theme="tailwind"
    :componentId="12547"
    type="email"
    variant="primary"
    placeholder="correo@dominio.com"
/>
```

Inspección backend de `componentId` en payload:

```php
use W4\UiFramework\Components\Forms\Input\Input;

$input = Input::make('Correo')
    ->theme('tailwind')
    ->meta('component_id', 12547)
    ->attribute('data-component-id', '12547');

$debug = w4_debug_payload($input);

dd(
    $debug['component_id'],
    $debug['dom_component_id'],
    $debug['state'],
    $debug['payload']
);
```

## 6. 🧩 Ejemplo en controlador Laravel

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use W4\UiFramework\Components\Forms\Input\Input;
use W4\UiFramework\Components\Forms\Input\InputComponentEvent;
use W4\UiFramework\Facades\W4Ui;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $emailInput = Input::make('Correo')
            ->name('email')
            ->id('input-email')
            ->theme('tailwind')
            ->type('email')
            ->variant('error')
            ->placeholder('correo@dominio.com')
            ->dispatch(InputComponentEvent::SET_INVALID)
            ->errorMessage('Formato de correo inválido');

        return view('profile.edit', [
            'emailInputHtml' => W4Ui::render($emailInput),
        ]);
    }
}
```

En la vista:

```blade
<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    {!! $emailInputHtml !!}
</form>
```

## 7. 📦 Notas de integración

- Tailwind Input usa payload estándar (`renderer`, `view`, `data`, `theme`).
- El merge de `class` respeta clases custom sin perder `variant`.
- Si tu build purga clases dinámicas, incluye utilidades usadas en `class` dentro del scan/safelist.
