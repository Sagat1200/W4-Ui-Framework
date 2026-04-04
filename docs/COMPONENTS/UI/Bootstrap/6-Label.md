# 🚀 W4-UI-Framework

## ✨ Contexto del componente Bootstrap Label

## 1. 📌 Información General

`Bootstrap Label` en este paquete reutiliza el componente base:

`W4\UiFramework\Components\UI\Label\Label`

y aplica estilos/atributos a través del resolver Bootstrap:

`W4\UiFramework\Themes\Bootstrap\Components\UI\LabelThemeResolver`

Esto conserva la API funcional del label base y delega en Bootstrap la apariencia final por variante, tamaño y estado.

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
    ->theme('bootstrap')
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

## 3. 🎨 Resolución visual Bootstrap (ThemeResolver)

Según `LabelThemeResolver`, Bootstrap Label usa clases base:

- `form-label`
- `fw-medium`

### 3.1 Variantes Bootstrap disponibles

Mapeo actual de `variant`:

- `primary` -> `text-primary`
- `secondary` -> `text-secondary`
- `success` -> `text-success`
- `warning` -> `text-warning`
- `danger|error` -> `text-danger`
- `info` -> `text-info`
- `light` -> `text-light`
- `dark` -> `text-dark`
- valor no reconocido -> `text-body`

### 3.2 Tamaños Bootstrap disponibles

Mapeo actual de `size`:

- `xs` -> `fs-6`
- `sm` -> `fs-5`
- `md` -> `fs-4`
- `lg` -> `fs-3`
- `xl` -> `fs-2`

### 3.3 Estados y clases adicionales

- `state=disabled` agrega `opacity-50`
- `state=active` agrega `text-decoration-underline`
- `state=hidden` agrega `d-none`
- si el usuario pasa `class` en atributos, se hace merge con las clases resueltas

### 3.4 Atributos HTML resueltos

- `for`: usa `for` del usuario o `for` del componente
- `aria-hidden`: `'true'` cuando estado es `hidden`, en otro caso `'false'`
- `data-state`: estado actual del componente

## 4. 🖥️ Formas de renderizar Bootstrap Label

Nota de uso de tema:

- Usa `theme="bootstrap"` en `x-w4-label` cuando el tema global no sea Bootstrap y quieras forzar Bootstrap en esa instancia.
- Usa `->theme('bootstrap')` en `Label::make(...)` cuando renderizas por helper/facade/controlador.
- Si tu configuración global ya es Bootstrap (`W4_UI_THEME=bootstrap`), no es obligatorio repetir el tema.

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Label\Label::make('Correo')
        ->text('Correo electrónico')
        ->for('email')
        ->theme('bootstrap')
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
        ->theme('bootstrap')
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
    theme="bootstrap"
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

$active = Label::make('Estado')->theme('bootstrap')->dispatch(LabelComponentEvent::ACTIVATE);
$disabled = Label::make('Estado')->theme('bootstrap')->dispatch(LabelComponentEvent::DISABLE);
$hidden = Label::make('Estado')->theme('bootstrap')->dispatch(LabelComponentEvent::HIDE);
$reset = Label::make('Estado')->theme('bootstrap')->dispatch(LabelComponentEvent::RESET);
```

### 4.5 Ejemplos equivalentes en Blade (`x-w4-label`)

```blade
<x-w4-label label="Estado" text="Activo" theme="bootstrap" :active="true" />
<x-w4-label label="Estado" text="Bloqueado" theme="bootstrap" :disabled="true" />
<x-w4-label label="Estado" text="Oculto" theme="bootstrap" :hidden="true" />
```

Para volver al estado base (`reset`) en Blade, renderiza sin `:active`, `:disabled` y `:hidden`.

## 5. 🧭 Ejemplos prácticos Bootstrap

Label asociado a input:

```blade
<x-w4-label
    label="Correo"
    text="Correo electrónico"
    for="email"
    theme="bootstrap"
    variant="primary"
/>
```

Label con `componentId` para auditoría:

```blade
<x-w4-label
    label="Estado"
    text="Activo"
    theme="bootstrap"
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
        ->theme('bootstrap')
        ->variant('primary');

    return view('users.create', [
        'emailLabelHtml' => W4Ui::render($emailLabel),
    ]);
}
```

## 7. 📦 Notas de integración

- El label usa payload estándar (`renderer`, `view`, `data`, `theme`).
- La vista final del componente renderiza `<label>` con el contenido de `text` o fallback a `label`.
- Si usas optimización de CSS, valida que clases `form-label`, `text-*`, `d-none` y `text-decoration-underline` se mantengan.
