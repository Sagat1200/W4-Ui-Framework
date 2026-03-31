# 🚀 W4-UI-Framework

## ✨ Contexto del Proyecto

## 1. 📌 Información General

* **Nombre:** W4-UI-Framework
* **Tipo:** Paquete Composer para Laravel
* **Propósito:** Construir un motor universal de componentes UI para Laravel que permita:

  * definir componentes una sola vez en PHP
  * renderizarlos a través de distintos sistemas visuales
  * soportar múltiples renderizadores de frontend
  * habilitar personalización visual por tenant, usuario, panel o solicitud
  * servir como base UI para el ecosistema W4

## 2. 🧠 Planteamiento del Problema

Los proyectos modernos de Laravel suelen mezclar varios enfoques de UI:

* Blade
* Livewire
* Inertia
* React
* Vue
* Bootstrap
* Bootswatch
* Tailwind
* DaisyUI
* otros kits de UI

En la mayoría de los proyectos, los componentes de UI terminan fuertemente acoplados a:

* un framework CSS específico
* una estrategia de renderizado específica
* un stack frontend específico

Esto provoca problemas recurrentes:

* componentes duplicados para cada stack
* dificultad para cambiar temas o sistemas visuales
* baja consistencia entre paquetes
* soporte deficiente para branding multi-tenant en SaaS
* deuda técnica creciente al agregar nuevas tecnologías UI

## 3. 💡 Solución Propuesta

W4-UI-Framework introducirá una capa de abstracción de UI donde:

* los componentes se definen en PHP
* la salida visual se resuelve mediante un Theme Engine
* el renderizado es gestionado por un sistema de Renderer
* las integraciones específicas de cada renderer se delegan a paquetes bridge

Un componente como:

```php
Button::make('Guardar')
    ->variant('primary')
    ->size('lg');
```

debería poder renderizarse de forma consistente en los stacks soportados sin cambiar la definición del componente.

## 4. 🎯 Objetivos Principales

1. Crear un sistema universal de componentes para Laravel.
2. Soportar múltiples familias visuales, inicialmente:

   * Bootstrap
   * Bootswatch
   * DaisyUI
3. Soportar múltiples estrategias de renderizado:

   * Blade
   * Livewire
   * Inertia React
   * Inertia Vue
4. Mantener los componentes independientes de cualquier framework CSS concreto.
5. Permitir selección dinámica de tema y overrides visuales.
6. Mantener la arquitectura extensible para futuros bridges y paquetes.
7. Servir como base UI para el ecosistema W4.

## 5. 🧬 Ecosistema W4 Relacionado

Este paquete está pensado para convertirse en la base visual de:

* **W4-PowerTable**
* **W4-DynamicFormBuilder**
* **W4-FileUploadManager**
* **W4-NeuronTenant**
* **W4-NeuronStorage**

El objetivo a largo plazo es que todos estos paquetes compartan:

* el mismo modelo de componentes
* el mismo sistema de temas
* las mismas convenciones de estado
* las mismas reglas de identidad visual

## 6. 🏛️ Punto de Partida Actual

El proyecto se encuentra en la **etapa inicial**.

En este momento:

* la arquitectura se está definiendo
* los límites de los paquetes se están formalizando
* los contratos del core aún no están implementados
* los primeros componentes reales aún no están finalizados
* los primeros puentes de renderizado aún no están construidos

Esto significa que la prioridad actual es **arquitectura primero**, no volumen de funcionalidades.

## 7. 🧱 Estrategia Inicial de Paquetes

El sistema se separará en tres paquetes principales.

### 7.1 `w4/ui-framework`

El paquete core.

Responsabilidades:

* componentes PHP
* contratos
* sistema de estado
* theme engine
* gestor de temas
* resolvedor de temas
* tokens
* presets
* clases de soporte
* gestor de renderers
* base de renderer Blade

Este paquete debe mantenerse independiente de Inertia y Livewire.

### 7.2 `w4/inertia-bridge`

El paquete de integración con Inertia.

Responsabilidades:

* renderer Inertia React
* renderer Inertia Vue
* serialización de componentes a metadatos
* registro runtime de JS
* componentes runtime de React y Vue

Este paquete consume el core y no debe implementar temas visuales.

### 7.3 `w4/livewire-bridge`

El paquete de integración con Livewire.

Responsabilidades:

* renderer Livewire
* mapeo de directivas wire
* bindings de loading y model
* soporte de hidratación/deshidratación
* wrappers y helpers específicos de Livewire

Este paquete consume el core y no debe implementar temas visuales.

## 8. 🧭 Principios Arquitectónicos del Core

### 8.1 Desacoplamiento del framework CSS

Los componentes no deben conocer clases CSS concretas como las de Bootstrap o DaisyUI.

### 8.2 Separación de responsabilidades

La arquitectura se divide conceptualmente en:

```text
Componente
   ↓
Renderer
   ↓
Theme Manager
   ↓
Theme Resolver
   ↓
Component Theme Resolver
   ↓
Salida Frontend
```

### 8.3 Aislamiento de renderers

El core define el componente.
El tema define cómo debe verse.
El bridge define cómo se entrega a un runtime frontend específico.

### 8.4 Extensibilidad primero

El sistema debe diseñarse para que agregar nuevos:

* componentes
* temas
* presets
* renderers
* bridges

sea posible sin romper el core.

### 8.5 Convención sobre improvisación

Las convenciones claras de nombres y carpetas serán obligatorias desde el inicio.

