# 🚀 W4-UI-Framework

## ✨ Contexto del componente Bootstrap Divider

## 1. 📌 Información General

`Bootstrap Divider` usa:

- componente base `W4\UiFramework\Components\UI\Divider\Divider`
- resolver `W4\UiFramework\Themes\Bootstrap\Components\UI\DividerThemeResolver`

## 2. 🧱 API del componente

```php
use W4\UiFramework\Components\UI\Divider\Divider;

$divider = Divider::make()
    ->theme('bootstrap')
    ->text('Sección')
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

## 3. 🎨 Resolución visual Bootstrap

Base:

- `d-flex align-items-center text-muted`
- horizontal: `w-100 border-top`
- vertical: `h-100 border-start`

Variantes (`border-*`):

- `primary`, `secondary`, `success`, `warning`, `danger|error`, `info`, `light`, `dark|neutral`

Tamaños:

- `xs|sm` -> `border-1`
- `md` -> `border-2`
- `lg` -> `border-3`
- `xl` -> `border-4`

Estados:

- `disabled` -> `opacity-50`
- `active` -> `border-opacity-100`
- `hidden` -> `d-none`

Atributos:

- `role="separator"`
- `aria-orientation`
- `aria-hidden`
- `data-state`

## 4. 🖥️ Formas de renderizar

### 4.1 Helper

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('bootstrap')
        ->text('Detalle')
        ->variant('info')
);
```

### 4.2 Facade

```php
use W4\UiFramework\Facades\W4Ui;
use W4\UiFramework\Components\UI\Divider\Divider;

echo W4Ui::render(
    Divider::make()
        ->theme('bootstrap')
        ->text('Información')
        ->variant('secondary')
        ->size('lg')
);
```

### 4.3 Blade

```blade
<x-w4-divider
    theme="bootstrap"
    text="Información"
    variant="primary"
    size="md"
    orientation="horizontal"
    class="my-3"
/>
```

### 4.4 Equivalencias de render (helper vs facade vs blade)

Helper:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('bootstrap')
        ->text('Equivalente')
        ->variant('secondary')
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
        ->theme('bootstrap')
        ->text('Equivalente')
        ->variant('secondary')
        ->size('md')
        ->orientation('horizontal')
);
```

Blade:

```blade
<x-w4-divider
    theme="bootstrap"
    text="Equivalente"
    variant="secondary"
    size="md"
    orientation="horizontal"
/>
```

### 4.5 Ejemplos de `class` para orientación vertical (`h-*`, `w-*`)

Vertical con alto personalizado:

```blade
<x-w4-divider
    theme="bootstrap"
    text="Sección"
    orientation="vertical"
    class="h-100 my-3"
/>
```

Vertical con ancho personalizado:

```php
echo w4_render(
    \W4\UiFramework\Components\UI\Divider\Divider::make()
        ->theme('bootstrap')
        ->text('Separador')
        ->orientation('vertical')
        ->attribute('class', 'w-25 h-100')
);
```

## 5. 🔁 Evento de ejemplo

```php
use W4\UiFramework\Components\UI\Divider\Divider;
use W4\UiFramework\Components\UI\Divider\DividerComponentEvent;

echo w4_render(
    Divider::make()
        ->theme('bootstrap')
        ->text('Activo')
        ->dispatch(DividerComponentEvent::ACTIVATE)
);
```
