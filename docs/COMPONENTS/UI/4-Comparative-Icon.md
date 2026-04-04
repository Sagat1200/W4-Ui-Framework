# 🚀 W4-UI-Framework

## ✨ Comparativa de Icon por tema

Este resumen unifica el comportamiento de `Icon` en:

- DaisyUI
- Bootstrap
- Tailwind

Componente base común:

`W4\UiFramework\Components\UI\Icon\Icon`

## 1. 🧱 API funcional común

Se mantiene igual en los 3 temas:

- Estados: `enabled`, `disabled`, `active`, `hidden`
- Eventos: `activate`, `deactivate`, `disable`, `enable`, `hide`, `show`, `reset`
- Métodos típicos: `icon(...)`, `label(...)`, `variant(...)`, `size(...)`, `spin(...)`, `decorative(...)`, `dispatch(...)`, `toArray()`, `toThemeContext()`

## 2. 🎨 Mapeo visual por tema

|Aspecto|DaisyUI|Bootstrap|Tailwind|
|---|---|---|---|
|Resolver|`DaisyUI\...\IconThemeResolver`|`Bootstrap\...\IconThemeResolver`|`Tailwind\...\IconThemeResolver`|
|Clase base|`inline-block align-middle leading-none`|`d-inline-block align-middle lh-1`|`inline-block align-middle leading-none`|
|Variantes|`text-primary`, `text-secondary`, `text-accent`, `text-success`, `text-warning`, `text-error`, `text-info`, `text-base-content`|`text-primary`, `text-secondary`, `text-success`, `text-warning`, `text-danger`, `text-info`, `text-light`, `text-dark`, `text-body`|`text-blue-*`, `text-slate-*`, `text-violet-*`, `text-emerald-*`, `text-amber-*`, `text-rose-*`, `text-cyan-*`|
|Tamaños|`text-xs`, `text-sm`, `text-base`, `text-lg`, `text-xl`|`fs-6`, `fs-5`, `fs-4`, `fs-3`, `fs-2`|`text-xs`, `text-sm`, `text-base`, `text-lg`, `text-xl`|
|Spin|`animate-spin`|`fa-spin`|`animate-spin`|
|Estado `active`|`drop-shadow-sm`|`text-decoration-underline`|`drop-shadow-sm`|
|Estado `hidden`|`hidden`|`d-none`|`hidden`|
|Merge de `class` usuario|Sí|Sí|Sí|

## 3. ♿ Atributos de accesibilidad y estado

En los 3 temas se resuelven de forma equivalente:

- `role`: por defecto `img`
- `aria-hidden`: `'true'` cuando es decorativo o estado `hidden`
- `aria-label`: usa label de usuario/componente cuando no es decorativo
- `data-state`: estado actual
- `data-spin`: `'true'` cuando `spin=true`

## 4. 🖥️ Uso rápido equivalente

### 4.1 DaisyUI

```blade
<x-w4-icon label="Actualizar" icon="heroicon-o-arrow-path" theme="daisyui" variant="primary" size="lg" :spin="true" />
```

### 4.2 Bootstrap

```blade
<x-w4-icon label="Actualizar" icon="bi-arrow-repeat" theme="bootstrap" variant="primary" size="lg" :spin="true" />
```

### 4.3 Tailwind

```blade
<x-w4-icon label="Actualizar" icon="heroicon-o-arrow-path" theme="tailwind" variant="primary" size="lg" :spin="true" />
```

## 5. 🔗 Referencias detalladas

- Daisy: `docs/COMPONENTS/UI/Daisy/4-Icon.md`
- Bootstrap: `docs/COMPONENTS/UI/Bootstrap/4-Icon.md`
- Tailwind: `docs/COMPONENTS/UI/Tailwind/4-Icon.md`
