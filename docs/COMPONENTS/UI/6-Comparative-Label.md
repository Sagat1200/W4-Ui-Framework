# 🚀 W4-UI-Framework

## ✨ Comparativa de Label por tema

Este resumen unifica el comportamiento de `Label` en:

- DaisyUI
- Bootstrap
- Tailwind

Componente base común:

`W4\UiFramework\Components\UI\Label\Label`

## 1. 🧱 API funcional común

Se mantiene igual en los 3 temas:

- Estados: `enabled`, `disabled`, `active`, `hidden`
- Eventos: `activate`, `deactivate`, `disable`, `enable`, `hide`, `show`, `reset`
- Métodos típicos: `text(...)`, `for(...)`, `variant(...)`, `size(...)`, `dispatch(...)`, `toArray()`, `toThemeContext()`

## 2. 🎨 Mapeo visual por tema

|Aspecto|DaisyUI|Bootstrap|Tailwind|
|---|---|---|---|
|Resolver|`DaisyUI\...\LabelThemeResolver`|`Bootstrap\...\LabelThemeResolver`|`Tailwind\...\LabelThemeResolver`|
|Clase base|`label font-medium`|`form-label fw-medium`|`inline-block font-medium leading-snug`|
|Variantes|`text-primary`, `text-secondary`, `text-accent`, `text-success`, `text-warning`, `text-error`, `text-info`, `text-base-content`|`text-primary`, `text-secondary`, `text-success`, `text-warning`, `text-danger`, `text-info`, `text-light`, `text-dark`, `text-body`|`text-blue-*`, `text-slate-*`, `text-violet-*`, `text-emerald-*`, `text-amber-*`, `text-rose-*`, `text-cyan-*`|
|Tamaños|`text-xs`, `text-sm`, `text-base`, `text-lg`, `text-xl`|`fs-6`, `fs-5`, `fs-4`, `fs-3`, `fs-2`|`text-xs`, `text-sm`, `text-base`, `text-lg`, `text-xl`|
|Estado `disabled`|Agrega `opacity-50`|Agrega `opacity-50`|Agrega `opacity-50`|
|Estado `active`|Agrega `underline`|Agrega `text-decoration-underline`|Agrega `underline underline-offset-4`|
|Estado `hidden`|Agrega `hidden`|Agrega `d-none`|Agrega `hidden`|
|Merge de `class` usuario|Sí|Sí|Sí|

## 3. ♿ Atributos de accesibilidad y estado

En los 3 temas se resuelven de forma equivalente:

- `for`: usa `for` del usuario o el `for` del componente
- `aria-hidden`: `'true'` cuando estado es `hidden`
- `data-state`: estado actual del componente

## 4. 🖥️ Uso rápido equivalente

### 4.1 DaisyUI

```blade
<x-w4-label
    label="Correo"
    text="Correo electrónico"
    for="email"
    theme="daisyui"
    variant="primary"
    size="md"
/>
```

### 4.2 Bootstrap

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

### 4.3 Tailwind

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

## 5. 🔗 Referencias detalladas

- Daisy: `docs/COMPONENTS/UI/Daisy/6-Label.md`
- Bootstrap: `docs/COMPONENTS/UI/Bootstrap/6-Label.md`
- Tailwind: `docs/COMPONENTS/UI/Tailwind/6-Label.md`
