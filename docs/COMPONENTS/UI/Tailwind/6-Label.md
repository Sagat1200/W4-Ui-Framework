# 🚀 W4-UI-Framework

## ✨ Contexto del componente Tailwind Label

## 1. 📌 Información General

`Tailwind Label` en este paquete reutiliza el componente base:

`W4\UiFramework\Components\UI\Label\Label`

y aplica estilos/atributos a través del resolver Tailwind:

`W4\UiFramework\Themes\Tailwind\Components\UI\LabelThemeResolver`

Esto conserva la API funcional del label base y delega en Tailwind la apariencia final por variante, tamaño y estado.

## 2. 🧱 API base del Label (heredada)

Creación base:

```php
use W4\UiFramework\Components\UI\Label\Label;

$label = Label::make('Correo');
```

Fluent API más usada:

```php
$label = Label::make('Correo')
    ->text('Correo electrónico')
    ->for('email')
    ->theme('tailwind')
    ->variant('primary')
    ->size('md');
```

Estados funcionales soportados:

- `enabled`
- `disabled`
- `active`
- `hidden`

Eventos soportados por la state machine del label:

- `activate`
- `deactivate`
- `disable`
- `enable`
- `hide`
- `show`
- `reset`

## 3. 🎨 Resolución visual Tailwind (ThemeResolver)

Según `LabelThemeResolver`, Tailwind Label usa clases base:

- `inline-block`
- `font-medium`
- `leading-snug`

### 3.1 Variantes Tailwind disponibles

Mapeo actual de `variant`:

- `primary` -> `text-blue-600`
- `secondary` -> `text-slate-700`
- `accent` -> `text-violet-600`
- `success` -> `text-emerald-600`
- `warning` -> `text-amber-600`
- `error` -> `text-rose-600`
- `info` -> `text-cyan-600`
- valor no reconocido -> `text-slate-900`

### 3.2 Tamaños Tailwind disponibles

Mapeo actual de `size`:

- `xs` -> `text-xs`
- `sm` -> `text-sm`
- `md` -> `text-base`
- `lg` -> `text-lg`
- `xl` -> `text-xl`

### 3.3 Estados y clases adicionales

- `state=disabled` agrega `opacity-50`
- `state=active` agrega `underline underline-offset-4`
- `state=hidden` agrega `hidden`
- si el usuario pasa `class` en atributos, se hace merge con las clases resueltas

### 3.4 Atributos HTML resueltos

- `for`: usa `for` del usuario o `for` del componente
- `aria-hidden`: `'true'` cuando estado es `hidden`, en otro caso `'false'`
- `data-state`: estado actual del componente

## 4. 🖥️ Formas de renderizar Tailwind Label

Nota de uso de tema:

- Usa `theme="tailwind"` en `x-w4-label` cuando el tema global no sea Tailwind y quieras forzar Tailwind en esa instancia.
- Usa `->theme('tailwind')` en `Label::make(...)` cuando renderizas por helper/facade/controlador.
- Si tu configuración global ya es Tailwind (`W4_UI_THEME=tailwind`), no es obligatorio repetir el tema.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Label\Label::make('Correo')
        ->text('Correo electrónico')
        ->for('email')
        ->theme('tailwind')
        ->variant('primary')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\Label\Label;

echo W4Ui::render(
    Label::make('Estado')
        ->text('Estado activo')
        ->theme('tailwind')
        ->variant('success')
        ->size('sm')
);
```

### 4.3 Componente Blade directo (`x-w4-label`)

```blade
<x-w4-label
    label="Correo"
    text="Correo electrónico"
    for="email"
    theme="tailwind"
    variant="primary"
    size="md"
/>
```

Parámetros Blade comunes:

- `label`
- `text`
- `for`
- `id`
- `name`
- `theme`
- `renderer`
- `variant`
- `size`
- `disabled`
- `active`
- `hidden`
- `focused`
- `hovered`
- `componentId`
- `class`

### 4.4 Ejemplos de renderizado por estado y evento

```php
use W4\UiFramework\Components\UI\Label\Label;
use W4\UiFramework\Components\UI\Label\LabelComponentEvent;

$active = Label::make('Estado')->theme('tailwind')->dispatch(LabelComponentEvent::ACTIVATE);
$disabled = Label::make('Estado')->theme('tailwind')->dispatch(LabelComponentEvent::DISABLE);
$hidden = Label::make('Estado')->theme('tailwind')->dispatch(LabelComponentEvent::HIDE);
$reset = Label::make('Estado')->theme('tailwind')->dispatch(LabelComponentEvent::RESET);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-label`)

```blade
<x-w4-label label="Estado" text="Activo" theme="tailwind" :active="true" />
<x-w4-label label="Estado" text="Bloqueado" theme="tailwind" :disabled="true" />
<x-w4-label label="Estado" text="Oculto" theme="tailwind" :hidden="true" />
```

Para volver al estado base (`reset`) en Blade, renderiza sin `:active`, `:disabled` y `:hidden`.

## 5. 🧭 Ejemplos prácticos Tailwind

Label asociado a input:

```blade
<x-w4-label
    label="Correo"
    text="Correo electrónico"
    for="email"
    theme="tailwind"
    variant="primary"
/>
```

Label con `componentId` para auditoría:

```blade
<x-w4-label
    label="Estado"
    text="Activo"
    theme="tailwind"
    :componentId="'label-audit-01'"
/>
```

## 6. 🧩 Ejemplo en controlador Laravel

```php
use W4\UiFramework\Components\UI\Label\Label;
use W4\UiFramework\Facades\W4Ui;

public function create()
{
    $emailLabel = Label::make('Correo')
        ->text('Correo electrónico')
        ->for('email')
        ->theme('tailwind')
        ->variant('primary');

    return view('users.create', [
        'emailLabelHtml' => W4Ui::render($emailLabel),
    ]);
}
```

## 7. 📦 Notas de integración

- El label usa payload estándar (`renderer`, `view`, `data`, `theme`).
- La vista final del componente renderiza `<label>` con el contenido de `text` o fallback a `label`.
- Si usas purge/safelist de Tailwind, incluye utilidades dinámicas (`text-*`, `hidden`, `opacity-50`, `underline`).