## 9. 🧩 Convenciones del Modelo de Componentes

Cada componente debe seguir una convención estricta.

### 9.1 Clase base de componente

Cada elemento UI debe estar representado por una clase de componente PHP dedicada.

Ejemplos:

* `Button`
* `Input`
* `Card`

### 9.2 Convención de nombres de estado

Cada componente debe definir:

* `{Component}ComponentState`
* `{Component}InteractState`

Ejemplos:

* `ButtonComponentState`
* `ButtonInteractState`
* `InputComponentState`
* `InputInteractState`

Esta convención es obligatoria para mantener consistencia en todo el framework.

### 9.3 Contexto abstracto

Los componentes deben exponer metadatos abstractos como:

* label
* name
* size
* variant
* state
* interaction state
* attributes

No deben exponer directamente decisiones de estilo específicas de un framework.

## 10. 🎨 Alcance Inicial de Temas

En la etapa inicial actual, el alcance visual debe mantenerse enfocado.

### Familias visuales iniciales

* Bootstrap
* presets de Bootswatch
* DaisyUI

Tailwind como familia base puede soportarse más adelante si es necesario, pero el foco inmediato debe mantenerse en los sistemas visuales que mejor se alinean con la dirección actual del paquete.

### Responsabilidades del tema

El sistema de temas debe gestionar:

* resolución de clases
* resolución de atributos HTML
* variantes visuales de componentes
* tamaños de componentes
* estados
* presets
* design tokens más adelante

## 11. 🖥️ Alcance Inicial de Renderers

El framework debe reconocer tres objetivos de renderizado desde el inicio:

* Blade
* Livewire
* Inertia

Pero la implementación debe realizarse por fases.

### Prioridad de fases

1. soporte base de Blade en el core
2. bridge de Livewire
3. bridge de Inertia

Este orden reduce el riesgo arquitectónico y permite madurar el modelo de componentes y temas antes de manejar runtimes más complejos.

## 12. 📦 Filosofía de Instalación

El renderer se selecciona por configuración, pero los paquetes bridge se instalan explícitamente mediante Composer.

Ejemplos:

### Solo core

```bash
composer require w4/ui-framework
```

### Core + Livewire

```bash
composer require w4/ui-framework w4/livewire-bridge
```

### Core + Inertia

```bash
composer require w4/ui-framework w4/inertia-bridge
```

El core nunca debe auto-instalar bridges en función de la configuración.

## 13. 🗂️ Dirección Inicial de Carpetas

El paquete core debería comenzar con una estructura cercana a esta:

```text
src/
├── Components
├── Contracts
├── Managers
├── Providers
├── Renderers
├── Support
├── Themes
└── Facades
```

Los paquetes bridge deben mantener sus propias estructuras aisladas.

## 14. 🛣️ Prioridades Inmediatas de Desarrollo

El proyecto debe comenzar con la arquitectura mínima significativa.

### Primera prioridad

* definir límites de paquetes
* definir contratos
* definir convenciones de nombres
* definir estrategia de registro de renderers
* definir flujo de resolución de temas

### Segunda prioridad

* crear `BaseComponent`
* crear `RendererManager`
* crear `ThemeManager`
* crear `BladeRenderer`
* crear primer componente: `Button`
* crear primeros estados:

  * `ButtonComponentState`
  * `ButtonInteractState`

### Tercera prioridad

* crear soporte inicial de tema Bootstrap
* crear soporte inicial de tema DaisyUI
* crear primeros resolvedores visuales para `Button`

### Cuarta prioridad

* construir `w4/livewire-bridge`
* construir `w4/inertia-bridge`

## 15. 🧪 Alcance Inicial v0

La primera versión práctica debe ser intencionalmente pequeña.

### Alcance sugerido para v0

* paquete core inicializado
* solo componente `Button`
* `ButtonComponentState`
* `ButtonInteractState`
* gestor de renderers
* renderer Blade
* resolvedor de botón Bootstrap
* resolvedor de botón DaisyUI
* archivo de configuración
* service provider

Esto mantiene el proyecto enfocado y valida la arquitectura antes de expandirse.

## 16. 🚫 Qué Debe Evitarse en Esta Etapa

En el estado inicial actual, el proyecto debe evitar:

* intentar soportar demasiados componentes a la vez
* implementar constructores visuales complejos demasiado pronto
* mezclar lógica de Livewire o Inertia dentro del core
* hardcodear clases CSS dentro de los componentes
* definir funcionalidades antes de estabilizar los contratos
* agregar overrides profundos por tenant antes de que funcione el sistema base de temas

## 17. 🏆 Visión de Largo Plazo

El objetivo a largo plazo es convertir W4-UI-Framework en un motor universal de UI para Laravel capaz de:

* definir componentes una sola vez en PHP
* renderizarlos a través de múltiples renderers
* cambiar sistemas visuales sin reescribir componentes
* soportar branding SaaS multi-tenant
* actuar como base visual del ecosistema W4

## 18. 📍 Resumen del Estado Actual del Proyecto

Estado real actual:

* la arquitectura se está estableciendo
* la separación de paquetes ya fue decidida
* el proyecto aún no tiene madurez de implementación
* el siguiente paso correcto es iniciar desde la base del core

## 19. ⏭️ Siguiente Paso Concreto

El siguiente paso de desarrollo debería ser:

* inicializar `w4/ui-framework`
* implementar los contratos y gestores base
* implementar el primer componente (`Button`)
* validar la arquitectura del core antes de expandir a bridges

