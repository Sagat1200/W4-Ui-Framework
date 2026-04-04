# 🚀 W4-UI-Framework

## ✨ Contexto del componente Tailwind Divider

## 1. 📌 Información General

`Tailwind Divider` utiliza el componente base:

`W4\UiFramework\Components\UI\Divider\Divider`

y su estilo se resuelve con:

`W4\UiFramework\Themes\Tailwind\Components\UI\DividerThemeResolver`

## 2. 🧱 API base del Divider

```php
use W4\UiFramework\Components\UI\Divider\Divider;

$divider = Divider::make()
    ->theme('tailwind')
    ->text('Resumen')
    ->variant('primary')
    ->size('md')
    ->orientation('horizontal');
```

Estados:

- `enabled`
- `disabled`
- `active`
- `hidden`

Eventos:

- `activate`
- `deactivate`
- `disable`
- `enable`
- `hide`
- `show`
- `reset`

## 3. 🎨 Resolución visual Tailwind

Clases base:

- layout `flex` con pseudo-elementos `before` y `after`
- soporte horizontal y vertical

Color por `variant`:

- `primary` -> `border-blue-500`
- `secondary` -> `border-slate-400`
- `accent` -> `border-violet-500`
- `success` -> `border-emerald-500`
- `warning` -> `border-amber-500`
- `error` -> `border-rose-500`
- `info` -> `border-cyan-500`

Grosor por `size`:

- `xs|sm` -> grosor `1`
- `md` -> grosor `2`
- `lg` -> grosor `4`
- `xl` -> grosor `8`

Estados visuales:

- `disabled` agrega `opacity-50`
- `active` agrega `text-slate-700`
- `hidden` agrega `hidden`

Atributos:

- `role="separator"`
- `aria-orientation`
- `aria-hidden`
- `data-state`

## 4. 🖥️ Formas de renderizar Tailwind Divider

### 4.1 Helper global

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('tailwind')
        ->text('Configuración')
        ->variant('primary')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\Divider\Divider;

echo W4Ui::render(
    Divider::make()
        ->theme('tailwind')
        ->text('Bloque A')
        ->variant('accent')
        ->size('lg')
);
```

### 4.3 Componente Blade (`x-w4-divider`)

```blade
<x-w4-divider
    theme="tailwind"
    text="Datos"
    variant="info"
    size="md"
    orientation="horizontal"
    class="mt-6"
/>
```

### 4.4 Equivalencias de render (helper vs facade vs blade)

Helper:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('tailwind')
        ->text('Equivalente')
        ->variant('primary')
        ->size('md')
        ->orientation('horizontal')
);
```

Facade:

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\Divider\Divider;

echo W4Ui::render(
    Divider::make()
        ->theme('tailwind')
        ->text('Equivalente')
        ->variant('primary')
        ->size('md')
        ->orientation('horizontal')
);
```

Blade:

```blade
<x-w4-divider
    theme="tailwind"
    text="Equivalente"
    variant="primary"
    size="md"
    orientation="horizontal"
/>
```

### 4.5 Ejemplos de `class` para orientación vertical (`h-*`, `w-*`)

Vertical con alto personalizado:

```blade
<x-w4-divider
    theme="tailwind"
    text="Timeline"
    orientation="vertical"
    class="h-40 my-4"
/>
```

Vertical con ancho personalizado:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('tailwind')
        ->text('Separador')
        ->orientation('vertical')
        ->attribute('class', 'w-2 h-40')
);
```

## 5. 🔁 Estados y eventos

```php
use W4\UiFramework\Components\UI\Divider\Divider;
use W4\UiFramework\Components\UI\Divider\DividerComponentEvent;

$divider = Divider::make()
    ->theme('tailwind')
    ->text('Activo')
    ->dispatch(DividerComponentEvent::ACTIVATE);

echo w4_render($divider);
```

```php
$divider = Divider::make()
    ->theme('tailwind')
    ->text('Oculto')
    ->dispatch(DividerComponentEvent::HIDE);

echo w4_render($divider);
```

## 6. 🧪 Ejemplo en controlador

```php
use W4\UiFramework\Components\UI\Divider\Divider;
use W4\UiFramework\Facades\W4Ui;

public function settings()
{
    $divider = Divider::make()
        ->id('div-settings')
        ->name('settings_divider')
        ->theme('tailwind')
        ->text('Configuración avanzada')
        ->variant('secondary')
        ->size('sm')
        ->attribute('class', 'my-6');

    return view('settings.index', [
        'dividerHtml' => W4Ui::render($divider),
    ]);
}
```
