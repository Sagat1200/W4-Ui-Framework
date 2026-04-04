# 🚀 W4-UI-Framework

## ✨ Comparativa de Button por tema

Este resumen unifica el comportamiento de `Button` en:

- DaisyUI
- Bootstrap
- Tailwind

Componente base común:

`W4\UiFramework\Components\UI\Button\Button`

## 1. 🧱 API funcional común

Se mantiene igual en los 3 temas:

- Estados: `enabled`, `disabled`, `loading`, `readonly`, `active`
- Eventos: `click`, `disable`, `enable`, `start_loading`, `finish_loading`, `set_readonly`, `set_active`, `reset`
- Métodos típicos: `variant(...)`, `size(...)`, `dispatch(...)`, `state(...)`, `toArray()`, `toThemeContext()`

## 2. 🎨 Mapeo visual por tema

|Aspecto|DaisyUI|Bootstrap|Tailwind|
|---|---|---|---|
|Resolver|`DaisyUI\...\ButtonThemeResolver`|`Bootstrap\...\ButtonThemeResolver`|`Tailwind\...\ButtonThemeResolver`|
|Clase base|`btn`|`btn`|`inline-flex items-center justify-center rounded-md ...`|
|Variantes|`btn-neutral`, `btn-primary`, `btn-secondary`, `btn-accent`, `btn-info`, `btn-success`, `btn-warning`, `btn-error`|`btn-primary`, `btn-secondary`, `btn-success`, `btn-danger`, `btn-warning`, `btn-info`, `btn-light`, `btn-dark`, `btn-link`|`bg-slate-*`, `bg-blue-*`, `bg-violet-*`, `bg-cyan-*`, `bg-emerald-*`, `bg-amber-*`, `bg-rose-*`|
|Tamaños|`btn-xs`, `btn-sm`, `btn-md`, `btn-lg`, `btn-xl`|`btn-sm`, `btn-lg` (`md` sin extra)|`px/py` y `text-*` por `xs..xl`|
|Estado `loading`|Agrega `loading`|Agrega `disabled`|Agrega `opacity-75 cursor-wait`|
|Estado `active`|Agrega `btn-active`|Agrega `active`|Agrega `ring-2 ring-offset-2`|
|Merge de `class` usuario|Sí|Sí|Sí|
|Regla especial altura custom|Remueve `btn-xs..btn-xl` si detecta `h-*`, `min-h-*`, `max-h-*`|Sin remoción especial|Remueve clases de tamaño si detecta `h-*`, `min-h-*`, `max-h-*`|

## 3. ♿ Atributos de accesibilidad y estado

En los 3 temas se resuelven de forma equivalente:

- `type`: por defecto `button`
- `disabled`: `true` para `disabled`, `loading`, `readonly`
- `aria-disabled`: `'true'` para `disabled`, `loading`, `readonly`
- `aria-pressed`: `'true'` cuando `active`

## 4. 🖥️ Uso rápido equivalente

### 4.1 DaisyUI

```blade
<x-w4-button label="Guardar" theme="daisyui" variant="primary" size="md" />
```

### 4.2 Bootstrap

```blade
<x-w4-button label="Guardar" theme="bootstrap" variant="primary" size="md" />
```

### 4.3 Tailwind

```blade
<x-w4-button label="Guardar" theme="tailwind" variant="primary" size="md" />
```

## 5. 🔗 Referencias detalladas

- Daisy: `docs/COMPONENTS/UI/Daisy/1-Button.md`
- Bootstrap: `docs/COMPONENTS/UI/Bootstrap/1-Button.md`
- Tailwind: `docs/COMPONENTS/UI/Tailwind/1-Button.md`
