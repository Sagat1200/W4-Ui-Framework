# 🚀 W4-UI-Framework

## ✨ Comparativa de Divider por tema

Este resumen unifica el comportamiento de `Divider` en:

- DaisyUI
- Bootstrap
- Tailwind

Componente base común:

`W4\UiFramework\Components\UI\Divider\Divider`

## 1. 🧱 API funcional común

Se mantiene igual en los 3 temas:

- Estados: `enabled`, `disabled`, `active`, `hidden`
- Eventos: `activate`, `deactivate`, `disable`, `enable`, `hide`, `show`, `reset`
- Métodos típicos: `variant(...)`, `size(...)`, `orientation(...)`, `dispatch(...)`, `toArray()`, `toThemeContext()`

## 2. 🎨 Mapeo visual por tema

|Aspecto|DaisyUI|Bootstrap|Tailwind|
|---|---|---|---|
|Resolver|`DaisyUI\...\DividerThemeResolver`|`Bootstrap\...\DividerThemeResolver`|`Tailwind\...\DividerThemeResolver`|
|Clase base|`divider`|`w-100 d-flex align-items-center text-muted`|`relative flex items-center text-slate-500 before:* after:*`|
|Variantes|`divider-neutral`, `divider-primary`, `divider-secondary`, `divider-accent`, `divider-success`, `divider-warning`, `divider-error`, `divider-info`|`border-primary`, `border-secondary`, `border-success`, `border-warning`, `border-danger`, `border-info`, `border-light`, `border-dark`|`border-blue-*`, `border-slate-*`, `border-violet-*`, `border-emerald-*`, `border-amber-*`, `border-rose-*`, `border-cyan-*`|
|Tamaños|Solo afecta label (`text-xs..text-xl`)|`border-1..border-4`|Grosor de líneas (`before:border-t-*`, `after:border-t-*` o `before:w-*`, `after:w-*`) + label `text-*`|
|Orientación vertical|Agrega `divider-horizontal`|Usa `h-100 border-start`|Cambia layout a columna y líneas verticales|
|Estado `active`|Agrega `font-semibold`|Agrega `border-opacity-100`|Agrega `text-slate-700`|
|Estado `hidden`|Agrega `hidden`|Agrega `d-none`|Agrega `hidden`|
|Merge de `class` usuario|Sí|Sí|Sí|

## 3. ♿ Atributos de accesibilidad y estado

En los 3 temas se resuelven de forma equivalente:

- `role`: por defecto `separator`
- `aria-orientation`: usa orientación del componente (`horizontal` o `vertical`)
- `aria-hidden`: `'true'` cuando estado es `hidden`
- `data-state`: estado actual

## 4. 🖥️ Uso rápido equivalente

### 4.1 DaisyUI

```blade
<x-w4-divider text="Sección" theme="daisyui" variant="primary" orientation="horizontal" />
```

### 4.2 Bootstrap

```blade
<x-w4-divider text="Sección" theme="bootstrap" variant="primary" orientation="horizontal" />
```

### 4.3 Tailwind

```blade
<x-w4-divider text="Sección" theme="tailwind" variant="primary" orientation="horizontal" />
```

## 5. 🔗 Referencias detalladas

- Daisy: `docs/COMPONENTS/UI/Daisy/2-Divider.md`
- Bootstrap: `docs/COMPONENTS/UI/Bootstrap/2-Divider.md`
- Tailwind: `docs/COMPONENTS/UI/Tailwind/2-Divider.md`
